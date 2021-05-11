<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\BacteriologicalResult;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class TreatmentOutcomesController extends Controller
{
    public function index(TBMacFormFilters $filters)
    {
        $treatmentOutcomes = TBMacForm::TreatmentOutcomeForms()
            ->filter($filters)
            ->with(['patient','treatmentOutcomeForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->paginate(10);
        $data = $treatmentOutcomes->map(function ($item) {
            return [
                'id' => $item->id,
                'patient_code' => $item->patient->code,
                'date_created' => $item->created_at->format('m-d-Y'),
                'facility_code' => $item->patient->facility_code,
                'status' => $item->status,
                'drug_susceptibility' => $item->treatmentOutcomeForm->current_drug_susceptibility,
            ];
        });

        return response()->json([
            'data' => $data,
        ]);
    }

    public function store()
    {
        $validator = \Validator::make(request()->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'treatment_outcome';
        $request['status'] = 'New Case';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['is_from_itis'] = false;

        $patient = Patient::create($request);
        $request['patient_id'] = $patient->id;

        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->treatmentOutcomeForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('private/treatment-outcomes/'.$tbMacForm->presentation_number, $fileName);
                $tbMacForm->attachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                ]);
            }
        }

        $this->createScreenings($request, $tbMacForm);
        $this->createLPADST($request, $tbMacForm);
        $this->createMonthlyScreenings($request, $tbMacForm);

        return response()->json('Treatment outcome form submitted successfully');
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments','patient','recommendations']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $bacteriologicalResults = $tbBacteriologicalResults->filter(function ($item) {
            return $item->type !== 'dst_from_other_lab';
        })->map(function ($item) {
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'result' => $item->result,
            ];
        })->values();

        $dstFromOtherLab = $tbBacteriologicalResults->filter(function ($item) {
            return $item->type === 'dst_from_other_lab';
        })->map(function ($item) {
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'result' => $item->result,
            ];
        })->values();

        $attachments = [];
        foreach ($tbMacForm->attachments as $key => $attachment) {
            $fileName = ($key + 1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('api/enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment'),
                'filename' => $attachment->file_name,
            ];
        }

        $recommendations = $tbMacForm->recommendations->map(function ($item) {
            return [
                'name' => $item->users->name,
                'role' => $item->users->role->name,
                'role_id' => $item->role_id,
                'date_created' => $item->created_at->format('m-d-Y'),
                'status' => $item->status === '0' ? '' : $item->status,
                'recommendation' => $item->recommendation,
            ];
        });

        $data = [
            'date_created' => $tbMacForm->created_at->format('m-d-Y'),
            'patient_code' => $tbMacForm->patient->code,
            'facility_code' => $tbMacForm->patient->facility_code,
            'status' => $tbMacForm->status,
            'date_submitted_to_rtb_mac' => '',
            'treatment_history' => $tbMacForm->enrollmentForm->treatment_history ? $tbMacForm->enrollmentForm->treatment_history : '',
            'registration_group' => $tbMacForm->enrollmentForm->registration_group,
            'risk_factor' => $tbMacForm->enrollmentForm->risk_factor,
            'bacteriological_results' => $bacteriologicalResults,
            'dst_from_other_lab' => $dstFromOtherLab,
            'drug_susceptibility' => $tbMacForm->enrollmentForm->drug_susceptibility,
            'current_weight' => $tbMacForm->enrollmentForm->current_weight,
            'suggested_regimen' => $tbMacForm->enrollmentForm->suggested_regimen,
            'itr_drugs' => Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'ITR') ? $tbMacForm->enrollmentForm->suggested_regimen : null,
            'regiment_notes' => $tbMacForm->enrollmentForm->regimen_notes,
            'clinical_status' => $tbMacForm->enrollmentForm->clinical_status,
            'vital_signs' => $tbMacForm->enrollmentForm->vital_signs,
            'diag_and_lab_findings' => $tbMacForm->enrollmentForm->diag_and_lab_findings,
            'signs_and_symptoms' => $tbMacForm->enrollmentForm->signs_and_symptoms,
            'cxr_date' => $tbMacForm->laboratoryResults->cxr_date ? $tbMacForm->laboratoryResults->cxr_date->format('m-d-Y') : '',
            'cxr_result' => $tbMacForm->laboratoryResults->cxr_result,
            'cxr_reading' => $tbMacForm->laboratoryResults->cxr_reading,
            'ct_scan_date' => $tbMacForm->laboratoryResults->ct_scan_date ? $tbMacForm->laboratoryResults->ct_scan_date->format('m-d-Y') : '',
            'ct_scan_result' => $tbMacForm->laboratoryResults->ct_scan_result,
            'ultrasound_date' => $tbMacForm->laboratoryResults->ultrasound_date ? $tbMacForm->laboratoryResults->ultrasound_date->format('m-d-Y') : '',
            'ultrasound_result' => $tbMacForm->laboratoryResults->ultrasound_result,
            'histopathological_date' => $tbMacForm->laboratoryResults->histopathological_date ? $tbMacForm->laboratoryResults->histopathological_date->format('m-d-Y') : '',
            'histopathological_result' => $tbMacForm->laboratoryResults->histopathological_result,
            'remarks' => $tbMacForm->laboratoryResults->remarks,
            'attachments' => $attachments,
            'recommendations' => $recommendations,
        ];

        return response()->json($data);
    }

    protected function rules()
    {
        $storeRequest = new StoreRequest();
        $rules = $storeRequest->rules();
        $rules['monthly_screenings'] = 'required';
        return $rules;
    }

    private function createScreenings($request, $tbMacForm)
    {
        // Screening 1
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'screenings',
            'date_collected' => $request['screening_1_date_collected'],
            'method_used' => $request['screening_1_method_used'],
            'resistance_pattern' => $request['screening_1_resistance_pattern'],
        ]);

        // Screening 2
        if (isset($request['screening_2_date_collected'])) {
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'screenings',
                'date_collected' => $request['screening_2_date_collected'],
                'method_used' => $request['screening_2_method_used'],
                'resistance_pattern' => $request['screening_2_resistance_pattern'],
            ]);
        }
    }

    private function createLPADST($request, $tbMacForm)
    {
        // LPA
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'lpa',
            'date_collected' => $request['lpa_date_collected'],
            'resistance_pattern' => $request['lpa_resistance_pattern'],
        ]);

        // DST
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'dst',
            'date_collected' => $request['dst_date_collected'],
            'resistance_pattern' => $request['dst_resistance_pattern'],
            'resistance_pattern_others' => $request['dst_resistance_pattern'] === 'Other (specify)' ? $request['dst_resistance_pattern_others'] : null,
        ]);
    }

    private function createMonthlyScreenings($request, $tbMacForm)
    {
        foreach (json_decode($request['monthly_screenings']) as $item) {
            $item = (array) $item;
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'monthly_screenings',
                'date_collected' => $item['date_collected'],
                'smear_microscopy' => $item['smear_microscopy'],
                'tb_lamp' => $item['tb_lamp'],
                'culture' => $item['culture'],
            ]);
        }
    }

    private function getDynamicQuery()
    {
        return [
            'condition' => getDynamicQuery()[auth()->user()->role_id]['condition'],
            'value' => getDynamicQuery()[auth()->user()->role_id]['value'],
        ];
    }
}

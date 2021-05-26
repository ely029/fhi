<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\TBMacForm;
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
                'outcome' => $item->treatmentOutcomeForm->outcome,
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
            foreach ($request['attachments'] as $file) {
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
        $tbMacForm = $tbMacForm->load(['submittedBy','treatmentOutcomeForm','treatmentOutcomeBacteriologicalResults','laboratoryResults','attachments','patient','recommendations']);
        $attachments = [];
        foreach ($tbMacForm->attachments as $attachment) {
            $url = url('api/treatment-outcomes/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment');
            $attachments[] = [
                'thumbnail' => Str::endsWith($attachment->file_name, '.pdf') ? asset('assets/app/img/pdf.png') : $url,
                'url' => $url,
                'filename' => $attachment->file_name,
            ];
        }

        $recommendations = $tbMacForm->recommendations->map(function ($item) {
            return [
                'name' => $item->users->name,
                'role' => $item->users->role->name,
                'role_id' => $item->role_id,
                'date_created' => $item->created_at->format('m-d-Y'),
                'status' => $item->status,
                'recommendation' => $item->recommendation,
            ];
        });

        $bacteriologicalResults = $tbMacForm->treatmentOutcomeBacteriologicalResults;

        $screenings = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'screenings';
        })->map(function ($item, $key) {
            return [
                'label' => 'Screening '.($key + 1),
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'method_used' => $item->method_used,
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->all();

        $lpa = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'lpa';
        })->first();

        $lpa = [
            'date_collected' => $lpa->date_collected->format('m-d-Y'),
            'resistance_pattern' => $lpa->resistance_pattern,
        ];

        $dst = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'dst';
        })->first();

        $dst = [
            'date_collected' => $dst->date_collected->format('m-d-Y'),
            'resistance_pattern' => $dst->resistance_pattern,
            'resistance_pattern_others' => $dst->resistance_pattern_others,
        ];

        $monthlyScreenings = $bacteriologicalResults->filter(function ($item) {
            return $item->type === 'monthly_screenings';
        })->values()->map(function ($item, $key) {
            return [
                'label' => $key === 0 ? 'B' : $key,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        });

        $data = [
            'submitted_by' => $tbMacForm->submittedBy->name,
            'presentation_number' => $tbMacForm->presentation_number,
            'patient_code' => $tbMacForm->patient->code,
            'facility_code' => $tbMacForm->patient->facility_code,
            'province' => $tbMacForm->patient->province,
            'status' => $tbMacForm->status,
            'tb_case_number' => $tbMacForm->treatmentOutcomeForm->tb_case_number,
            'date_started_treatment' => $tbMacForm->treatmentOutcomeForm->date_started_treatment->format('m-d-Y'),
            'current_drug_susceptibility' => $tbMacForm->treatmentOutcomeForm->current_drug_susceptibility,
            'outcome' => $tbMacForm->treatmentOutcomeForm->outcome,
            'health_care_worker' => $tbMacForm->submittedBy->name,
            'date_submitted' => $tbMacForm->created_at->format('m-d-Y'),
            'screenings' => $screenings,
            'lpa' => $lpa,
            'dst' => $dst,
            'monthly_screenings' => $monthlyScreenings,
            'cxr_date' => $tbMacForm->laboratoryResults->cxr_date->format('Y-m-d'),
            'cxr_reading' => $tbMacForm->laboratoryResults->cxr_reading,
            'cxr_result' => $tbMacForm->laboratoryResults->cxr_result,
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

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacteriologicalResult;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class EnrollmentsController extends Controller
{
    public function index(TBMacFormFilters $filters)
    {
        $enrollments = TBMacForm::EnrollmentForms()
            ->filter($filters)
            ->with(['patient','enrollmentForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->paginate(10);
        $data = $enrollments->map(function ($item) {
            return [
                'id' => $item->id,
                'patient_code' => $item->patient->code,
                'date_created' => $item->created_at->format('m-d-Y'),
                'facility_code' => $item->patient->facility_code,
                'status' => $item->status,
                'drug_susceptibility' => $item->enrollmentForm->drug_susceptibility ?? null,
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
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['is_from_itis'] = false;
        $request['suggested_regimen'] = $this->handleSuggestedRegimen($request);

        $patient = Patient::create($request);
        $request['patient_id'] = $patient->id;
        $tbMacForm = TBMacForm::create($request);
        $tbMacForm->enrollmentForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, ($key + 1).'.'.$file->extension());
                $tbMacForm->attachments()->create([
                    'extension' => $file->extension(),
                ]);
            }
        }

        foreach (BacteriologicalResult::LABEL as $status => $label) {
            if (isset($request[$status])) {
                $this->createBacteriologicalStatus($request, $status, $tbMacForm);
            }
        }
        return response()->json('Enrollment form submitted successfully');
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $submitted_by = ! isset($tbMacForm->submittedBy->name) ? '' : $tbMacForm->submittedBy->name;
        $gender = ! isset($tbMacForm->patient->gender) ? '' : $tbMacForm->patient->gender;
        $facility_code = ! isset($tbMacForm->patient->facility_code) ? '' : $tbMacForm->patient->facility_code;
        $province = ! isset($tbMacForm->patient->province) ? '' : $tbMacForm->patient->province;
        $birthday = ! isset($tbMacForm->patient->birthday) ? '' : $tbMacForm->patient->birthday->format('m-d-Y');
        $first_name = ! isset($tbMacForm->patient->first_name) ? '' : $tbMacForm->patient->first_name;
        $middle_name = ! isset($tbMacForm->patient->middle_name) ? '' : $tbMacForm->patient->middle_name;
        $last_name = ! isset($tbMacForm->patient->last_name) ? '' : $tbMacForm->patient->last_name;
        $treatment_history = ! isset($tbMacForm->enrollmentForm->treatment_history) ? '' : $tbMacForm->enrollmentForm->treatment_history;
        $registration_group = ! isset($tbMacForm->enrollmentForm->registration_group) ? '' : $tbMacForm->enrollmentForm->registration_group;
        $risk_factor = ! isset($tbMacForm->enrollmentForm->risk_factor) ? '' : $tbMacForm->enrollmentForm->risk_factor;
        $ct_scan_date = ! isset($tbMacForm->laboratoryResults->ct_scan_date) ? '' : $tbMacForm->laboratoryResults->ct_scan_date->format('m-d-Y') ?? null;
        $ct_scan_result = $tbMacForm->laboratoryResults->ct_scan_result ?? null;
        $ultra_sound_date = ! isset($tbMacForm->laboratoryResults->ultrasound_date) ? '' : $tbMacForm->laboratoryResults->ultrasound_date->format('m-d-Y') ?? null;
        $ultra_sound_result = $tbMacForm->laboratoryResults->ultrasound_result ?? null;
        $histhopathological_date = ! isset($tbMacForm->laboratoryResults->histhopathological_date) ? '' : $tbMacForm->laboratoryResults->histhopathological_date->format('m-d-Y') ?? null;
        $histhopathological_result = $tbMacForm->laboratoryResults->histopathological_result ?? null;
        $cxr_date = ! isset($tbMacForm->laboratoryResults->cxr_date) ? '' : $tbMacForm->laboratoryResults->cxr_date->format('m-d-Y');
        $cxr_result = $tbMacForm->laboratoryResults->cxr_result ?? null;
        $remarks = $tbMacForm->laboratoryResults->remarks ?? null;
        $bacteriological_results = $tbBacteriologicalResults->map(function ($item) {
            return [
                'date_collected' => $item->date_collected->format('m-d-Y'), 'name_of_laboratory' => $item->name_of_laboratory, 'result' => $item->result, 'name' => $item->type,
            ];
        })->values();
        $drug_susceptibility = ! isset($tbMacForm->enrollmentForm->drug_susceptibility) ? '' : $tbMacForm->enrollmentForm->drug_susceptibility;
        $current_weight = ! isset($tbMacForm->enrollmentForm->current_weight) ? '' : $tbMacForm->enrollmentForm->current_weight;
        $suggested_regimen = ! isset($tbMacForm->enrollmentForm->suggested_regimen) ? '' : $tbMacForm->enrollmentForm->suggested_regimen;
        $suggedted_others = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'Other') ? substr($tbMacForm->enrollmentForm->suggested_regimen, strpos($tbMacForm->enrollmentForm->suggested_regimen, '-') + 1) : '';
        $suggested_itr = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'ITR') ? $tbMacForm->enrollmentForm->itr_drugs : '';
        $regimen_notes = ! isset($tbMacForm->enrollmentForm->regimen_notes) ? '' : $tbMacForm->enrollmentForm->regimen_notes;
        $clinical_status = ! isset($tbMacForm->enrollmentForm->clinical_status) ? '' : $tbMacForm->enrollmentForm->clinical_status;
        $signs_and_symptoms = ! isset($tbMacForm->enrollmentForm->signs_and_symptoms) ? '' : $tbMacForm->enrollmentForm->signs_and_symptoms;
        $vital_signs = ! isset($tbMacForm->enrollmentForm->vital_signs) ? '' : $tbMacForm->enrollmentForm->vital_signs;
        $diag_and_lab_findings = ! isset($tbMacForm->enrollmentForm->diag_and_lab_findings) ? '' : $tbMacForm->enrollmentForm->diag_and_lab_findings;

        $attachments = [];
        foreach ($tbMacForm->attachments as $key => $attachment) {
            $fileName = ($key + 1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('api/enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment'),
                'filename' => $attachment->file_name,
            ];
        }

        $data = [
            'facility_code' => $facility_code,
            'province' => $province,
            'gender' => $gender,
            'submitted_by' => $submitted_by,
            'first_name' => $first_name,
            'middle_name' => $middle_name,
            'last_name' => $last_name,
            'treatment_history' => $treatment_history,
            'registration_group' => $registration_group,
            'risk_factor' => $risk_factor,
            'drug_susceptibility' => $drug_susceptibility,
            'current_weight' => $current_weight,
            'suggested_regimen' => $suggested_regimen,
            'regiment_notes' => $regimen_notes,
            'clinical_status' => $clinical_status,
            'signs_and_symptoms' => $signs_and_symptoms,
            'vital_signs' => $vital_signs,
            'diag_and_lab_findings' => $diag_and_lab_findings,
            'bacteriological_results' => $bacteriological_results,
            'attachments' => $attachments,
            'ct_scan_date' => $ct_scan_date,
            'ct_scan_result' => $ct_scan_result,
            'ultra_sound_date' => $ultra_sound_date,
            'ultra_sound_result' => $ultra_sound_result,
            'hispathological_date' => $histhopathological_date,
            'hispathological_result' => $histhopathological_result,
            'cxr_date' => $cxr_date,
            'cxr_result' => $cxr_result,
            'remarks' => $remarks,
            'birthday' => $birthday,
            'suggested_itr' => $suggested_itr,
            'suggested_others' => $suggedted_others,
        ];

        return response([
            'data' => $data,
        ]);
    }

    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$fileName;

        if (\Storage::exists($path)) {
            if (Str::endsWith($fileName, '.xls') || Str::endsWith($fileName, '.xlsx') || Str::endsWith($fileName, '.csv')) {
                return response()->file(public_path('assets/app/img/excel.png'));
            }
            if (Str::endsWith($fileName, '.pdf')) {
                return response()->file(public_path('assets/app/img/pdf.png'));
            }
            if (Str::endsWith($fileName, '.docx')) {
                return response()->file(public_path('assets/app/img/docx.png'));
            }
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
    }

    protected function rules()
    {
        return [
            'facility_code' => 'required',
            'province' => 'required',
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'birthday' => 'required|date_format:Y-m-d',
            'gender' => 'required|in:Male,Female',
            'treatment_history' => 'required',
            'registration_group' => 'required',
            'risk_factor' => 'required',
            'drug_susceptibility' => 'required',
            'current_weight' => 'required|numeric',
            'suggested_regimen' => 'required',
            'itr_drugs' => 'nullable|required_if:suggested_regimen,ITR',
            'suggested_regimen_others' => 'nullable|required_if:suggested_regimen,Other (specify)',
            'regimen_notes' => 'required',
            'clinical_status' => 'required',
            'signs_and_symptoms' => 'required',
            'vital_signs' => 'required',
            'diag_and_lab_findings' => 'required',
            'cxr_date' => 'nullable|date_format:Y-m-d',
            'cxr_result' => 'nullable',
            'cxr_reading.*' => 'nullable',
            'ct_scan_date' => 'nullable|date_format:Y-m-d',
            'ct_scan_result' => 'nullable',
            'ultrasound_date' => 'nullable|date_format:Y-m-d',
            'ultrasound_result' => 'nullable',
            'histopathological_date' => 'nullable|date_format:Y-m-d',
            'histopathological_result' => 'nullable',
            'remarks' => 'required',
            'attachments.*' => 'nullable|file|max:10000',
        ];
    }

    private function createBacteriologicalStatus($request, $status, $tbMacForm)
    {
        foreach (json_decode($request[$status]) as $item) {
            $item = (array) $item;
            $tbMacForm->bacteriologicalResults()->create([
                'type' => $status === 'others' ? 'Others-'.$item['specify'] : $status,
                'date_collected' => $item['date_collected'],
                'name_of_laboratory' => $item['name_of_laboratory'],
                'result' => $status === 'lpa' ? json_encode($item['result']) : $item['result'],
            ]);
        }
    }

    private function handleSuggestedRegimen($request)
    {
        $regimen = $request['suggested_regimen'];
        if ($regimen === 'ITR') {
            $regimen = 'ITR-'.$request['itr_drugs'];
        } elseif ($regimen === 'Other (specify)') {
            $regimen = 'Others-'.$request['suggested_regimen_others'];
        }
        return $regimen;
    }

    private function getDynamicQuery()
    {
        $condition = 'submitted_by';
        $value = auth()->user()->id;

        if (in_array(auth()->user()->role_id, [4,5,6])) {
            $condition = 'region';
            // change to auth user region
            $value = 'NCR';
        } elseif (in_array(auth()->user()->role_id, [7,8])) {
            $condition = 'form_type';
            $value = 'enrollment';
        }

        return [
            'condition' => $condition,
            'value' => $value,
        ];
    }
}

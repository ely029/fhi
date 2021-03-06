<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacteriologicalResult;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Str;

class EnrollmentResubmitController extends Controller
{
    public function editPage(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $facility_code = ! isset($tbMacForm->patient->facility_code) ? '' : $tbMacForm->patient->facility_code;
        $birthday = ! isset($tbMacForm->patient->birthday) ? '' : $tbMacForm->patient->birthday->format('Y-m-d');
        $first_name = ! isset($tbMacForm->patient->first_name) ? '' : $tbMacForm->patient->first_name;
        $middle_name = ! isset($tbMacForm->patient->middle_name) ? '' : $tbMacForm->patient->middle_name;
        $last_name = ! isset($tbMacForm->patient->last_name) ? '' : $tbMacForm->patient->last_name;
        $treatment_history = ! isset($tbMacForm->enrollmentForm->treatment_history) ? '' : $tbMacForm->enrollmentForm->treatment_history;
        $registration_group = ! isset($tbMacForm->enrollmentForm->registration_group) ? '' : $tbMacForm->enrollmentForm->registration_group;
        $risk_factor = ! isset($tbMacForm->enrollmentForm->risk_factor) ? '' : $tbMacForm->enrollmentForm->risk_factor;
        $ct_scan_date = ! isset($tbMacForm->laboratoryResults->ct_scan_date) ? '' : $tbMacForm->laboratoryResults->ct_scan_date->format('Y-m-d') ?? null;
        $ct_scan_result = $tbMacForm->laboratoryResults->ct_scan_result ?? null;
        $ultra_sound_date = ! isset($tbMacForm->laboratoryResults->ultrasound_date) ? '' : $tbMacForm->laboratoryResults->ultrasound_date->format('Y-m-d') ?? null;
        $ultra_sound_result = $tbMacForm->laboratoryResults->ultrasound_result ?? null;
        $histhopathological_date = $tbMacForm->laboratoryResults->histopathological_date ? $tbMacForm->laboratoryResults->histopathological_date->format('Y-m-d') : null;
        $histhopathological_result = $tbMacForm->laboratoryResults->histopathological_result ?? null;
        $cxr_date = ! isset($tbMacForm->laboratoryResults->cxr_date) ? '' : $tbMacForm->laboratoryResults->cxr_date->format('Y-m-d');
        $cxr_result = $tbMacForm->laboratoryResults->cxr_result ?? null;
        $remarks = $tbMacForm->laboratoryResults->remarks ?? null;
        $bacteriological_results = $tbBacteriologicalResults->map(function ($item) {
            return [
                'date_collected' => $item->date_collected->format('Y-m-d'), 'name_of_laboratory' => $item->name_of_laboratory, 'result' => $item->result, 'name' => $item->name,
            ];
        })->values();
        $dstFromOtherLab = $tbBacteriologicalResults->filter(function ($item) {
            return $item->type === 'dst_from_other_lab';
        })->map(function ($item) {
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'result' => $item->result,
            ];
        })->values();
        $drug_susceptibility = ! isset($tbMacForm->enrollmentForm->drug_susceptibility) ? '' : $tbMacForm->enrollmentForm->drug_susceptibility;
        $current_weight = ! isset($tbMacForm->enrollmentForm->current_weight) ? '' : $tbMacForm->enrollmentForm->current_weight;
        $suggested_regimen = ! isset($tbMacForm->enrollmentForm->suggested_regimen) ? '' : $tbMacForm->enrollmentForm->suggested_regimen;
        //$suggedted_others = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'Other') ? substr($tbMacForm->enrollmentForm->suggested_regimen, strpos($tbMacForm->enrollmentForm->suggested_regimen, '-') + 1) : '';
        $suggedted_others = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'Other') ? $tbMacForm->enrollmentForm->suggested_regimen_others : '';
        $suggested_itr = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'ITR') ? $tbMacForm->enrollmentForm->itr_drugs : '';
        $regimen_notes = ! isset($tbMacForm->enrollmentForm->regimen_notes) ? '' : $tbMacForm->enrollmentForm->regimen_notes;
        $clinical_status = ! isset($tbMacForm->enrollmentForm->clinical_status) ? '' : $tbMacForm->enrollmentForm->clinical_status;
        $signs_and_symptoms = ! isset($tbMacForm->enrollmentForm->signs_and_symptoms) ? '' : $tbMacForm->enrollmentForm->signs_and_symptoms;
        $vital_signs = ! isset($tbMacForm->enrollmentForm->vital_signs) ? '' : $tbMacForm->enrollmentForm->vital_signs;
        $diag_and_lab_findings = ! isset($tbMacForm->enrollmentForm->diag_and_lab_findings) ? '' : $tbMacForm->enrollmentForm->diag_and_lab_findings;

        $attachments = [];
        foreach ($tbMacForm->attachments as $attachment) {
            $url = url('api/enrollments/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment');
            $attachments[] = [
                'thumbnail' => Str::endsWith($attachment->file_name, '.pdf') ? asset('assets/app/img/pdf.png') : $url,
                'url' => $url,
                'filename' => $attachment->file_name,
                'id' => $attachment->id,
            ];
        }

        $data = [
            'presentation_number' => $tbMacForm->presentation_number,
            'facility_code' => $facility_code,
            'province' => $tbMacForm->patient->province,
            'gender' => $tbMacForm->patient->gender,
            'submitted_by' => $tbMacForm->submittedBy->name,
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
            'cxr_reading' => ! isset($tbMacForm->laboratoryResults->cxr_readings) ? [] : $tbMacForm->laboratoryResults->cxr_readings,
            'cxr_reading_other' => ! isset($tbMacForm->laboratoryResults->cxr_reading_other) ? null : $tbMacForm->laboratoryResults->cxr_reading_other,
            'remarks' => $remarks,
            'birthday' => $birthday,
            'suggested_itr' => $suggested_itr,
            'suggested_regimen_others' => $suggedted_others,
            'dst_from_other_lab' => $dstFromOtherLab,
        ];

        return response([
            'data' => $data,
        ]);
    }

    public function resubmit(TBMacForm $tbMacForm)
    {
        $validator = \Validator::make(request()->all(), $this->rules());

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $request = request()->all();
        unset($request['_token']);
        $request['status'] = 'New Enrollment';
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $request['itr_drugs'] = ! isset($request['itr_drugs']) ? null : $request['itr_drugs'];

        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->enrollmentForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        if (isset($request['attachments-to-remove'])) {
            $this->removeAttachments($tbMacForm, $request);
        }

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, $fileName);
                $tbMacForm->attachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                ]);
            }
        }

        $tbMacForm->bacteriologicalResults()->delete();

        foreach (BacteriologicalResult::LABEL as $status => $label) {
            if (isset($request[$status])) {
                $this->createBacteriologicalStatus($request, $status, $tbMacForm);
            }
        }
        return response()->json('Enrollment Resubmitted Successfully', 200);
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
            'attachments.*' => 'nullable|file|mimes:jpeg,png,svg,pdf|max:10000',
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

    private function removeAttachments($tbMacForm, $request)
    {
        foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
            $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$toRemove;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $tbMacForm->attachments()->where('id', $toRemove)->delete();
        }
    }
}

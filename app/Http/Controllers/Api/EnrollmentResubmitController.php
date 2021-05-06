<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TBMacForm;
use Illuminate\Http\Request;
use Str;

class EnrollmentResubmitController extends Controller
{
    public function editPage(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $facility_code = ! isset($tbMacForm->patient->facility_code) ? '' : $tbMacForm->patient->facility_code;
        $province = ! isset($tbMacForm->patient->province) ? '' : $tbMacForm->patient->province;
        $first_name = ! isset($tbMacForm->patient->first_name) ? '' : $tbMacForm->patient->first_name;
        $middle_name = ! isset($tbMacForm->patient->middle_name) ? '' : $tbMacForm->patient->middle_name;
        $last_name = ! isset($tbMacForm->patient->last_name) ? '' : $tbMacForm->patient->last_name;
        $treatment_history = ! isset($tbMacForm->enrollmentForm->treatment_history) ? '' : $tbMacForm->enrollmentForm->treatment_history;
        $registration_group = ! isset($tbMacForm->enrollmentForm->registration_group) ? '' : $tbMacForm->enrollmentForm->registration_group;
        $risk_factor = ! isset($tbMacForm->enrollmentForm->risk_factor) ? '' : $tbMacForm->enrollmentForm->risk_factor;
        $bacteriological_results = $tbBacteriologicalResults->map(function ($item) {
            return [
                'date_collected' => $item->date_collected->format('Y-m-d'), 'name_of_laboratory' => $item->name_of_laboratory, 'result' => $item->result,
            ];
        })->values();
        $drug_susceptibility = ! isset($tbMacForm->enrollmentForm->drug_susceptibility) ? '' : $tbMacForm->enrollmentForm->drug_susceptibility;
        $current_weight = ! isset($tbMacForm->enrollmentForm->current_weight) ? '' : $tbMacForm->enrollmentForm->current_weight;
        $suggested_regimen = Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen, 'Other') ? substr($tbMacForm->enrollmentForm->suggested_regimen, strpos($tbMacForm->enrollmentForm->suggested_regimen, '-') + 1) : $tbMacForm->enrollmentForm->suggested_regimen;
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
        ];

        return response([
            'data' => $data,
        ]);
    }
}

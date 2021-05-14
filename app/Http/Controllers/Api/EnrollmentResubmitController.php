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

    public function resubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['status'] = 'New Enrollment';
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $request['itr_drugs'] = ! isset($request['itr_drugs']) ? null : $request['itr_drugs'];

        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->enrollmentForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        // if ($request['attachments-to-remove']) {
        //     $this->removeAttachments($tbMacForm, $request);
        // }

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
                $this->createBacteriologicalStatus($request, $tbMacForm, $status);
            }
        }
        return response()->json('Enrollment Resubmitted Successfully', 200);
    }

    private function createBacteriologicalStatus($request, $tbMacForm, $status)
    {
        foreach ($request[$status] as $key => $type) {
            $tbMacForm->bacteriologicalResults()->create([
                'type' => $status === 'others' ? 'Others-'.$request['others-specify'][$key] : $type,
                'date_collected' => $request[$type.'-date_collected'][$key],
                'name_of_laboratory' => $request[$type.'-name_of_laboratory'][$key],
                'result' => $type === 'lpa' ? json_encode($request[$type.'-'.$key.'-result']) : $request[$type.'-result'][$key],
            ]);
        }
    }

    // private function removeAttachments($tbMacForm, $request)
    // {
    //     foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
    //         $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$toRemove;
    //         if (Storage::exists($path)) {
    //             Storage::delete($path);
    //         }
    //         $tbMacForm->attachments()->where('file_name', $toRemove)->delete();
    //     }
    // }
}

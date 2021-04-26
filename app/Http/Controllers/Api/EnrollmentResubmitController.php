<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacteriologicalResult;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class EnrollmentResubmitController extends Controller
{
    public function editPage(TBMacForm $tbMacForm)
    {
        if (! in_array($tbMacForm->status, ['Not For Referral','Need Further Details'])) {
            return response()->json('Forbidden', 403);
        }
        return response()->json($this->show($tbMacForm));
    }

    public function resubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['status'] = 'New Enrollment';
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;

        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->enrollmentForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        if ($request['attachments-to-remove']) {
            $this->removeAttachments($tbMacForm, $request);
        }

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, ($tbMacForm->attachments()->count() + 1).'.'.$file->extension());
                $tbMacForm->attachments()->create([
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
        return response()->json('The Enrollment Resubmit Successfully', 200);
    }

    private function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments','patient','recommendations']);
        $tbBacteriologicalResults = $tbMacForm->bacteriologicalResults;
        $bacteriologicalResults = $tbBacteriologicalResults->filter(function ($item) {
            return $item->type !== 'dst_from_other_lab';
        })->map(function ($item) {
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('d F Y'),
                'result' => $item->result,
            ];
        })->values();

        $dstFromOtherLab = $tbBacteriologicalResults->filter(function ($item) {
            return $item->type === 'dst_from_other_lab';
        })->map(function ($item) {
            return [
                'name' => $item->name,
                'name_of_laboratory' => $item->name_of_laboratory,
                'date_collected' => $item->date_collected->format('d F Y'),
                'result' => $item->result,
            ];
        })->values();

        $attachments = [];
        foreach ($tbMacForm->attachments as $key => $attachment) {
            $fileName = ($key + 1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('api/enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment'),
            ];
        }

        $recommendations = $tbMacForm->recommendations->map(function ($item) {
            return [
                'name' => $item->users->name,
                'role' => $item->users->role->name,
                'date_created' => $item->created_at->format('d M, Y'),
                'status' => $item->status === 0 ? '' : $item->status,
                'recommendation' => $item->recommendation,
            ];
        });

        $data = [
            'date_created' => $tbMacForm->created_at->format('M d, Y'),
            'patient_code' => $tbMacForm->patient->code,
            'facility_code' => $tbMacForm->patient->facility_code,
            'status' => $tbMacForm->status,
            'date_submitted_to_rtb_mac' => '',
            'treatment_history' => $tbMacForm->enrollmentForm->treatment_history,
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
            'cxr_date' => $tbMacForm->laboratoryResults->cxr_date ? $tbMacForm->laboratoryResults->cxr_date->format('m/d/y') : '',
            'cxr_result' => $tbMacForm->laboratoryResults->cxr_result,
            'cxr_reading' => $tbMacForm->laboratoryResults->cxr_reading,
            'ct_scan_date' => $tbMacForm->laboratoryResults->ct_scan_date ? $tbMacForm->laboratoryResults->ct_scan_date->format('m/d/y') : '',
            'ct_scan_result' => $tbMacForm->laboratoryResults->ct_scan_result,
            'ultrasound_date' => $tbMacForm->laboratoryResults->ultrasound_date ? $tbMacForm->laboratoryResults->ultrasound_date->format('m/d/y') : '',
            'ultrasound_result' => $tbMacForm->laboratoryResults->ultrasound_result,
            'histopathological_date' => $tbMacForm->laboratoryResults->hispathological_date ? $tbMacForm->laboratoryResults->hispathological_date->format('m/d/y') : '',
            'histopathological_result' => $tbMacForm->laboratoryResults->hispathological_result,
            'remarks' => $tbMacForm->laboratoryResults->remarks,
            'attachments' => $attachments,
            'recommendations' => $recommendations,
        ];

        return response()->json($data);
    }

    private function removeAttachments($tbMacForm, $request)
    {
        if (json_decode($request['attachments-to-remove']) !== null) {
            $this->processRemove($tbMacForm, $request);
        }
    }

    private function processRemove($tbMacForm, $request)
    {
        foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
            $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$toRemove;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $key = explode('.', $toRemove);
            $tbMacForm->attachments[(int) $key[0] - 1]->delete();
        }
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
}

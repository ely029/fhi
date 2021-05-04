<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\CaseManagementLaboratoryResults;
use App\Models\TBMacForm;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseManagementResubmitController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','caseManagementForm','caseManagementBacteriologicalResults','caseManagementLaboratoryResults','caseManagementAttachment','patient','recommendations']);
        $tbBacteriologicalResults = $tbMacForm->caseManagementBacteriologicalResults;
        $presentation_number = $tbMacForm->presentation_number;
        $submitted_by = $tbMacForm->submittedBy->name;
        $date_submitted = $tbMacForm->created_at->format('M d, Y');
        $status = $tbMacForm->status;
        $created_at = $tbMacForm->created_at->format('M d, Y');
        $facility_code = $tbMacForm->patient->facility_code;
        $suggested_regimen = $tbMacForm->caseManagementForm->suggested_regimen ?? null;
        $suggested_regimen_notes = $tbMacForm->caseManagementForm->suggested_regimen_notes ?? null;
        $current_regimen = $tbMacForm->caseManagementForm->current_regiment ?? null;
        $current_weight = $tbMacForm->caseManagementForm->current_weight ?? null;
        $patient_code = $tbMacForm->patient->code;
        $itr_drugs = $tbMacForm->caseManagementForm->itr_drugs ?? null;
        $regimen_notes = '';
        $latest_comparative_cxr_reading = $tbMacForm->caseManagementForm->latest_comparative_cxr_reading;
        $current_drug_susceptibility = $tbMacForm->caseManagementForm->current_drug_susceptibility ?? null;
        $updated_type_of_case = $tbMacForm->caseManagementForm->updated_type_of_case ?? null;
        $ct_scan_date = $tbMacForm->caseManagementLaboratoryResult->ct_scan_date->format('M d, Y');
        $ct_scan_result = $tbMacForm->caseManagementLaboratoryResult->ct_scan_result;
        $ultra_sound_date = $tbMacForm->caseManagementLaboratoryResult->ultra_sound_date->format('M d, Y');
        $ultra_sound_result = $tbMacForm->caseManagementLaboratoryResult->ultra_sound_result;
        $histhopathological_date = $tbMacForm->caseManagementLaboratoryResult->histhopathological_date->format('M d, Y');
        $histhopathological_result = $tbMacForm->caseManagementLaboratoryResult->histhopathological_result;
        $cxr_date = $tbMacForm->caseManagementLaboratoryResult->cxr_date->format('M d, Y') ?? null;
        $cxr_result = $tbMacForm->caseManagementLaboratoryResult->cxr_result ?? null;
        $remarks = $tbMacForm->caseManagementForm->remarks ?? null;
        $screeningOne = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 1' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
                'method_used' => $item->method_used,
            ];
        })->values();
        $screeningTwo = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 2' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
                'method_used' => $item->method_used,
            ];
        })->values();
        $lpa = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'LPA';
        })->map(function ($item) {
            return [
                'label' => Str::startsWith($item->label, 'Other (Specify)') ? $item->others : $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();
        $dst = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'DST';
        })->map(function ($item) {
            return [
                'label' => Str::startsWith($item->label, 'Other (Specify)') ? $item->others : $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();
        $monthly_screening = $tbBacteriologicalResults->filter(function ($item) {
            return $item->resistance_pattern === '' && $item->method_used === '';
        })->map(function ($item) {
            return [
                'label' => 'Month '.$item->count,
                'date_collected' => $item->date_collected->format('d F Y'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        })->values();
        $attachments = [];
        foreach ($tbMacForm->caseManagementAttachments as $key => $attachment) {
            $fileName = ($key + 1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('api/enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment'),
                'filename' => $attachment->file_name,
            ];
        }

        $data = [
            'presentation_number' => $presentation_number, 'current_drug_susceptibility' => $current_drug_susceptibility, 'submitted_by' => $submitted_by, 'date_submitted' => $date_submitted, 'created_at' => $created_at, 'current_weight' => $current_weight, 'itr_drugs' => $itr_drugs, 'facility_code' => $facility_code, 'updated_type_of_case' => $updated_type_of_case, 'suggested_regimen_notes' => $suggested_regimen_notes, 'current_regiment' => $current_regimen, 'suggested_regimen' => $suggested_regimen, 'status' => $status, 'ct_scan_date' => $ct_scan_date, 'ct_scan_result' => $ct_scan_result, 'ultra_sound_date' => $ultra_sound_date, 'latest_comparative_cxr_reading' => $latest_comparative_cxr_reading, 'cxr_date' => $cxr_date, 'cxr_result' => $cxr_result, 'remarks' => $remarks, 'ultra_sound_result' => $ultra_sound_result, 'hispathological_date' => $histhopathological_date, 'hispathological_result' => $histhopathological_result, 'regimen_notes' => $regimen_notes, 'patient_code' => $patient_code, 'screening_one' => $screeningOne, 'screening_two' => $screeningTwo, 'attachments' => $attachments, 'lpa' => $lpa, 'dst' => $dst, 'monthly_screening' => $monthly_screening,
        ];

        return response()->json($data);
    }

    public function reSubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['first_name'] = '';
        $request['last_name'] = '';
        $caseManagementAttachment = new CaseManagementAttachments();
        $caseManagementBactResult = new CaseManagementBacteriologicalResults();
        $request['status'] = 'New Case';
        $tbMacForm->patient->update($request);
        $tbMacForm->update($request);
        $tbMacForm->caseManagementForm->update($request);
        //LPA
        $caseManagementBactResult->lpaUpdate($tbMacForm, $request);
        //DST
        $caseManagementBactResult->dstUpdate($tbMacForm, $request);
        //Screening 1
        $caseManagementBactResult->screeningOneUpdate($tbMacForm, $request);
        //Screening 2
        $caseManagementBactResult->screeningTwoUpdate($tbMacForm, $request);
        //MOnthly Screening Deletion
        CaseManagementBacteriologicalResults::where('form_id', $tbMacForm->id)->where('smear_microscopy', '<>', '')->delete();
        //MOnthly Screening Creation
        $count = count(json_decode($request['month_dst'], true)) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreationMobile($screen, $eee, $request, $tbMacForm);
        }
        if (isset($request['attachments'])) {
            CaseManagementAttachments::where('form_id', $tbMacForm->id)->delete();
            $caseManagementAttachment->createAttachment($request, $tbMacForm);
        }
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $request['itr_drugs'] = ! isset($request['itr_drugs']) ? '' : $request['itr_drugs'];
        unset($request['remarks']);
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return response()->json('Case Management Resubmit Successfully');
    }
}

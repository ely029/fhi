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
        $last_name = $tbMacForm->patient->last_name;
        $case_number = $tbMacForm->caseManagementForm->case_number;
        $birthday = $tbMacForm->patient->birthday->format('Y-m-d');
        $province = $tbMacForm->patient->province;
        $gender = $tbMacForm->patient->gender;
        $month_of_treatment = $tbMacForm->caseManagementForm->month_of_treatment;
        $date_submitted = $tbMacForm->created_at->format('Y-m-d');
        $status = $tbMacForm->status;
        $created_at = $tbMacForm->created_at->format('Y-m-d');
        $facility_code = $tbMacForm->patient->facility_code;
        $suggested_regimen = Str::startsWith($tbMacForm->caseManagementForm->suggested_regimen, 'ITR') ? $tbMacForm->caseManagementForm->itr_drugs : $tbMacForm->caseManagementForm->suggested_regimen;
        $suggested_regimen_notes = $tbMacForm->caseManagementForm->suggested_regimen_notes ?? null;
        $current_regimen = $tbMacForm->caseManagementForm->current_regiment ?? null;
        $current_weight = $tbMacForm->caseManagementForm->current_weight ?? null;
        $patient_code = $tbMacForm->patient->code;
        $itr_drugs = $tbMacForm->caseManagementForm->itr_drugs ?? null;
        $regimen_notes = $tbMacForm->caseManagementForm->reason_case_management_presentation;
        $latest_comparative_cxr_reading = $tbMacForm->caseManagementForm->latest_comparative_cxr_reading;
        $current_drug_susceptibility = $tbMacForm->caseManagementForm->current_drug_susceptibility ?? null;
        $updated_type_of_case = $tbMacForm->caseManagementForm->updated_type_of_case ?? null;
        $ct_scan_date = ! isset($tbMacForm->caseManagementLaboratoryResult->ct_scan_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->ct_scan_date->format('Y-m-d') ?? null;
        $ct_scan_result = $tbMacForm->caseManagementLaboratoryResult->ct_scan_result ?? null;
        $ultra_sound_date = ! isset($tbMacForm->caseManagementLaboratoryResult->ultra_sound_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->ultra_sound_date->format('Y-m-d') ?? null;
        $ultra_sound_result = $tbMacForm->caseManagementLaboratoryResult->ultra_sound_result ?? null;
        $histhopathological_date = ! isset($tbMacForm->caseManagementLaboratoryResult->histhopathological_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->histhopathological_date->format('Y-m-d') ?? null;
        $histhopathological_result = $tbMacForm->caseManagementLaboratoryResult->histhopathological_result ?? null;
        $cxr_date = $tbMacForm->caseManagementLaboratoryResult->cxr_date->format('Y-m-d') ?? null;
        $cxr_result = $tbMacForm->caseManagementLaboratoryResult->cxr_result ?? null;
        $remarks = $tbMacForm->caseManagementForm->remarks ?? null;
        $screeningOne = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 1' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'resistance_pattern' => $item->resistance_pattern,
                'method_used' => $item->method_used,
            ];
        })->values();
        $screeningTwo = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 2' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'resistance_pattern' => $item->resistance_pattern,
                'method_used' => $item->method_used,
            ];
        })->values();
        $lpa = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'LPA';
        })->map(function ($item) {
            return [
                'label' => Str::startsWith($item->label, 'Other (Specify)') ? $item->others : $item->label,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();
        $dst = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'DST';
        })->map(function ($item) {
            return [
                'label' => Str::startsWith($item->label, 'Other (Specify)') ? $item->others : $item->label,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();
        $monthly_screening = $tbBacteriologicalResults->filter(function ($item) {
            return $item->resistance_pattern === '' && $item->method_used === '' && $item->count !== null && $item->smear_microscopy !== '';
        })->map(function ($item) {
            return [
                'label' => 'Month '.$item->count,
                'date_collected' => $item->date_collected->format('Y-m-d'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        })->values();
        $attachments = [];
        foreach ($tbMacForm->caseManagementAttachments as $key => $attachment) {
            $fileName = ($key + 1).'.'.$attachment->extension;
            $attachments[] = [
                'url' => url('case-management/'.$tbMacForm->id.'/'.$fileName.'/attachment'),
                'filename' => $attachment->file_name,
            ];
        }
        $data = [
            'month_of_treatment' => $month_of_treatment, 'gender' => $gender, 'province' => $province, 'birthday' => $birthday, 'case_number' => $case_number, 'last_name' => $last_name, 'presentation_number' => $presentation_number, 'current_drug_susceptibility' => $current_drug_susceptibility, 'submitted_by' => $submitted_by, 'date_submitted' => $date_submitted, 'created_at' => $created_at, 'current_weight' => $current_weight, 'itr_drugs' => $itr_drugs, 'facility_code' => $facility_code, 'updated_type_of_case' => $updated_type_of_case, 'suggested_regimen_notes' => $suggested_regimen_notes, 'current_regiment' => $current_regimen, 'suggested_regimen' => $suggested_regimen, 'status' => $status, 'ct_scan_date' => $ct_scan_date, 'ct_scan_result' => $ct_scan_result, 'ultra_sound_date' => $ultra_sound_date, 'latest_comparative_cxr_reading' => $latest_comparative_cxr_reading, 'ultra_sound_result' => $ultra_sound_result, 'cxr_date' => $cxr_date, 'cxr_result' => $cxr_result, 'remarks' => $remarks, 'hispathological_date' => $histhopathological_date, 'hispathological_result' => $histhopathological_result, 'regimen_notes' => $regimen_notes, 'patient_code' => $patient_code, 'screening_one' => $screeningOne, 'screening_two' => $screeningTwo, 'attachments' => $attachments, 'lpa' => $lpa, 'dst' => $dst, 'monthly_screening' => $monthly_screening,
        ];
        return response()->json($data);
    }

    public function reSubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['first_name'] = '';
        $request['last_name'] = '';
        $caseManagementBactResult = new CaseManagementBacteriologicalResults();
        $request['status'] = 'New Case';
        $tbMacForm->patient->update($request);
        $tbMacForm->update($request);
        $tbMacForm->caseManagementForm->update($request);
        CaseManagementBacteriologicalResults::where('form_id', $tbMacForm->id)->delete();
        //Screening 1
        $caseManagementBactResult->screeningOneCreation($tbMacForm, $request);
        //Screening 2
        $caseManagementBactResult->screeningTwoCreation($tbMacForm, $request);
        //LPA
        $caseManagementBactResult->lpaCreation($tbMacForm, $request);
        //DST
        $caseManagementBactResult->dstCreation($tbMacForm, $request);
        //MOnthly Screening Creation
        $count = count(json_decode($request['month_dst'], true)) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreationMobile($screen, $eee, $request, $tbMacForm);
        }
        if (isset($request['attachments'])) {
            CaseManagementAttachments::where('form_id', $tbMacForm->id)->delete();
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$tbMacForm->presentation_number, $fileName);
                $tbMacForm->caseManagementAttachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                    'form_id' => $tbMacForm->id,
                ]);
            }
        }
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $request['itr_drugs'] = ! isset($request['itr_drugs']) ? '' : $request['itr_drugs'];
        unset($request['remarks']);
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return response()->json('Case Management Resubmit Successfully');
    }
}

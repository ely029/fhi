<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\CaseManagementLaboratoryResults;
use App\Models\TBMacForm;
use Illuminate\Http\Request;

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
        $suggested_regimen = $tbMacForm->caseManagementForm->suggested_regimen === '' ? '' : $tbMacForm->caseManagementForm->suggested_regimen;
        $suggested_regimen_notes = $tbMacForm->caseManagementForm->suggested_regimen_notes;
        $current_regimen = $tbMacForm->caseManagementForm->current_regiment;
        $current_weight = $tbMacForm->caseManagementForm->current_weight;
        $patient_code = $tbMacForm->patient->code;
        $itr_drugs = $tbMacForm->caseManagementForm->itr_drugs;
        $regimen_notes = '';
        $updated_type_of_case = $tbMacForm->caseManagementForm->updated_type_of_case;
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
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();

        $dst = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'DST';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'resistance_pattern' => $item->resistance_pattern,
            ];
        })->values();

        $monthly_screening = $tbBacteriologicalResults->filter(function ($item) {
            return $item->resistance_pattern === '' && $item->method_used === '';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('d F Y'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        })->values();

        $data = [
            'presentation_number' => $presentation_number,
            'submitted_by' => $submitted_by,
            'date_submitted' => $date_submitted,
            'current_weight' => $current_weight,
            'itr_drugs' => $itr_drugs,
            'updated_type_of_case' => $updated_type_of_case,
            'suggested_regimen_notes' => $suggested_regimen_notes,
            'current_regiment' => $current_regimen,
            'suggested_regimen' => $suggested_regimen,
            'status' => $status,
            'regiment_notes' => $regimen_notes,
            'patient_code' => $patient_code,
            'screening_one' => $screeningOne,
            'screening_two' => $screeningTwo,
            'lpa' => $lpa,
            'dst' => $dst,
            'monthly_screening' => $monthly_screening,
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
        CaseManagementAttachments::where('form_id', $tbMacForm->id)->delete();
        $tbMacForm->patient->update($request);
        $tbMacForm->update($request);
        $tbMacForm->caseManagementForm->update($request);
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
            $caseManagementAttachment->createAttachment($request, $tbMacForm);
        }
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return response()->json('Case Management Resubmit Successfully');
    }
}

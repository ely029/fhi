<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use App\Traits\MediaAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class CaseManagementController extends Controller
{
    use MediaAttachment;

    public function index(TBMacFormFilters $tBMacFormFilters)
    {
        $caseManagement = TBMacForm::caseManagementForms()
            ->with('patient', 'caseManagementForm')
            ->filter($tBMacFormFilters)
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->paginate(10);

        $data = $caseManagement->map(function ($item) {
            return [
                'id' => $item->id,
                'patient_code' => $item->patient->code,
                'date_created' => $item->created_at->format('Y-m-d'),
                'facility_code' => $item->patient->facility_code,
                'status' => $item->status,
                'drug_susceptibility' => $item->caseManagementForm->updated_type_of_case ?? null,
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
        $request['first_name'] = '';
        $request['middle_name'] = '';
        $patient = Patient::create($request);
        $caseManagementBactResult = new CaseManagementBacteriologicalResults();
        $request['status'] = 'New Case';
        $request['region'] = 'NCR';
        $request['role_id'] = 4;
        $request['form_type'] = 'case_management';
        $request['patient_id'] = $patient->id;
        $request['submitted_by'] = auth()->user()->id;
        $form = TBMacForm::create($request);
        $request['form_id'] = $form->id;
        //Screening 1
        $caseManagementBactResult->screeningOneCreation($form, $request);
        //Screening 2
        if (isset($request['date_collected_screening_2'])) {
            $request['screening_2_method_used'] = $request['ressitance_pattern_screening_2'];
            $request['screening_2_resistance_pattern'] = $request['method_used_screening_2'];
            $caseManagementBactResult->screeningTwoCreation($form, $request);
        }
        //LPA
        $caseManagementBactResult->lpaCreation($form, $request);
        //DST
        $caseManagementBactResult->dstCreation($form, $request);
        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$form->presentation_number, $fileName);
                $form->caseManagementAttachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                    'form_id' => $form->id,
                ]);
            }
        }
        //Month DST
        $count = count(json_decode($request['month_dst'], true)) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreationMobile($screen, $eee, $request, $form);
        }
        $request['cxr_date'] = ! isset($request['cxr_date']) ? Carbon::now()->timestamp : $request['cxr_date'];
        $request['itr_drugs'] = ! isset($request['suggested_regimen_itr']) ? '' : $request['suggested_regimen_itr'];
        $request['others'] = ! isset($request['suggested_regimen_others']) ? '' : $request['suggested_regimen_others'];
        $form->caseManagementForm()->create($request);
        unset($request['remarks']);
        $form->caseManagementLaboratoryResults()->create($request);

        return response()->json('New Case Successfully Created', 200);
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','caseManagementForm','caseManagementBacteriologicalResults','caseManagementLaboratoryResults','caseManagementAttachment','patient','recommendations']);
        $tbBacteriologicalResults = $tbMacForm->caseManagementBacteriologicalResults;
        $recommendations = $tbMacForm->recommendations;
        $month_of_treatment = ! isset($tbMacForm->caseManagementForm->month_of_treatment) ? '' : $tbMacForm->caseManagementForm->month_of_treatment;
        $presentation_number = $tbMacForm->presentation_number;
        $date_submitted = $tbMacForm->created_at->format('m-d-Y');
        $status = $tbMacForm->status;
        $created_at = $tbMacForm->created_at->format('m-d-Y');
        $facility_code = $tbMacForm->patient->facility_code;
        $suggested_regimen = ! isset($tbMacForm->caseManagementForm->suggested_regimen) ? '' : $tbMacForm->caseManagementForm->suggested_regimen;
        $suggested_regimen_others = Str::startsWith($tbMacForm->caseManagementForm->suggested_regimen, 'Other (specify)') ? $tbMacForm->caseManagementForm->others : $tbMacForm->caseManagementForm->suggested_regimen;
        $suggested_regimen_notes = $tbMacForm->caseManagementForm->suggested_regimen_notes ?? null;
        $current_regimen = $tbMacForm->caseManagementForm->current_regiment ?? null;
        $current_weight = $tbMacForm->caseManagementForm->current_weight ?? null;
        $patient_code = $tbMacForm->patient->code;
        $itr_drugs = $tbMacForm->caseManagementForm->itr_drugs ?? null;
        $regimen_notes = $tbMacForm->caseManagementForm->reason_case_management_presentation;
        $latest_comparative_cxr_reading = $tbMacForm->caseManagementForm->latest_comparative_cxr_reading;
        $current_drug_susceptibility = $tbMacForm->caseManagementForm->current_drug_susceptibility ?? null;
        $updated_type_of_case = $tbMacForm->caseManagementForm->updated_type_of_case ?? null;
        $ct_scan_date = ! isset($tbMacForm->caseManagementLaboratoryResult->ct_scan_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->ct_scan_date->format('m-d-Y') ?? null;
        $ct_scan_result = $tbMacForm->caseManagementLaboratoryResult->ct_scan_result ?? null;
        $ultra_sound_date = ! isset($tbMacForm->caseManagementLaboratoryResult->ultra_sound_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->ultra_sound_date->format('m-d-Y') ?? null;
        $ultra_sound_result = $tbMacForm->caseManagementLaboratoryResult->ultra_sound_result ?? null;
        $histhopathological_date = ! isset($tbMacForm->caseManagementLaboratoryResult->histhopathological_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->histhopathological_date->format('m-d-Y') ?? null;
        $histhopathological_result = $tbMacForm->caseManagementLaboratoryResult->histhopathological_result ?? null;
        $cxr_date = ! isset($tbMacForm->caseManagementLaboratoryResult->cxr_date) ? '' : $tbMacForm->caseManagementLaboratoryResult->cxr_date->format('m-d-Y');
        $cxr_result = $tbMacForm->caseManagementLaboratoryResult->cxr_result ?? null;
        $remarks = $tbMacForm->caseManagementForm->remarks ?? null;
        $submitted_by = $tbMacForm->submittedBy->name;
        $screeningOne = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 1' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label, 'date_collected' => $item->date_collected->format('m-d-Y'), 'resistance_pattern' => $item->resistance_pattern, 'method_used' => $item->method_used,
            ];
        })->values();
        $recommendation = $recommendations->map(function ($item) {
            return [
                'name' => $item->users->name,
                'role_id' => $item->role_id,
                'role' => $item->roles->name,
                'date_created' => $item->created_at->format('m-d-Y'),
                'status' => $item->status === '0' ? '' : $item->status,
                'recommendation' => $item->recommendation,
            ];
        })->values();
        $screeningTwo = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'Screening 2' && $item->resistance_pattern !== '' && $item->method_used !== '';
        })->map(function ($item) {
            return [
                'label' => $item->label, 'date_collected' => $item->date_collected->format('m-d-Y'), 'resistance_pattern' => $item->resistance_pattern, 'method_used' => $item->method_used,
            ];
        })->values();
        $lpa = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'LPA';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'resistance_pattern' => Str::startsWith($item->resistance_pattern, 'Other (Specify)') ? $item->others : $item->resistance_pattern,
            ];
        })->values();
        $dst = $tbBacteriologicalResults->filter(function ($item) {
            return $item->label === 'DST';
        })->map(function ($item) {
            return [
                'label' => $item->label,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'resistance_pattern' => Str::startsWith($item->resistance_pattern, 'Other (Specify)') ? $item->others : $item->resistance_pattern,
            ];
        })->values();
        $monthly_screening = $tbBacteriologicalResults->filter(function ($item) {
            return $item->resistance_pattern === '' && $item->method_used === '' && $item->count !== null && $item->smear_microscopy !== '';
        })->map(function ($item) {
            return [
                'label' => 'Month '.$item->count,
                'date_collected' => $item->date_collected->format('m-d-Y'),
                'smear_microscopy' => $item->smear_microscopy,
                'tb_lamp' => $item->tb_lamp,
                'culture' => $item->culture,
            ];
        })->values();
        $attachments = [];
        foreach ($tbMacForm->caseManagementAttachments as $attachment) {
            $url = url('api/case-management/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment');
            $attachments[] = [
                'thumbnail' => Str::endsWith($attachment->file_name, '.pdf') ? asset('assets/app/img/pdf.png') : $url,
                'url' => $url,
                'filename' => $attachment->file_name,
                'id' => $attachment->id,
            ];
        }
        $data = [
            'suggested_regimen_others' => $suggested_regimen_others, 'month_of_treatment' => $month_of_treatment, 'presentation_number' => $presentation_number, 'current_drug_susceptibility' => $current_drug_susceptibility, 'submitted_by' => $submitted_by, 'date_submitted' => $date_submitted, 'created_at' => $created_at, 'current_weight' => $current_weight, 'suggested_regimen_itr' => $itr_drugs, 'facility_code' => $facility_code, 'updated_type_of_case' => $updated_type_of_case, 'suggested_regimen_notes' => $suggested_regimen_notes, 'current_regiment' => $current_regimen, 'suggested_regimen' => $suggested_regimen, 'status' => $status, 'ct_scan_date' => $ct_scan_date, 'ct_scan_result' => $ct_scan_result, 'ultra_sound_date' => $ultra_sound_date, 'latest_comparative_cxr_reading' => $latest_comparative_cxr_reading, 'ultra_sound_result' => $ultra_sound_result, 'cxr_date' => $cxr_date, 'cxr_result' => $cxr_result, 'remarks' => $remarks, 'hispathological_date' => $histhopathological_date, 'hispathological_result' => $histhopathological_result, 'regimen_notes' => $regimen_notes, 'recommendations' => $recommendation, 'patient_code' => $patient_code, 'screening_one' => $screeningOne, 'screening_two' => $screeningTwo, 'attachments' => $attachments, 'lpa' => $lpa, 'dst' => $dst, 'monthly_screening' => $monthly_screening,
        ];
        return response()->json($data);
    }

    protected function rules()
    {
        return [
            'attachments.*' => 'nullable|file|mimes:jpeg,png,svg,pdf|max:10000',
        ];
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
            $value = 'case_management';
        }

        return [
            'condition' => $condition,
            'value' => $value,
        ];
    }
}

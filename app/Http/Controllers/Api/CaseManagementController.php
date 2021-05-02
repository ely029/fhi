<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\CaseManagementLaboratoryResults;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\TBMacForm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CaseManagementController extends Controller
{
    public function index(TBMacFormFilters $tBMacFormFilters)
    {
        $caseManagement = TBMacForm::caseManagementForms()
            ->with('patient', 'caseManagementForm')
            ->filter($tBMacFormFilters)
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderBy('created_at')->paginate(10);

        $data = $caseManagement->map(function ($item) {
            return [
                'id' => $item->id,
                'patient_code' => $item->patient->code,
                'date_created' => $item->created_at->format('Y-m-d'),
                'facility_code' => $item->patient->facility_code,
                'status' => $item->status,
                'drug_susceptibility' => $item->caseManagementForm->current_drug_susceptibility ?? null,
            ];
        });

        return response()->json([
            'data' => $data,
        ]);
    }

    public function store()
    {
        $request = request()->all();
        $request['first_name'] = '';
        $request['middle_name'] = '';
        $patient = Patient::create($request);
        $caseManagementBactResult = new CaseManagementBacteriologicalResults();
        $caseManagementAttachment = new CaseManagementAttachments();
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
        $caseManagementBactResult->screeningTwoCreation($form, $request);

        //LPA
        $caseManagementBactResult->lpaCreation($form, $request);

        //DST
        $caseManagementBactResult->dstCreation($form, $request);

        if (isset($request['attachments'])) {
            $caseManagementAttachment->createAttachment($request, $form);
        }

        //Month DST
        $count = count(json_decode($request['month_dst'], true)) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreationMobile($screen, $eee, $request, $form);
        }
        $request['cxr_date'] = ! isset($request['cxr_date']) ? Carbon::now()->timestamp : $request['cxr_date'];
        $form->caseManagementForm()->create($request);
        unset($request['remarks']);
        $form->caseManagementLaboratoryResults()->create($request);

        return response()->json('New Case Successfully Created', 200);
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','caseManagementForm','caseManagementBacteriologicalResults','caseManagementLaboratoryResults','caseManagementAttachment','patient','recommendations']);
        $tbBacteriologicalResults = $tbMacForm->caseManagementBacteriologicalResults;
        $presentation_number = $tbMacForm->presentation_number;
        $submitted_by = $tbMacForm->submittedBy->name;
        $date_submitted = $tbMacForm->created_at->format('M d, Y');
        $status = $tbMacForm->status;
        $suggested_regimen = $tbMacForm->caseManagementForm->suggested_regimen !== '' ? $tbMacForm->caseManagementForm->suggested_regimen : '';
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

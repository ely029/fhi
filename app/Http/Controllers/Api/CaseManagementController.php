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

        return response()->json($data);
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
        $form->caseManagementLaboratoryResults()->create($request);

        return response()->json('New Case Successfully Created', 200);
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

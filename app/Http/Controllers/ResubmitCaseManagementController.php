<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\TBMacForm;

class ResubmitCaseManagementController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','caseManagementForm','caseManagementBacteriologicalResults', 'caseManagementLaboratoryResult', 'attachments', 'patient']);

        return view('case-management.resubmit.form')
            ->with('tbMacForm', $tbMacForm);
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
        //Screening 1
        $caseManagementBactResult->screeningOneUpdate($tbMacForm, $request);
        //Screening 2
        if ($tbMacForm->screenTwo()->exists()) {
            $tbMacForm->screenTwo()->delete();
        }
        if (isset($request['date_collected_screening_2'])) {
            $caseManagementBactResult->screeningTwoCreation($tbMacForm, $request);
        }
        //MOnthly Screening Deletion
        CaseManagementBacteriologicalResults::where('form_id', $tbMacForm->id)->where('smear_microscopy', '<>', '')->delete();
        //MOnthly Screening Creation
        $count = count($request['date_collected']) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreation($screen, $eee, $request, $tbMacForm);
        }
        if (isset($request['attachments'])) {
            CaseManagementAttachments::where('form_id', $tbMacForm->id)->delete();
            $caseManagementAttachment->createAttachment($request, $tbMacForm);
        }
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        $request['itr_drugs'] == null ? '' : $request['itr_drugs'];
        unset($request['remarks']);
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return redirect('case-management/show/'.$tbMacForm->id)->with([
            'alert.message' => 'Case Management resubmitted successfully.',
        ]);
    }
}

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
        $caseManagementBactResult = new CaseManagementBacteriologicalResults();
        $request['status'] = 'New Case';
        $tbMacForm->patient->update($request);
        $tbMacForm->update($request);
        $tbMacForm->caseManagementForm->update($request);
        //Screening 2
        if ($tbMacForm->screenTwo()->exists()) {
            $tbMacForm->screenTwo()->delete();
        }
        //MOnthly Screening Deletion
        CaseManagementBacteriologicalResults::where('form_id', $tbMacForm->id)->delete();
        $caseManagementBactResult->lpaCreation($tbMacForm, $request);
        $caseManagementBactResult->dstCreation($tbMacForm, $request);
        //Screening 1
        $caseManagementBactResult->screeningOneCreation($tbMacForm, $request);
        if (isset($request['date_collected_screening_2'])) {
            $caseManagementBactResult->screeningTwoCreation($tbMacForm, $request);
        }
        //MOnthly Screening Creation
        $count = count($request['date_collected']) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $eee + 1;
            $caseManagementBactResult->monthDSTCreation($screen, $eee, $request, $tbMacForm);
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
        $request['itr_drugs'] === null ? '' : $request['itr_drugs'];
        unset($request['remarks']);
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return redirect('case-management/show/'.$tbMacForm->id)->with([
            'alert.message' => 'Case Management resubmitted successfully.',
        ]);
    }
}

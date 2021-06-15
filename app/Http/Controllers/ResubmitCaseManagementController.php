<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\Geolocation;
use App\Models\TBMacForm;

class ResubmitCaseManagementController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','caseManagementForm','caseManagementBacteriologicalResults', 'caseManagementLaboratoryResult', 'attachments', 'patient']);
        $region = Geolocation::where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', ($region === null ? 'NCR' : $region->id))->pluck('name1', 'id');
        return view('case-management.resubmit.form')
            ->with('tbMacForm', $tbMacForm)
            ->with('provinces', count($provinces) > 1 ? $provinces : ['Metro Manila']);
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
        $request['others'] = $request['suggested_regimen'] === 'Other (Specify)' ? $request['others_case_management'] : null;
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
            $this->uploadAttachment($request, $tbMacForm);
        }
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;
        unset($request['remarks']);
        $tbMacForm->caseManagementLaboratoryResult->update($request);
        return redirect('case-management/show/'.$tbMacForm->id)->with([
            'alert.message' => 'Case Management resubmitted successfully.',
        ]);
    }

    private function uploadAttachment($request, $tbMacForm)
    {
        foreach ($request['attachments'] as $key => $file) {
            if (! in_array($file->extension(), ['jpg','jpeg','pdf','JPG','JPEG','png','PNG'])) {
                continue;
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$tbMacForm->presentation_number, $fileName);
            $tbMacForm->caseManagementAttachments()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
                'form_id' => $tbMacForm->id,
            ]);
        }
    }
}

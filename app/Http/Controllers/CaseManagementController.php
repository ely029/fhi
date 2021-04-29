<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\CaseManagementLaboratoryResults;
use App\Models\Patient;
use App\Models\TBMacForm;

class CaseManagementController extends Controller
{
    public function index()
    {
        $cases = TBMacForm::CaseManagementForms()
            ->with(['patient','enrollmentForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->get();

        switch (auth()->user()->role_id) {
            case 3:
                return $this->getHealthCareWorkerIndex($cases);
            case 4:
                return $this->getRegionalSecretariatIndex($cases);
            case 5:
                return $this->getRegionalTBMacIndex($cases);
            case 6:
                return $this->getRTBMacChairIndex($cases);
            case 7:
                return $this->getNationalTBMacIndex($cases);
            case 8:
                return $this->getNTBMacChairIndex($cases);
        }
    }

    public function create()
    {
        return view('case-management.create.form');
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','attachments', 'patient']);

        return view('case-management.show')
            ->with('tbMacForm', $tbMacForm);
    }

    public function store()
    {
        $request = request()->all();
        $patient = Patient::create($request);
        $caseManagementLabResult = new CaseManagementLaboratoryResults();
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
        $caseManagementLabResult->screeningOneCreation($form, $request);
        //Screening 2
        $caseManagementLabResult->screeningTwoCreation($form, $request);

        //LPA
        $caseManagementBactResult->lpaCreation($form, $request);

        //DST
        $caseManagementBactResult->dstCreation($form, $request);

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs(CaseManagementAttachments::PATH_PREFIX.'/'.$form->presentation_number, $fileName);
                $form->caseManagementAttachment()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                ]);
            }
        }

        //Month DST
        $count = count($request['date_collected']) - 1;
        for ($eee = 0; $eee <= $count; $eee++) {
            $screen = $count + 1;
            $caseManagementBactResult->monthDSTCreation($screen, $eee, $request, $form);
        }
        $request['cxr_date'] = ! isset($request['cxr_date']) ? '' : $request['cxr_date'];
        $form->caseManagementForm()->create($request);
        $form->caseManagementLaboratoryResults()->create($request);

        return redirect('case-management/show/'.$form->id)->with([
            'alert.message' => 'New Case created.',
        ]);
    }

    private function getHealthCareWorkerIndex($cases)
    {
        return view('case-management.index')
            ->with('cases', $cases);
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

    private function getRegionalSecretariatIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'New Case';
        });

        return view('case-management.index')
            ->with('pending', $pending)
            ->with('allCases', $cases);
    }

    private function getRegionalTBMacIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'Referred to Regional';
        });

        $withRecommendations = $cases->filter(function ($item) {
            return in_array($item->status, ['For approval','Other suggestions','Need Further Details','Referred to National']);
        });

        $completed = $cases->filter(function ($item) {
            return $item->status === 'Referred to Regional Chair';
        });

        return view('case-management.index')
            ->with('pending', $pending)
            ->with('withRecommendations', $withRecommendations)
            ->with('completed', $completed)
            ->with('allCases', $cases);
    }

    private function getRTBMacChairIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'Referred back to regional chair';
        });

        $referredCases = $cases->filter(function ($item) {
            return $item->status === 'Referred to Regional Chair';
        });

        $completed = $cases->filter(function ($item) {
            return in_array($item->status, ['For approval','Other suggestions','Need Further Details']);
        });

        return view('case-management.index')
            ->with('pending', $pending)
            ->with('referredCases', $referredCases)
            ->with('completed', $completed)
            ->with('allCases', $cases);
    }

    private function getNationalTBMacIndex($cases)
    {
        $referredCases = $cases->filter(function ($item) {
            return $item->status === 'Referred to National';
        });

        $allCases = $cases->filter(function ($item) {
            return in_array($item->status, ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair']);
        });

        $completed = $cases->filter(function ($item) {
            return in_array($item->status, ['Referred to National Chair']);
        });

        return view('case-management.index')
            ->with('referredCases', $referredCases)
            ->with('completed', $completed)
            ->with('allCases', $allCases);
    }

    private function getNTBMacChairIndex($cases)
    {
        $referredCases = $cases->filter(function ($item) {
            return $item->status === 'Referred to National Chair';
        });

        $allCases = $cases->filter(function ($item) {
            return in_array($item->status, ['For approval','Other suggestions','Need Further Details','Referred to Regional Chair']);
        });

        $completed = $cases->filter(function ($item) {
            return in_array($item->status, ['Referred back to regional chair']);
        });

        return view('case-management.index')
            ->with('referredCases', $referredCases)
            ->with('completed', $completed)
            ->with('allCases', $allCases);
    }
}

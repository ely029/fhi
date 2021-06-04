<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\Patient;
use App\Models\TBMacForm;

class TreatmentOutcomesController extends Controller
{
    public function index()
    {
        // $cases = TBMacForm::TreatmentOutcomeForms()
        //     ->filter($filters)
        //     ->with(['patient','treatmentOutcomeForm'])
        //     ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
        //     ->orderByDesc('created_at')->get();
        $allCases = TBMacForm::TreatmentOutcomeForms()
            ->with(['patient','treatmentOutcomeForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->get();

        switch (auth()->user()->role_id) {
            case 3:
                return $this->getHealthCareWorkerIndex($allCases);
            case 4:
                return $this->getRegionalSecretariatIndex($allCases);
            case 5:
                return $this->getRegionalTBMacIndex($allCases);
            case 6:
                return $this->getRTBMacChairIndex($allCases);
            case 7:
                return $this->getNationalTBMacIndex($allCases);
            case 8:
                return $this->getNTBMacChairIndex($allCases);
        }
    }
    public function create()
    {
        return view('treatment-outcomes.form');
    }

    public function store(StoreRequest $request)
    {
        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'treatment_outcome';
        $request['status'] = 'New Case';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['first_name'] = '';
        $request['middle_name'] = '';
        $patient = Patient::create($request);
        $request['patient_id'] = $patient->id;

        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->treatmentOutcomeForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            $this->uploadAttachment($request, $tbMacForm);
        }

        $this->createScreenings($request, $tbMacForm);
        $this->createLPADST($request, $tbMacForm);
        $this->createMonthlyScreenings($request, $tbMacForm);

        return redirect('treatment-outcomes/'.$tbMacForm->id)->with([
            'alert.message' => 'New case for treatment outcome created.',
        ]);
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','treatmentOutcomeForm','bacteriologicalResults','attachments', 'patient']);

        return view('treatment-outcomes.show')
            ->with('tbMacForm', $tbMacForm);
    }

    private function createScreenings($request, $tbMacForm)
    {
        // Screening 1
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'screenings',
            'date_collected' => $request['screening_1_date_collected'],
            'method_used' => $request['screening_1_method_used'],
            'resistance_pattern' => $request['screening_1_resistance_pattern'],
        ]);

        // Screening 2
        if (isset($request['screening_2_date_collected'])) {
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'screenings',
                'date_collected' => $request['screening_2_date_collected'],
                'method_used' => $request['screening_2_method_used'],
                'resistance_pattern' => $request['screening_2_resistance_pattern'],
            ]);
        }
    }

    private function createLPADST($request, $tbMacForm)
    {
        // LPA
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'lpa',
            'date_collected' => $request['lpa_date_collected'],
            'resistance_pattern' => $request['lpa_resistance_pattern'],
        ]);

        // DST
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
            'type' => 'dst',
            'date_collected' => $request['dst_date_collected'],
            'resistance_pattern' => $request['dst_resistance_pattern'],
            'resistance_pattern_others' => $request['dst_resistance_pattern'] === 'Other (specify)' ? $request['dst_resistance_pattern_others'] : null,
        ]);
    }

    private function createMonthlyScreenings($request, $tbMacForm)
    {
        $count = count($request['date_collected']);
        for ($xxx = 0; $xxx <= $count - 1; $xxx++) {
            $tbMacForm->treatmentOutcomeBacteriologicalResults()->create([
                'type' => 'monthly_screenings',
                'date_collected' => $request['date_collected'][$xxx],
                'smear_microscopy' => $request['smear_microscopy'][$xxx],
                'tb_lamp' => $request['tb_lamp'][$xxx],
                'culture' => $request['culture'][$xxx],
            ]);
        }
    }

    private function getHealthCareWorkerIndex($cases)
    {
        $forApproval = $cases->filter(function ($item) {
            return $item->status === 'Approved';
        });
        $otherSuggestion = $cases->filter(function ($item) {
            return $item->status === 'Other suggestions';
        });
        $needFurtherDetails = $cases->filter(function ($item) {
            return $item->status === 'Need Further Details';
        });
        $notForReferral = $cases->filter(function ($item) {
            return $item->status === 'Not for Referral';
        });
        return view('treatment-outcomes.index')
            ->with('forApproval', $forApproval)
            ->with('allCases', $cases)
            ->with('needFurtherDetails', $needFurtherDetails)
            ->with('otherSuggestion', $otherSuggestion)
            ->with('notForReferral', $notForReferral);
    }

    private function getDynamicQuery()
    {
        return [
            'condition' => getDynamicQuery()[auth()->user()->role_id]['condition'],
            'value' => getDynamicQuery()[auth()->user()->role_id]['value'],
        ];
    }

    private function getRegionalSecretariatIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'New Case';
        });

        return view('treatment-outcomes.index')
            ->with('pending', $pending)
            ->with('allCases', $cases)
            ->with('cases', $cases);
    }

    private function getRegionalTBMacIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'Referred to Regional';
        });

        $withRecommendations = $cases->filter(function ($item) {
            return in_array($item->status, ['Approved','Other suggestions','Need Further Details','Referred to national']);
        });

        $completed = $cases->filter(function ($item) {
            return $item->status === 'Referred to Regional Chair';
        });

        return view('treatment-outcomes.index')
            ->with('pending', $pending)
            ->with('withRecommendations', $withRecommendations)
            ->with('completed', $completed)
            ->with('cases', $cases);
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
            return in_array($item->status, ['Approved','Other suggestions','Need Further Details']);
        });

        return view('treatment-outcomes.index')
            ->with('pending', $pending)
            ->with('referredCases', $referredCases)
            ->with('completed', $completed)
            ->with('cases', $cases);
    }

    private function getNationalTBMacIndex($cases)
    {
        $referredCases = $cases->filter(function ($item) {
            return $item->status === 'Referred to national';
        });

        $allCases = $cases->filter(function ($item) {
            return in_array($item->status, ['Approved','Other suggestions','Need Further Details','Referred to Regional Chair']);
        });

        $completed = $cases->filter(function ($item) {
            return in_array($item->status, ['Referred to National Chair']);
        });

        return view('treatment-outcomes.index')
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
            return in_array($item->status, ['Approved','Other suggestions','Need Further Details','Referred to Regional Chair']);
        });

        $completed = $cases->filter(function ($item) {
            return in_array($item->status, ['Referred back to regional chair']);
        });

        return view('treatment-outcomes.index')
            ->with('referredCases', $referredCases)
            ->with('completed', $completed)
            ->with('allCases', $allCases);
    }

    private function uploadAttachment($request, $tbMacForm)
    {
        foreach ($request['attachments'] as $key => $file) {
            if (! in_array($file->extension(), ['jpg','jpeg','pdf','JPG','JPEG','png','PNG'])) {
                continue;
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs('private/treatment-outcomes/'.$tbMacForm->presentation_number, $fileName);
            $tbMacForm->attachments()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
            ]);
        }
    }
}

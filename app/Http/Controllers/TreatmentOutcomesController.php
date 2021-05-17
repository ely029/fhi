<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\TBMacForm;

class TreatmentOutcomesController extends Controller
{
    public function index(TBMacFormFilters $filters)
    {
        $cases = TBMacForm::TreatmentOutcomeForms()
            ->filter($filters)
            ->with(['patient','treatmentOutcomeForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->get();
        return view('treatment-outcomes.index')
            ->with('cases', $cases);
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

        $patient = Patient::create($request);
        $request['patient_id'] = $patient->id;

        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->treatmentOutcomeForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $fileName = $file->getClientOriginalName();
                $file->storeAs('private/treatment-outcomes/'.$tbMacForm->presentation_number, $fileName);
                $tbMacForm->attachments()->create([
                    'file_name' => $fileName,
                    'extension' => $file->extension(),
                ]);
            }
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

    private function getDynamicQuery()
    {
        return [
            'condition' => getDynamicQuery()[auth()->user()->role_id]['condition'],
            'value' => getDynamicQuery()[auth()->user()->role_id]['value'],
        ];
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\TreatmentOutcomes\StoreRequest;
use App\Models\CaseManagementAttachments;
use App\Models\CaseManagementBacteriologicalResults;
use App\Models\Patient;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class TreatmentOutcomesController extends Controller
{
    public function index()
    {
        // $cases = TBMacForm::TreatmentOutcomeForms()
        //     ->with(['patient','treatmentOutcomeForm'])
        //     ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
        //     ->orderByDesc('created_at')->paginate();
        
        return view('treatment-outcomes.index');
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
}

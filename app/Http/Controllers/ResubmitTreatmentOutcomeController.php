<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;
use Illuminate\Support\Facades\Storage;

class ResubmitTreatmentOutcomeController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        if (! in_array($tbMacForm->status, ['Not for Referral','Need Further Details'])) {
            abort(403);
        }

        return view('treatment-outcomes.resubmit.form')
            ->with('tbMacForm', $tbMacForm);
    }

    public function resubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['status'] = 'New Case';
        $request['first_name'] = '';
        $request['middle_name'] = '';
        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->treatmentOutcomeForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        if ($request['attachments-to-remove']) {
            $this->removeAttachments($tbMacForm, $request);
        }

        if (isset($request['attachments'])) {
            $this->createAttachment($request, $tbMacForm);
        }
        $tbMacForm->treatmentOutcomeBacteriologicalResults()->delete();
        $this->createScreenings($request, $tbMacForm);
        $this->createLPADST($request, $tbMacForm);
        $this->createMonthlyScreenings($request, $tbMacForm);

        return redirect('treatment-outcomes/'.$tbMacForm->id)->with([
            'alert.message' => 'Treatment outcome resubmitted successfully.',
        ]);
    }

    private function createAttachment($request, $tbMacForm)
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

    private function removeAttachments($tbMacForm, $request)
    {
        foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
            $path = 'private/treatment-outcomes/'.$tbMacForm->presentation_number.'/'.$toRemove;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $tbMacForm->attachments()->where('file_name', $toRemove)->delete();
        }
    }
}

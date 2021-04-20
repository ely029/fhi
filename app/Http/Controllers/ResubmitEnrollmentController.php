<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BacteriologicalResult;
use App\Models\TBMacForm;

class ResubmitEnrollmentController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        if ($tbMacForm->status !== 'Not For Referral') {
            abort(403);
        }

        return view('enrollments.resubmit.form')
            ->with('tbMacForm', $tbMacForm);
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient']);
        return view('enrollments.show')
            ->with('tbMacForm', $tbMacForm);
    }

    public function resubmit(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        unset($request['_token']);
        $request['status'] = 'New Enrollment';
        $request['cxr_reading'] = $request['cxr_reading'] ?? null;

        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->enrollmentForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        // if (isset($request['attachments'])) {
        //     foreach ($request['attachments'] as $key => $file) {
        //         $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, ($key + 1).'.'.$file->extension());
        //         $tbMacForm->attachments()->create([
        //             'extension' => $file->extension(),
        //         ]);
        //     }
        // }
        $tbMacForm->bacteriologicalResults()->delete();

        foreach (BacteriologicalResult::LABEL as $status => $label) {
            if (isset($request[$status])) {
                $this->createBacteriologicalStatus($request, $tbMacForm, $status);
            }
        }

        return redirect('enrollments/'.$tbMacForm->id)->with([
            'alert.message' => 'Enrollment resubmitted successfully.',
        ]);
    }

    private function createBacteriologicalStatus($request, $tbMacForm, $status)
    {
        foreach ($request[$status] as $key => $type) {
            $tbMacForm->bacteriologicalResults()->create([
                'type' => $status === 'others' ? 'Others-'.$request['others-specify'][$key] : $type,
                'date_collected' => $request[$type.'-date_collected'][$key],
                'name_of_laboratory' => $request[$type.'-name_of_laboratory'][$key],
                'result' => $type === 'lpa' ? json_encode($request[$type.'-'.$key.'-result']) : $request[$type.'-result'][$key],
            ]);
        }
    }
}

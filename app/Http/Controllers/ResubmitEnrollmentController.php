<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BacteriologicalResult;
use App\Models\Geolocation;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Facades\Storage;

class ResubmitEnrollmentController extends Controller
{
    public function edit(TBMacForm $tbMacForm)
    {
        if (! in_array($tbMacForm->status, ['Not For Referral','Need Further Details'])) {
            abort(403);
        }
        $region = Geolocation::where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', ($region === null ? 'NCR' : $region->id))->pluck('name1', 'id');
        return view('enrollments.resubmit.form')
            ->with('tbMacForm', $tbMacForm)
            ->with('provinces', count($provinces) > 1 ? $provinces : ['Metro Manila']);
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
        $request['itr_drugs'] = ! isset($request['itr_drugs']) ? null : $request['itr_drugs'];

        $tbMacForm->patient->update($request);

        $tbMacForm->update($request);

        $tbMacForm->enrollmentForm->update($request);
        $tbMacForm->laboratoryResults->update($request);

        if (isset($request['attachments-to-remove'])) {
            $this->removeAttachments($tbMacForm, $request);
        }

        if (isset($request['attachments'])) {
            $this->uploadAttachment($request, $tbMacForm);
        }

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

    private function removeAttachments($tbMacForm, $request)
    {
        foreach (json_decode($request['attachments-to-remove']) as $toRemove) {
            $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$toRemove;
            if (Storage::exists($path)) {
                Storage::delete($path);
            }
            $tbMacForm->attachments()->where('file_name', $toRemove)->delete();
        }
    }

    private function uploadAttachment($request, $tbMacForm)
    {
        foreach ($request['attachments'] as $key => $file) {
            if (! in_array($file->extension(), ['jpg','jpeg','pdf','JPG','JPEG','png','PNG'])) {
                continue;
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, $fileName);
            $tbMacForm->attachments()->create([
                'file_name' => $fileName,
                'extension' => $file->extension(),
            ]);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\BacteriologicalResult;
use App\Models\Patient;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;

class EnrollmentRegimentController extends Controller
{
    public function index()
    {
        $enrollments = TBMacForm::EnrollmentForms()
            ->with(['patient','enrollmentForm'])
            ->orderByDesc('created_at')->get();

        $newEnrollment = $enrollments->filter(function ($item) {
            return $item->status === 'New Enrollment';
        });

        $notForEnrollments = $enrollments->filter(function ($item) {
            return $item->status === 'Not For Enrollment';
        });

        $needFurtherDetails = $enrollments->filter(function ($item) {
            return $item->status === 'Need Further Details';
        });

        $notForReferrals = $enrollments->filter(function ($item) {
            return $item->status === 'Not For Referral';
        });

        $referredToRegional = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to Regional';
        });

        $referredToRegionalChair = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to regional chair';
        });

        $referredToNational = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to national';
        });

        $referredToNationalChair = $enrollments->filter(function ($item) {
            return $item->status === 'Referred to national chair';
        });

        $forEnrollments = $enrollments->filter(function ($item) {
            return $item->status === 'For Enrollment';
        });

        $withRecommendation = Recommendation::with('tbMacForms')->where('recommendation', '<>', null)->get();

        return view('enrollments.index')
            ->with('enrollments', $enrollments)
            ->with('forEnrollments', $forEnrollments)
            ->with('notForEnrollments', $notForEnrollments)
            ->with('needFurtherDetails', $needFurtherDetails)
            ->with('notForReferrals', $notForReferrals)
            ->with('allEnrollment', $enrollments)
            ->with('referredToRegional', $referredToRegional)
            ->with('referredToRegionalChair', $referredToRegionalChair)
            ->with('referredToNational', $referredToNational)
            ->with('withRecommendations', $withRecommendation)
            ->with('referredToNationalChair', $referredToNationalChair)
            ->with('newEnrollments', $newEnrollment);
    }

    public function create()
    {
        return view('enrollments.form');
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient']);
        return view('enrollments.show')
            ->with('tbMacForm', $tbMacForm);
    }

    public function store()
    {
        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['cxr_reading'] = isset($request['cxr_reading']) ? json_encode($request['cxr_reading']) : null;
        // $validator = Validator::make($request, [
        //     'role_id' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $patient = Patient::create($request);

        $request['patient_id'] = $patient->id;
        $tbMacForm = TBMacForm::create($request);

        $tbMacForm->enrollmentForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        if (isset($request['attachments'])) {
            foreach ($request['attachments'] as $key => $file) {
                $file->storeAs(TBMacFormAttachment::PATH_PREFIX.'/'.$tbMacForm->presentation_number, ($key + 1).'.'.$file->extension());
                $tbMacForm->attachments()->create([
                    'extension' => $file->extension(),
                ]);
            }
        }

        foreach (BacteriologicalResult::LABEL as $status => $label) {
            if (isset($request[$status])) {
                $this->createBacteriologicalStatus($request, $tbMacForm, $status);
            }
        }

        return redirect('enrollments/'.$tbMacForm->id)->with([
            'alert.message' => 'New Case for enrollment created.',
        ]);
    }
    public function sendRecommendation()
    {
        $request = request()->all();
        if (auth()->user()->role_id === 4) {
            return $this->secretariatRecommendation($request);
        }

        if (auth()->user()->role_id === 5) {
            return $this->regionalRecommendations($request);
        }

        if (auth()->user()->role_id === 6) {
            return $this->regionalChairRecommendation($request);
        }

        if (auth()->user()->role_id === 7) {
            return $this->ntbMacRecommendation($request);
        }

        if (auth()->user()->role_id === 8) {
            return $this->ntbMacChairRecommendation($request);
        }
    }

    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$fileName;

        if (\Storage::exists($path)) {
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
        abort(404, 'File does not exist!');
    }
    private function ntbMacChairRecommendation($request)
    {
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);

        return redirect('enrollments/'.$request['form_id'])->with([
            'alert.message' => 'Recommendation successfully sent',
        ]);
    }

    private function ntbMacRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred to national chair';
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);

        return redirect('enrollments/'.$request['form_id'])->with([
            'alert.message' => 'Recommendation successfully sent',
        ]);
    }

    private function secretariatRecommendation($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        if ($request['status'] === 'Not For Referral') {
            $tbMacForm->status = 'Not For Referral';
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        } else {
            $tbMacForm->status = 'Referred to Regional';
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }

        return redirect('enrollments/'.$request['form_id'])->with([
            'alert.message' => 'Recommendation successfully sent',
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

    private function regionalRecommendations($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred to regional chair';
        $tbMacForm->save();
        if ($request['status'] === 'Not for Referral' || $request['status'] === 'Need Further Details' || $request['status'] === 'Not For Enrollment' || $request['status'] === 'For Enrollment') {
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);

            return redirect('enrollments/'.$request['form_id'])->with([
                'alert.message' => 'Recommendation successfully sent',
            ]);
        }
    }

    private function regionalChairRecommendation($request)
    {
        if ($request['status'] === 'For Enrollment') {
            $tbMacForm = TBMacForm::find($request['form_id']);
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }
        if ($request['status'] === 'Not For Enrollment') {
            $tbMacForm = TBMacForm::find($request['form_id']);
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }
        if ($request['status'] === 'Need Further Details') {
            $tbMacForm = TBMacForm::find($request['form_id']);
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }
        if ($request['status'] === 'Refer to N-TBMac') {
            $tbMacForm = TBMacForm::find($request['form_id']);
            $tbMacForm->status = 'Referred to national';
            $tbMacForm->save();
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }

        return redirect('enrollments/'.$request['form_id'])->with([
            'alert.message' => 'Recommendation successfully sent',
        ]);
    }
}

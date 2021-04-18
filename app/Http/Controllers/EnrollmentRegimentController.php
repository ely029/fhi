<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Recommendation;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;

class EnrollmentRegimentController extends Controller
{
    public function index()
    {
        $enrollments = TBMacForm::EnrollmentForms()->orderByDesc('created_at')->get();

        $forEnrollments = $enrollments->filter(function ($item) {
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

        $withRecommendation = TBMacForm::with('recommendations')->get();

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
            ->with('withRecommendations', $withRecommendation);
    }

    public function create()
    {
        return view('enrollments.form');
    }

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults','attachments', 'patient', 'recommendations']);

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
        $request['patient_id'] = 0;
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

        $bacteriologicalStatuses = ['xpert_mtb_rif','xpert_mtb_rif_ultra','truenat_tb',
            'lpa',
            'smear_mic',
            'tb_lamp',
            'tb_culture',
            'dst',
            'others',
            'dst_from_other_lab',
        ];

        foreach ($bacteriologicalStatuses as $status) {
            if (isset($request[$status])) {
                $this->bacteriologicalResultsCreate($request, $status, $tbMacForm);
            }
        }

        return redirect('enrollments/'.$tbMacForm->id)->with([
            'alert.message' => 'New Case for enrollment created.',
        ]);
    }

    public function showAttachment(TBMacForm $tbMacForm, $fileName)
    {
        $path = 'private/enrollments/'.$tbMacForm->presentation_number.'/'.$fileName;

        if (\Storage::exists($path)) {
            return response(\Storage::get($path))->header('Content-Type', 'image/jpeg');
        }
        abort(404, 'File does not exist!');
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
    }

    private function secretariatRecommendation($request)
    {
        if ($request['status'] === 'Not for Referral') {
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            Recommendation::create($request);
        }

        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Refer to Regional';
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        Recommendation::create($request);

        return redirect('enrollments/'.$request['form_id'])->with([
            'alert.message' => 'Recommendation successfully sent',
        ]);
    }

    private function regionalRecommendations($request)
    {
        $tbMacForm = TBMacForm::find($request['form_id']);
        $tbMacForm->status = 'Referred to regional chair';
        $tbMacForm->save();
        if ($request['status'] === 'Not for Referral' || $request['status'] === 'Need Further Details' || $request['status'] === 'Not Recommended for Enrolment' || $request['status'] === 'Recommend for Enrolment') {
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
        if ($request['status'] === 'For Enrollment' || $request['status'] === 'Not For Enrollment' || $request['status'] === 'Need Further Details') {
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

    private function bacteriologicalResultsCreate($request, $status, $tbMacForm)
    {
        foreach ($request[$status] as $key => $type) {
            $tbMacForm->bacteriologicalResults()->create([
                'type' => $status === 'others' ? 'Others-'.$request['others-specify'][$key] : $type,
                'date_collected' => $request[$type.'-date_collected'][$key] ?? '2020-01-01',
                'name_of_laboratory' => $request[$type.'-name_of_laboratory'][$key],
                'result' => $request[$type.'-result'][$key] ?? '',
            ]);
        }
    }
}

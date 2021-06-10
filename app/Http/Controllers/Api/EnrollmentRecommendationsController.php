<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use Illuminate\Support\Str;

class EnrollmentRecommendationsController extends Controller
{
    public function index()
    {
        $withRecommendations = Recommendation::with('tbMacForms')
            ->whereHas('tbMacForms', function ($query) {
                // to update with auth user region
                $query->where('region', 'NCR');
            })
            ->where('recommendation', '<>', null)->paginate(10);

        $data = $withRecommendations->map(function ($item) {
            return [
                'id' => $item->tbMacForms->id,
                'patient_code' => $item->tbMacForms->patient->code,
                'date_created' => $item->tbMacForms->created_at->format('m-d-Y'),
                'facility_code' => $item->tbMacForms->patient->facility_code,
                'status' => $item->status === '0' ? '' : $item->status,
                'drug_susceptibility' => $item->tbMacForms->enrollmentForm->drug_susceptibility,
            ];
        });

        return response()->json([
            'data' => $data,
        ]);
    }

    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $validator = \Validator::make($request, [
            'remarks' => 'required',
            'status' => $this->statusValidation(),
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        if (auth()->user()->role_id === 4) {
            $this->secretariatRecommendation($tbMacForm, $request);
        } elseif (auth()->user()->role_id === 5) {
            $this->regionalRecommendations($tbMacForm, $request);
        } elseif (auth()->user()->role_id === 6) {
            $this->regionalChairRecommendation($tbMacForm, $request);
        } elseif (auth()->user()->role_id === 7) {
            $this->ntbMacRecommendation($tbMacForm, $request);
        } elseif (auth()->user()->role_id === 8) {
            $this->ntbMacChairRecommendation($tbMacForm, $request);
        } else {
            $this->healthWorkerRecommendation($tbMacForm, $request);
        }

        return response()->json('Recommendation successfully sent');
    }

    private function healthWorkerRecommendation($tbMacForm, $request)
    {
        if ($request['status'] === 'Not Enrolled') {
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['form_id'] = $tbMacForm->id;
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            $request['recommendation'] = $request['remarks'];
            Recommendation::create($request);
        } else {
            $tbMacForm->status = $request['status'];
            $tbMacForm->save();
            $request['form_id'] = $tbMacForm->id;
            $request['submitted_by'] = auth()->user()->id;
            $request['role_id'] = auth()->user()->role_id;
            $request['recommendation'] = $request['remarks'];
            Recommendation::create($request);
        }
    }

    private function secretariatRecommendation($tbMacForm, $request)
    {
        if ($request['status'] === 'Not For Referral' || $request['status'] === 'Need Further Details') {
            $tbMacForm->status = $request['status'];
        } else {
            $tbMacForm->status = 'Referred to Regional';
            $request['status'] = 'Referred to Regional';
        }

        $tbMacForm->save();
        $request['form_id'] = $tbMacForm->id;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }

    private function regionalRecommendations($tbMacForm, $request)
    {
        $tbMacForm->status = 'Referred to regional chair';
        $tbMacForm->save();
        // if ($request['status'] === 'Not recommended for enrollment') {
        //     $request['status'] = 'Not For Enrollment';
        // } elseif ($request['status'] === 'Recommend for enrollment') {
        //     $request['status'] = 'For Enrollment';
        // }

        $request['form_id'] = $tbMacForm->id;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }

    private function regionalChairRecommendation($tbMacForm, $request)
    {
        if ($request['status'] === 'Refer to N-TBMac') {
            $tbMacForm->status = 'Referred to national';
        } else {
            $tbMacForm->status = $request['status'];
        }

        $request['form_id'] = $tbMacForm->id;
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }

    private function ntbMacRecommendation($tbMacForm, $request)
    {
        $request['form_id'] = $tbMacForm->id;
        $tbMacForm->status = 'Referred to national chair';
        $request['status'] = 0;
        $tbMacForm->save();
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }

    private function ntbMacChairRecommendation($tbMacForm, $request)
    {
        $tbMacForm1 = TBMacForm::find($tbMacForm->id);
        // if (! isset($request['status'])) {
        //     $request['form_id'] = $tbMacForm->id;
        //     $request['status'] = 'Referred back to regional chair';
        //     $request['submitted_by'] = auth()->user()->id;
        //     $request['role_id'] = auth()->user()->role_id;
        //     $request['recommendation'] = $request['remarks'];
        //     Recommendation::create($request);
        // }
        $tbMacForm1->status = 'Referred back to regional chair';
        $tbMacForm1->role_id = auth()->user()->role_id;
        $tbMacForm1->save();
        $request['form_id'] = $tbMacForm->id;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }

    private function statusValidation()
    {
        if (auth()->user()->role_id === 4) {
            return 'required|in:Refer to RTBMAC,Not For Referral,Need Further Details';
        }
        if (auth()->user()->role_id === 5) {
            return 'required|in:Recommended for enrollment,Recommended not for enrollment,Recommended for need further details';
        }
        if (auth()->user()->role_id === 6) {
            return 'required|in:For Enrollment,Not For Enrollment,Need Further Details,Referred to national';
        }
        if (auth()->user()->role_id === 3) {
            return 'required|in:Enrolled,Not Enrolled';
        }
        if (auth()->user()->role_id === 7) {
            return 'nullable';
        }
        if (auth()->user()->role_id === 8) {
            return 'required|in:Resolved,Not resolved';
        }
    }
}

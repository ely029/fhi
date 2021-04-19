<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BacteriologicalResult;
use App\Models\Filters\TBMacFormFilters;
use App\Models\Patient;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use App\Models\TBMacFormAttachment;
use Illuminate\Support\Str;

class EnrollmentRecommendationsController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $validator = \Validator::make($request, [
            'remarks' => 'required',
            'status' => 'required|in:Refer to RTBMAC,Not For Referral',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        if (auth()->user()->role_id === 4) {
            $this->secretariatRecommendation($tbMacForm, $request);
        }

        return response()->json('Recommendation successfully sent');
    }

    private function secretariatRecommendation($tbMacForm, $request)
    {
        if ($request['status'] === 'Not For Referral') {
            $tbMacForm->status = 'Not For Referral';
        } else {
            $tbMacForm->status = 'Referred to Regional';
        }

        $tbMacForm->save();
        $request['form_id'] = $tbMacForm->id;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $request['recommendation'] = $request['remarks'];
        Recommendation::create($request);
    }
}

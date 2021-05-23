<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TBMacForm;

class TreatmentOutcomeRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $validator = \Validator::make($request, [
            'remarks' => 'required',
            'status' => treatmentOutcomeStatus()[auth()->user()->role_id],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $tbMacForm->status = $request['status'];
        $tbMacForm->save();
        $request['recommendation'] = $request['remarks'];
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $tbMacForm->recommendations()->create($request);

        return response()->json('Recommendation created Successfully', 200);
    }
}

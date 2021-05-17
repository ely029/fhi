<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Recommendation;
use App\Models\TBMacForm;
use Illuminate\Http\Request;

class CaseManagementRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $validator = \Validator::make($request, [
            'remarks' => 'required',
            'status' => caseManagementRecommendationStatus()[auth()->user()->role_id],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        $tbMacForm->status = in_array($request['status'],['Recommend for Approval','Recommend for other suggestions','Recommend for need further details']) ? 'Referred to Regional Chair' : $request['status'];
        $tbMacForm->save();
        $request['recommendation'] = $request['remarks'] ?? null;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $tbMacForm->recommendations()->create($request);

        return response()->json('Recommendation Created Successfully', 200);
    }
}

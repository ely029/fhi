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
            'remarks' => 'required_unless:status,Resolved,Referred to Regional,Approved,Resolved',
            'status' => caseManagementRecommendationStatus()[auth()->user()->role_id],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }
        if (auth()->user()->role_id === 8) {
            $tbMacForm->status = 'Referred back to regional chair';
        } else {
            $tbMacForm->status = in_array($request['status'], ['Recommended for Approval','Recommended for other suggestions','Recommended for need further details']) ? 'Referred to Regional Chair' : $request['status'];
        }
        $tbMacForm->save();
        $request['recommendation'] = $request['remarks'] ?? null;
        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;
        $tbMacForm->recommendations()->create($request);

        return response()->json('Recommendation Created Successfully', 200);
    }
}

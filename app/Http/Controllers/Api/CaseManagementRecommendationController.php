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
        $tbMacForm->status = $request['status'];
        $tbMacForm->save();
        $request['recommendation'] = $request['remarks'] ?? null;
        $request['form_id'] = $tbMacForm->id;
        $request['submitted_by'] = auth()->user()->id;
        $tbMacForm->recommendations()->create($request);

        return response()->json('Recommendation Created Successfully', 200);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;

class CaseManagementRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $tbMacForm->status = in_array($request['status'], ['Recommended for Approval','Recommended for other suggestions','Recommended for need further details']) ? 'Referred to Regional Chair' : $request['status'];
        $tbMacForm->role_id = auth()->user()->role_id;
        $tbMacForm->save();

        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;

        if (auth()->user()->role_id === 5) {
            unset($request['status']);
            $request['status'] = $request['recommendation_status'];
        }

        $tbMacForm->recommendations()->create($request);
        return redirect('case-management')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }
}

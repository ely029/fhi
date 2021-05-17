<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;

class CaseManagementRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $tbMacForm->status = in_array($request['status'],['Recommend for Approval','Recommend for other suggestions','Recommend for need further details']) ? 'Referred to Regional Chair' : $request['status'];
        $tbMacForm->save();

        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;

        $tbMacForm->recommendations()->create($request);
        return redirect('case-management')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }
}

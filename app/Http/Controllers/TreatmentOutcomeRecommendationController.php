<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;

class TreatmentOutcomeRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        if (auth()->user()->role_id === 8) {
            $tbMacForm->status = 'Referred back to regional chair';
        } else {
            $tbMacForm->status = in_array($request['status'], ['Recommended for Approval','Recommended for other suggestions','Recommended for need further details']) ? 'Referred to Regional Chair' : $request['status'];
        }
        $tbMacForm->save();

        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;

        if (auth()->user()->role_id === 5) {
            unset($request['status']);
            $request['status'] = $request['recommendation_status'];
        }

        $tbMacForm->recommendations()->create($request);
        return redirect('treatment-outcomes')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }
}

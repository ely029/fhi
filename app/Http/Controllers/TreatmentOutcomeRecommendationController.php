<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;

class TreatmentOutcomeRecommendationController extends Controller
{
    public function store(TBMacForm $tbMacForm)
    {
        $request = request()->all();
        $tbMacForm->status = $request['status'];
        $tbMacForm->save();

        $request['submitted_by'] = auth()->user()->id;
        $request['role_id'] = auth()->user()->role_id;

        $tbMacForm->recommendations()->create($request);
        return redirect('treatment-outcomes')->with([
            'recommendation' => 'Recommendation successfully sent',
        ]);
    }
}
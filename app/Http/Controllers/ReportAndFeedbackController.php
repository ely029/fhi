<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\ReportAndFeedbacks;

class ReportAndFeedbackController extends Controller
{
    public function store()
    {
        $request = request()->all();
        ReportAndFeedbacks::create([
            'role_id' => auth()->user()->role_id,
            'user_id' => auth()->user()->id,
            'issue' => $request['issue'],
            'channel' => 'Web',
        ]);

        return redirect()->back();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportAndFeedbacks;
use Illuminate\Http\Request;

class ReportAndFeedBacksController extends Controller
{
    public function store()
    {
        $request = request()->all();
        ReportAndFeedbacks::create([
            'role_id' => auth()->user()->role_id,
            'user_id' => auth()->user()->id,
            'issue' => $request['issue'],
            'channel' => 'Mobile',
        ]);

        return response()->json('Issue submit successfully');
    }
}

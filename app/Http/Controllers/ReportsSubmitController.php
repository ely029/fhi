<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Report;

class ReportsSubmitController extends Controller
{
    public function store()
    {
        $request = request()->all();

        $request['prepared_by'] = auth()->user()->id;
        $request['report_data'] = json_decode($request['report_data']);
        Report::create($request);
        return redirect('reports')->with([
            'alert.message' => 'Report submitted successfully.',
        ]);
    }
}

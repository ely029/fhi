<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;
use Illuminate\Support\Facades\Validator;

class EnrollmentRegimentController extends Controller
{
    public function create()
    {
        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';

        $validator = Validator::make($request, [
            'patient_id' => 'required',
            'status' => 'required',
            'region' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $tbForm = TBMacForm::create($request);
        $tbForm->enrollmentForm()->create($request);
        

        return true;
    }
}

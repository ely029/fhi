<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EnrolmentRegimentForm;
use App\Models\TBMacForms;
use Illuminate\Support\Facades\Validator;

class EnrolmentRegimentController extends Controller
{
    public function create()
    {
        $request = request()->all();
        $validator = Validator::make($request, [
            'submitted_by' => 'required',
            'user_id' => 'required',
            'patient_id' => 'required',
            'status' => 'required',
            'level' => 'required',
            'approved_by' => 'required',
            'region' => 'required',
            'role_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        EnrolmentRegimentForm::create($request);
        TBMacForms::create($request);
        return true;
    }
}

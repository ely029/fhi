<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;
use Illuminate\Support\Facades\Validator;

class EnrollmentRegimentController extends Controller
{

    public function index()
    {
        $enrollments = TBMacForm::EnrollmentForms()->orderBy('created_at')->get();

        $forEnrollments = $enrollments->filter(function($item){
            return $item->status == 'New Enrollment';
        });

        $notForEnrollments = $enrollments->filter(function($item){
            return $item->status == 'Not For Enrollment';
        });

        $needFurtherDetails = $enrollments->filter(function($item){
            return $item->status == 'Need Further Details';
        });

        $notForReferrals = $enrollments->filter(function($item){
            return $item->status == 'Not For Referral';
        });

        return view('enrollments.index')
            ->with('enrollments', $enrollments)
            ->with('forEnrollments', $forEnrollments)
            ->with('notForEnrollments', $notForEnrollments)
            ->with('needFurtherDetails', $needFurtherDetails)
            ->with('notForReferrals', $notForReferrals);
    }

    public function create()
    {
        return view('enrollments.form');
    }

    public function store()
    {
        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';

        // $validator = Validator::make($request, [
        //     'role_id' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $tbForm = TBMacForm::create($request);
        // $tbForm->enrollmentForm()->create($request);

        return redirect('enrollments')->with([
            'alert.message' => 'New Case for enrollment created.'
        ]);
    }
}

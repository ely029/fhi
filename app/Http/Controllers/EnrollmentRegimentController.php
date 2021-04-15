<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\EnrollmentRegimentForm;
use App\Models\TBMacForm;

use Illuminate\Support\Facades\Validator;

class EnrollmentRegimentController extends Controller
{

    public function index()
    {
        $enrollments = TBMacForm::EnrollmentForms()->orderByDesc('created_at')->get();

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

    public function show(TBMacForm $tbMacForm)
    {
        $tbMacForm = $tbMacForm->load(['submittedBy','enrollmentForm','bacteriologicalResults','laboratoryResults']);

        return view('enrollments.show')
            ->with('tbMacForm', $tbMacForm);
    }

    public function store()
    {
        $request = request()->all();
        $request['submitted_by'] = auth()->user()->id;
        $request['form_type'] = 'enrollment';
        $request['status'] = 'New Enrollment';
        $request['role_id'] = 4;
        $request['region'] = 'NCR';
        $request['cxr_reading'] = $request['cxr_reading'] ? json_encode($request['cxr_reading']) : null;

        // $validator = Validator::make($request, [
        //     'role_id' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        $tbMacForm = TBMacForm::create($request);
        $tbMacForm->enrollmentForm()->create($request);
        $tbMacForm->laboratoryResults()->create($request);

        $bacteriologicalStatuses =  ['xpert_mtb_rif','xpert_mtb_rif_ultra','truenat_tb',
        'lpa','smear_mic','tb_lamp','tb_culture','dst','others','dst_from_other_lab'];

        foreach ($bacteriologicalStatuses as $status)
        {
            if (isset($request[$status])) {

                foreach ($request[$status] as $key => $type)
                {
                    $tbMacForm->bacteriologicalResults()->create([
                        'type' => $status == 'others' ? 'Others-'.$request['others-specify'][$key] : $type,
                        'date_collected' => $request[$type.'-date_collected'][$key],
                        'name_of_laboratory' => $request[$type.'-name_of_laboratory'][$key],
                        'result' => $request[$type.'-result'][$key],
                    ]);
                } 
            }
        }
    

        return redirect('enrollments/'.$tbMacForm->id)->with([
            'alert.message' => 'New Case for enrollment created.'
        ]);
    }
}

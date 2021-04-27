<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\TBMacForm;

class CaseManagementController extends Controller
{
    public function index()
    {
        $cases = TBMacForm::CaseManagementForms()
            ->with(['patient','enrollmentForm'])
            ->where($this->getDynamicQuery()['condition'], $this->getDynamicQuery()['value'])
            ->orderByDesc('created_at')->get();

        switch (auth()->user()->role_id) {
            case 3:
                return $this->getHealthCareWorkerIndex($cases);
            case 4:
                return $this->getRegionalSecretariatIndex($cases);
            case 5:
                return $this->getHealthCareWorkerIndex($cases);
        }
       
    }

    public function create()
    {
        return view('case-management.create.form');
    }

    private function getHealthCareWorkerIndex($cases)
    {
        // $forEnrollments = $enrollments->filter(function ($item) {
        //     return $item->status === 'For Enrollment';
        // });

        // $notForEnrollments = $enrollments->filter(function ($item) {
        //     return $item->status === 'Not For Enrollment';
        // });

        // $needFurtherDetails = $enrollments->filter(function ($item) {
        //     return $item->status === 'Need Further Details';
        // });

        // $notForReferrals = $enrollments->filter(function ($item) {
        //     return $item->status === 'Not For Referral';
        // });

        return view('case-management.index')
        ->with('cases', $cases);
            // ->with('forEnrollments', $forEnrollments)
            // ->with('notForEnrollments', $notForEnrollments)
            // ->with('needFurtherDetails', $needFurtherDetails)
            // ->with('notForReferrals', $notForReferrals);
    }

    private function getDynamicQuery()
    {
        $condition = 'submitted_by';
        $value = auth()->user()->id;

        if (in_array(auth()->user()->role_id, [4,5,6])) {
            $condition = 'region';
            // change to auth user region
            $value = 'NCR';
        } elseif (in_array(auth()->user()->role_id, [7,8])) {
            $condition = 'form_type';
            $value = 'case_management';
        }

        return [
            'condition' => $condition,
            'value' => $value,
        ];
    }

    private function getRegionalSecretariatIndex($cases)
    {
        $pending = $cases->filter(function ($item) {
            return $item->status === 'New Case';
        });

        return view('case-management.index')
            ->with('pending', $pending)
            ->with('allCases', $cases);
    }
}

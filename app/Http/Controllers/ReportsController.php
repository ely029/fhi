<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Geolocation;
use App\Models\TBMacForm;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function generate()
    {
        $region = Geolocation::select('id')->where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', $region->id)->pluck('name1', 'id');
        $report = null;
        if ($period = request('period')) {

            $report['province'] = request('province');
            $report['health_facility'] = request('health_facility');
            $report['date_generated'] = Carbon::now('Asia/Manila')->format('F d, Y');
            $report['prepared_by'] = auth()->user()->itis_name;
            
            if($period === 'quarterly'){
                $report['period'] = request('quarter').' '.request('year');
                $quarterDates = $this->getDateFromToQuarterly();
                $dateFrom = $quarterDates['date_from'];
                $dateTo = $quarterDates['date_to'];
            } elseif($period === 'monthly') {
                $report['period'] = request('month').' '.request('year');
                $monthlyDates = $this->getDateFromToMonthly();
                $dateFrom = $monthlyDates['date_from'];
                $dateTo = $monthlyDates['date_to'];
            }
    

            $totalCases = TBMacForm::with('patient')->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $report['age_gender'] = [
                'enrollment' => [
                    '14_below' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    '15_above' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    'total_Male' => 0,
                    'total_Female' => 0,
                ],
                'case_management' => [
                    '14_below' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    '15_above' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    'total_Male' => 0,
                    'total_Female' => 0,
                ],
                'treatment_outcome' => [
                    '14_below' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    '15_above' => [
                        'Male' => 0,
                        'Female' => 0,
                    ],
                    'total_Male' => 0,
                    'total_Female' => 0,
                ],
            ];
            $report['resolved_cases_enrollment'] = 0;
            $report['resolved_cases_case_management'] = 0;
            $report['resolved_cases_treatment_outcome'] = 0;
            $report['not_resolved_cases_enrollment'] = 0;
            $report['not_resolved_cases_case_management'] = 0;
            $report['not_resolved_cases_treatment_outcome'] = 0;

            $totalCases = $totalCases->groupBy('form_type');
            foreach ($totalCases as $formType => $cases) {
                $this->getAgeFourteen($cases, $report, $formType);
            }
            $report['enrollment_total_case'] = isset($totalCases['enrollment']) ? count($totalCases['enrollment']) : 0;
            $report['case_total_case'] = isset($totalCases['case_management']) ? count($totalCases['case_management']) : 0;
            $report['treatment_total_case'] = isset($totalCases['treatment_outcome']) ? count($totalCases['treatment_outcome']) : 0;
            $this->getTotalMaleFemale($report);
            $this->getTotalAgeRange($report);
            $report['total_cases'] = $totalCases->count();
            $report['total_resolved'] = $report['resolved_cases_enrollment'] + $report['resolved_cases_enrollment'] + $report['resolved_cases_treatment_outcome'];
            $report['total_not_resolved'] = $report['not_resolved_cases_enrollment'] + $report['not_resolved_cases_enrollment'] + $report['not_resolved_cases_treatment_outcome'];
        }

        return view('reports.form')
            ->with('provinces', $provinces)
            ->with('report', $report);
    }

    public function getDateFromToQuarterly()
    {
        $quarter = request('quarter');
        $quarterFrom = $this->getQuarterDateFrom()[$quarter];
        $dateFrom = Carbon::parse($quarterFrom);
        $dateTo = Carbon::parse($quarterFrom)->endOfQuarter();
        return [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
    }

    public function getDateFromToMonthly()
    {
        $month = request('year').' '.request('month');
        $dateFrom = Carbon::parse($month)->startOfMonth();
        $dateTo = Carbon::parse($month)->endOfMonth();
        return [
            'date_from' => $dateFrom,
            'date_to' => $dateTo,
        ];
    }

    public function getQuarterDateFrom()
    {
        return [
            '1st Quarter' => request('year').'-01-01',
            '2nd Quarter' => request('year').'-04-01',
            '3rd Quarter' => request('year').'-07-01',
            '4th Quarter' => request('year').'-10-01',
        ];
    }

    public function getResolvedStatus()
    {
        return [
            'enrollment' => ['For Enrollment','Not For Enrollment'],
            'case_management' => ['Approved','Other suggestions'],
            'treatment_outcome' => ['Approved','Other suggestions'],
        ];
    }

    public function getNotResolvedStatus()
    {
        return [
            'enrollment' => ['Need Further Details','Referred to national','Referred to regional chair','New Enrollment'],
            'case_management' => ['Need Further Details','Referred to national','Referred to Regional Chair','New Case'],
            'treatment_outcome' => ['Need Further Details','Referred to national','Referred to Regional Chair','New Case'],
        ];
    }

    public function getTotalMaleFemale(&$report)
    {
        $enrollment = $report['age_gender']['enrollment'];
        $case = $report['age_gender']['case_management'];
        $treatment = $report['age_gender']['treatment_outcome'];

        $report['male_total'] = $enrollment['total_Male'] + $case['total_Male'] + $treatment['total_Male'];
        $report['female_total'] = $enrollment['total_Female'] + $case['total_Female'] + $treatment['total_Female'];
    }

    public function getTotalAgeRange(&$report)
    {
        $enrollment = $report['age_gender']['enrollment'];
        $case = $report['age_gender']['case_management'];
        $treatment = $report['age_gender']['treatment_outcome'];

        $totalBelowM = $enrollment['14_below']['Male'] + $case['14_below']['Male'] + $treatment['14_below']['Male'];
        $totalBelowF = $enrollment['14_below']['Female'] + $case['14_below']['Female'] + $treatment['14_below']['Female'];

        $totalAboveM = $enrollment['15_above']['Male'] + $case['15_above']['Male'] + $treatment['15_above']['Male'];
        $totalAboveF = $enrollment['15_above']['Female'] + $case['15_above']['Female'] + $treatment['15_above']['Female'];

        $report['14_below'] = $totalBelowM + $totalBelowF;
        $report['15_above'] = $totalAboveM + $totalAboveF;
    }

    private function getAgeFourteen($cases, $report, $formType)
    {
        foreach ($cases as $case) {
            if ($case->patient->age <= 14) {
                $report['age_gender'][$formType]['14_below'][$case->patient->gender] += 1;
            } else {
                $report['age_gender'][$formType]['15_above'][$case->patient->gender] += 1;
            }
            $report['age_gender'][$formType]['total_'.$case->patient->gender] += 1;
            if (in_array($case->status, $this->getResolvedStatus()[$formType])) {
                $report['resolved_cases_'.$formType] += 1;
            } elseif (in_array($case->status, $this->getNotResolvedStatus()[$formType])) {
                $report['not_resolved_cases_'.$formType] += 1;
            }
        }
    }
}

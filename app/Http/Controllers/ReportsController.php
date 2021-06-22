<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Geolocation;
use App\Models\Report;
use App\Models\TBMacForm;
use Carbon\Carbon;

class ReportsController extends Controller
{
    public function index()
    {
        $reports = Report::with('preparedBy')
            ->where('region', auth()->user()->region)
            ->orderBy('created_at', 'desc')
            ->paginate();
        return view('reports.index')
            ->with('reports', $reports);
    }

    public function generate()
    {
        $region = Geolocation::select('id')->where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', $region === null ? 'NCR' : $region->id)->pluck('name1', 'id');
        $report = null;
        $dateFrom = '';
        $dateTo = '';
        if (request('period')) {
            $report['province'] = request('province');
            $report['health_facility'] = request('health_facility');
            $report['date_generated'] = Carbon::now('Asia/Manila')->format('F d, Y');
            $report['prepared_by'] = auth()->user()->itis_name;
            $dateFrom = '';
            $dateTo = '';
            if (request('period') === 'quarterly') {
                $report['period'] = request('quarter').' '.request('year');
                $quarterDates = $this->getDateFromToQuarterly();
                $dateFrom = $quarterDates['date_from'];
                $dateTo = $quarterDates['date_to'];
            } elseif (request('period') === 'monthly') {
                $report['period'] = request('month').' '.request('year');
                $monthlyDates = $this->getDateFromToMonthly();
                $dateFrom = $monthlyDates['date_from'];
                $dateTo = $monthlyDates['date_to'];
            } else {
                $report['period'] = request('year');
                $yearlyDates = $this->getDateFromToYearly();
                $dateFrom = $yearlyDates['date_from'];
                $dateTo = $yearlyDates['date_to'];
            }
            $totalCases = TBMacForm::with(['patient','recommendations:status,created_at,role_id,form_id'])->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $this->getRTBMacUnanswered($report, $totalCases);

            $totalCases = $totalCases->groupBy('form_type');
            $report['resolved_cases_enrollment'] = 0;
            $report['resolved_cases_case_management'] = 0;
            $report['resolved_cases_treatment_outcome'] = 0;
            $report['not_resolved_cases_enrollment'] = 0;
            $report['not_resolved_cases_case_management'] = 0;
            $report['not_resolved_cases_treatment_outcome'] = 0;

            foreach ($totalCases as $formType => $cases) {
                $this->getRTBMacResolvedNotResolved($report, $cases, $formType);
            }
            $this->getAgeGenderKeys($report);

            $totalCasesForRTBMAC = TBMacForm::with(['patient','recommendations:status,created_at,role_id,form_id'])->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereHas('recommendations', function ($query) {
                $query->where('status', 'Referred to Regional');
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $this->getRTBMacAverageTime($report, $totalCasesForRTBMAC);
            $this->getRTBMacOtherInfo($report, $totalCasesForRTBMAC);

            // rtb presentation
            $report['total_cases'] = $totalCasesForRTBMAC->count();

            $totalCases = $totalCasesForRTBMAC->groupBy('form_type');
            foreach ($totalCases as $formType => $cases) {
                $this->getAgeFourteen($cases, $report, $formType);
            }
            $report['enrollment_total_case'] = isset($totalCases['enrollment']) ? count($totalCases['enrollment']) : 0;
            $report['case_total_case'] = isset($totalCases['case_management']) ? count($totalCases['case_management']) : 0;
            $report['treatment_total_case'] = isset($totalCases['treatment_outcome']) ? count($totalCases['treatment_outcome']) : 0;
            $this->getTotalMaleFemale($report);
            $this->getTotalAgeRange($report);

            $report['total_resolved'] = $report['resolved_cases_enrollment'] + $report['resolved_cases_case_management'] + $report['resolved_cases_treatment_outcome'];
            $report['total_not_resolved'] = $report['not_resolved_cases_enrollment'] + $report['not_resolved_cases_case_management'] + $report['not_resolved_cases_treatment_outcome'];
            // ntb presentation
            $totalCasesForNTBMAC = TBMacForm::with(['patient','recommendations:status,created_at,role_id,form_id'])->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereHas('recommendations', function ($query) {
                $query->where('status', 'Referred to national');
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $this->getReportForNTBMAC($report, $totalCasesForNTBMAC);
            $this->getNTBMacOtherInfo($report, $totalCasesForNTBMAC);
            $this->getNTBMacAverageTime($report, $totalCasesForNTBMAC);
        }
        return view('reports.form')
            ->with('provinces', $provinces)
            ->with('report', $report);
    }

    public function getAgeGenderKeys(&$report)
    {
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

    public function getDateFromToYearly()
    {
        $year = request('year');
        $dateFrom = Carbon::parse($year)->startOfYear();
        $dateTo = Carbon::parse($year)->endOfYear();
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
            'enrollment' => ['Need Further Details','Referred to national','Referred to regional chair','New Enrollment','Referred back to regional chair'],
            'case_management' => ['Need Further Details','Referred to national','Referred to Regional Chair','New Case','Referred back to regional chair'],
            'treatment_outcome' => ['Need Further Details','Referred to national','Referred to Regional Chair','New Case','Referred back to regional chair'],
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

    public function show(Report $report)
    {
        $reportData = (array) $report->report_data;

        return view('reports.show')
            ->with('report', $report)
            ->with('reportData', $reportData);
    }

    private function getAgeFourteen($cases, &$report, $formType)
    {
        foreach ($cases as $case) {
            if ($case->patient->age <= 14) {
                $report['age_gender'][$formType]['14_below'][$case->patient->gender] += 1;
            } else {
                $report['age_gender'][$formType]['15_above'][$case->patient->gender] += 1;
            }
            $report['age_gender'][$formType]['total_'.$case->patient->gender] += 1;
        }
    }

    private function getReportForNTBMAC(&$report, $totalCasesForNTBMAC)
    {
        $report['ntb_presentation'] = [
            'resolved' => [
                'enrollment' => 0,
                'case_management' => 0,
                'treatment_outcome' => 0,
            ],
            'not_resolved' => [
                'enrollment' => 0,
                'case_management' => 0,
                'treatment_outcome' => 0,
            ],
            'total_enrollment' => 0,
            'total_case_management' => 0,
            'total_treatment_outcome' => 0,
            'total_case' => $totalCasesForNTBMAC->count(),
        ];
        foreach ($totalCasesForNTBMAC as $case) {
            $recommendations = $case->recommendations->pluck('status')->toArray();
            if (in_array('Resolved', $recommendations)) {
                // cases N-TB MAC Chair do an action and gives recommendation (Resolved)
                $report['ntb_presentation']['resolved'][$case->form_type] += 1;
            } else {
                // cases N-TB MAC Chair give a recommendation and action (Not resolved) and unanswered from the N-TB MAC Chair
                $report['ntb_presentation']['not_resolved'][$case->form_type] += 1;
            }
            $report['ntb_presentation']['total_'.$case->form_type] += 1;
        }
        $report['ntb_presentation']['total_resolved'] = array_sum($report['ntb_presentation']['resolved']);
        $report['ntb_presentation']['total_not_resolved'] = array_sum($report['ntb_presentation']['not_resolved']);
    }

    private function getNTBMacOtherInfo(&$report, $totalCases)
    {
        // Monthly
        $groupByMonth = $totalCases->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('m');
        });
        $perMonth = [];
        foreach ($groupByMonth as $month => $items) {
            $perMonth[$month] = count($items);
        }

        $report['ntb_average_per_month'] = count($perMonth) > 0 ? ceil(array_sum($perMonth) / count($perMonth)) : 0;

        // Weekly
        $groupByWeek = $totalCases->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('W');
        });

        $perWeek = [];
        foreach ($groupByWeek as $week => $items) {
            $perWeek[$week] = count($items);
        }
        $report['ntb_average_per_week'] = count($perWeek) > 0 ? ceil(array_sum($perWeek) / count($perWeek)) : 0;
    }

    private function getRTBMacOtherInfo(&$report, $totalCases)
    {
        // Monthly
        $groupByMonth = $totalCases->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('m');
        });
        $perMonth = [];
        foreach ($groupByMonth as $month => $items) {
            $perMonth[$month] = count($items);
        }

        $report['rtb_average_per_month'] = count($perMonth) > 0 ? ceil(array_sum($perMonth) / count($perMonth)) : 0;

        // Weekly
        $groupByWeek = $totalCases->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('W');
        });

        $perWeek = [];
        foreach ($groupByWeek as $week => $items) {
            $perWeek[$week] = count($items);
        }
        $report['rtb_average_per_week'] = count($perWeek) > 0 ? ceil(array_sum($perWeek) / count($perWeek)) : 0;
    }

    private function getRTBMacAverageTime(&$report, $totalCases)
    {
        $rtbmacTaTime = [];
        foreach ($totalCases as $case) {
            $caseCreated = $case->created_at;
            $finalActionFromRTBChair = $case->recommendations->filter(function ($item) {
                return $item->role_id === 6;
            })->last();
            if (is_null($finalActionFromRTBChair)) {
                continue;
            }
            $turnAroundTime = $caseCreated->diffInDays($finalActionFromRTBChair->created_at);
            if ($turnAroundTime === 0) {
                continue;
            }
            $rtbmacTaTime[] = $turnAroundTime;
        }
        $report['rtb_mac_average_ta_time'] = count($rtbmacTaTime) > 0 ? ceil(array_sum($rtbmacTaTime) / count($rtbmacTaTime)) : 0;
    }

    private function getRTBMacResolvedNotResolved(&$report, $totalCases, $formType)
    {
        foreach ($totalCases as $case) {
            if (in_array($case->status, $this->getResolvedStatus()[$formType])) {
                $report['resolved_cases_'.$formType] += 1;
            } elseif (in_array($case->status, $this->getNotResolvedStatus()[$formType])) {
                $report['not_resolved_cases_'.$formType] += 1;
            }
        }
    }

    private function getRTBMacUnanswered(&$report, $totalCases)
    {
        $totalUnansweredFromSec = 0;
        $totalNeedFurtherDetails = 0;
        foreach ($totalCases as $case) {
            $recommendations = $case->recommendations->pluck('status')->toArray();
            // get total unanswered and need further details from sec
            if (in_array($case->status, ['New Enrollment', 'New Case'])) {
                $totalUnansweredFromSec += 1;
            }
            if ($case->status === 'Need Further Details' && count($recommendations) <= 2) {
                $totalNeedFurtherDetails += 1;
            }
        }
        $report['total_unanswered_from_sec'] = $totalUnansweredFromSec;
        $report['total_need_further_details'] = $totalNeedFurtherDetails;
    }

    private function getNTBMacAverageTime(&$report, $totalCases)
    {
        $ntbmacTaTime = [];
        foreach ($totalCases as $case) {
            $dateElevated = null;
            $finalActionFromNTBChair = null;
            $case->recommendations->map(function ($item) use (&$dateElevated, &$finalActionFromNTBChair) {
                if ($item->status === 'Referred to national') {
                    $dateElevated = $item->created_at;
                }
                if ($item->role_id === 8) {
                    $finalActionFromNTBChair = $item->created_at;
                }
            });
            if (is_null($finalActionFromNTBChair)) {
                continue;
            }

            $turnAroundTime = $dateElevated->diffInDays($finalActionFromNTBChair);
            if ($turnAroundTime === 0) {
                continue;
            }
            $ntbmacTaTime[] = $turnAroundTime;
        }

        $report['ntb_mac_average_ta_time'] = count($ntbmacTaTime) > 0 ? ceil(array_sum($ntbmacTaTime) / count($ntbmacTaTime)) : 0;
    }
}

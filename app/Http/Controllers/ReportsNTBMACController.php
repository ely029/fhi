<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Geolocation;
use App\Models\Report;
use App\Models\TBMacForm;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportsNTBMACController extends Controller
{
    public function index()
    {
        return view('reports.ntbmac.index')
            ->with('reports', Report::with('preparedBy')->orderBy('created_at', 'desc')->paginate());
    }

    public function generate()
    {
        $region = Geolocation::select('id')->where('name1', auth()->user()->region)->first();
        $provinces = Geolocation::where('PARENT_ID', $region === null ? 'NCR' : $region->id)->pluck('name1', 'id');
        $regions = Geolocation::where('glocation_level_id', 1)->get();
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
            $totalCases = TBMacForm::with('patient')->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $this->getAgeGenderKeys($report);
            // rtb presentation
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
            // ntb presentation
            $totalCasesForNTBMAC = TBMacForm::with(['patient','recommendations:status,form_id'])->whereHas('patient', function ($query) {
                $query->where('province', request('province'));
            })->whereHas('recommendations', function ($query) {
                $query->where('status', 'Referred to national');
            })->whereDate('updated_at', '>=', $dateFrom)
                ->whereDate('updated_at', '<=', $dateTo)
                ->where('region', auth()->user()->region)
                ->get();

            $this->getReportForNTBMAC($report, $totalCasesForNTBMAC);
        }
        return view('reports.ntbmac.form')
            ->with('provinces', $provinces)
            ->with('report', $report)
            ->with('regions', $regions);
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

    public function show(Report $report)
    {
        $reportData = (array) $report->report_data;

        return view('reports.ntbmac.show')
            ->with('report', $report)
            ->with('reportData', $reportData);
    }

    public function province()
    {
        $request = request()->all();
        return DB::table('glocations')->select('name1', 'id')->where('id', 'like', substr($request['region'], 0, 2).'%')->where('glocation_level_id', 2)->get();
    }
    public function getProvinceByRegion()
    {
        $request = request()->all();
        return DB::table('glocations')->select('name1', 'id')->where('id', 'like', substr($request['region'], 0, 2).'%')->where('glocation_level_id', 2)->get();
    }
    public function store()
    {
        $request = request()->all();

        $request['prepared_by'] = auth()->user()->id;
        $region = Geolocation::where('id', $request['region'])->first();
        $request['region'] = $region->name1;
        $request['report_data'] = json_decode($request['report_data']);
        Report::create($request);
        return redirect('reports')->with([
            'alert.message' => 'Report submitted successfully.',
        ]);
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
            if (in_array($case->status, $this->getResolvedStatus()[$formType])) {
                $report['resolved_cases_'.$formType] += 1;
            } elseif (in_array($case->status, $this->getNotResolvedStatus()[$formType])) {
                $report['not_resolved_cases_'.$formType] += 1;
            }
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
}

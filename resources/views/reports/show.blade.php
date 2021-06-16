@extends('layouts.app')

@section('title', 'View Report')
@section('description', 'View Report')

@section('additional_styles')
    <link type="text/css" href="{{ asset('assets/app/css/reports.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="section">
        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">View Reports</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('reports') }}">Reports</a>
                    <a class="breadcrumbs__link">View {{ $report->report_number }}</a><a class="breadcrumbs__link"></a><a
                        class="breadcrumbs__link"></a></div>
            </div>
            <div class="section__top-menu">
                <input class="section__top-trigger" type="checkbox" />
                <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
                <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png"
                        alt="warning icon" /><span>Report issue</span></span>
            </div>
        </div>
        <div class="modal" id="reportIssue" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal__background" data-dismiss="modal"></div>
            <div class="modal__container">
                <div class="modal__box">
                    <h2 class="modal__title">Report issue</h2>
                    <p class="modal__text">Please elaborate on the issue encountered,</p>
                    <form class="form form--full">
                        <div class="form__content"><textarea class="form__input form__input--message"
                                placeholder="Enter issue"></textarea><label class="form__label" for="">Report issue</label>
                        </div>
                    </form>
                    <div class="modal__button modal__button--end"><input class="button" type="submit" value="Submit" />
                    </div>
                </div>
            </div>
        </div>
        <div class="section__container">
            <form class="form" action="">
                <ul class="card card--reverse">
                    <li class="card__item">
                        <div class="grid grid--start">
                            <div class="form__content">
                                <span class="form__text"></span>
                                <h2 class="section__heading">Summary</h2>
                            </div>
                            <input class="button" id="submit_report" type="button" value="Export" />
                        </div>
                        <div class="grid">
                            <div class="form__content">
                                <span class="form__text">{{ $report->period }}</span>
                                <label class="form__label">Period</label></div>
                            <div class="form__content">
                                <span class="form__text">{{ $report->province }}</span>
                                <label class="form__label">Province</label></div>
                            <div class="form__content">
                                <span class="form__text">{{ $report->health_facility }}</span>
                                <label class="form__label">Health facility</label>
                            </div>
                            <div class="form__content">
                                <span class="form__text">{{ $report->created_at->format('Y-m-d') }}</span>
                                <label class="form__label">Date generated</label></div>
                            <div class="form__content"><span class="form__text">{{ $report->preparedBy->itis_name }}</span>
                                <label class="form__label">Prepared by</label></div>
                        </div>
                        <div class="grid">
                      
                            <div class="form__content">
                                <span class="form__text">{{ $report->remarks }}</span>
                                <label class="form__label">Remarks</label>
                            </div>
                        </div>
                        <div class="grid grid--three grid--start">
                            <div class="grid grid--column">
                                <table class="table table--reports table--full">
                                    <thead>
                                        <tr>
                                            <th class="table__head">Total cases presented to R-TB MAC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table__details">{{ $reportData['total_cases'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table--reports table--full">
                                    <thead>
                                        <tr>
                                            <th class="table__head">No. of cases resolved by R-TB MAC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="table__details">{{ $reportData['total_resolved'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <input type="hidden" id="enrollment_total_case" value="{{ $reportData['enrollment_total_case'] }}">
                            <input type="hidden" id="case_total_case" value="{{ $reportData['case_total_case'] }}">
                            <input type="hidden" id="treatment_total_case" value="{{ $reportData['treatment_total_case'] }}">
                            <input type="hidden" id="male_total" value="{{ $reportData['male_total'] }}">
                            <input type="hidden" id="female_total" value="{{ $reportData['female_total'] }}">
                            <input type="hidden" id="14_below" value="{{ $reportData['14_below'] }}">
                            <input type="hidden" id="15_above" value="{{ $reportData['15_above'] }}">
                            <input type="hidden" id="total_resolved" value="{{ $reportData['total_resolved'] }}">
                            <input type="hidden" id="total_not_resolved" value="{{ $reportData['total_not_resolved'] }}">
                    
                            <div class="grid grid--column"><canvas class="chart" id="chartPresented"> </canvas><canvas class="chart"
                                    id="chartSex"></canvas></div>
                            <div class="grid grid--column"><canvas class="chart" id="chartStatus"></canvas><canvas class="chart"
                                    id="chartAge"></canvas></div>
                        </div>
                    </li>
                    <li class="card__item">
                        <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by resolution
                            {{ $report->period }}</h2>
                        <table class="table table--reports">
                            <thead>
                                <tr>
                                    <th class="table__head">Reason for Presentation to</th>
                                    <th class="table__head">Resolved</th>
                                    <th class="table__head">Not Resolved</th>
                                    <th class="table__head">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table__details">Enrollment</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_enrollment'] }}</td>
                                    <td class="table__details">{{ $reportData['not_resolved_cases_enrollment'] }}</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_enrollment'] + $reportData['not_resolved_cases_enrollment']  }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Case Management</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_case_management'] }}</td>
                                    <td class="table__details">{{ $reportData['not_resolved_cases_case_management'] }}</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_case_management'] + $reportData['not_resolved_cases_case_management'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Treatment Outcome</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_treatment_outcome'] }}</td>
                                    <td class="table__details">{{ $reportData['not_resolved_cases_treatment_outcome'] }}</td>
                                    <td class="table__details">{{ $reportData['resolved_cases_treatment_outcome'] + $reportData['not_resolved_cases_treatment_outcome'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Total</td>
                                    <td class="table__details table__details--green">{{ $reportData['total_resolved'] }}</td>
                                    <td class="table__details table__details--green">{{ $reportData['total_not_resolved'] }}</td>
                                    <td class="table__details table__details--green">{{ $reportData['total_resolved'] + $reportData['total_not_resolved'] }}</td>
                                </tr>
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td>{{ $reportData['total_unanswered_from_sec']}} unanswered forms from the secretariat
                                    <br>{{ $reportData['total_need_further_details']}} need further details from the secretariat</td>
                                    <td>
                              </tr>
                            </tbody>
                        </table>
                    </li>
                    <li class="card__item">
                        <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by age and sex
                            {{ $report->period }}</h2>
                        <table class="table table--reports">
                            <thead>
                                <tr>
                                    <th class="table__head table__head--white"></th>
                                    <th class="table__head" colspan="2">Children &lt; 15 years old</th>
                                    <th class="table__head" colspan="2">Adults ≥ 15 years old</th>
                                    <th class="table__head" colspan="2">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th class="table__head">Reason for presentation</th>
                                    <th class="table__head">M</th>
                                    <th class="table__head">F</th>
                                    <th class="table__head">M</th>
                                    <th class="table__head">F</th>
                                    <th class="table__head">M</th>
                                    <th class="table__head">F</th>
                                </tr>
                                <tr>
                                    @php
                                        $enrollment = $reportData['age_gender']['enrollment'];
                                        $case = $reportData['age_gender']['case_management'];
                                        $treatment = $reportData['age_gender']['treatment_outcome'];
                                        $totalBelowM = $enrollment['14_below']['Male'] + $case['14_below']['Male'] + $treatment['14_below']['Male'];
                                        $totalBelowF = $enrollment['14_below']['Female'] + $case['14_below']['Female'] + $treatment['14_below']['Female'];
                                        $totalAboveM = $enrollment['15_above']['Male'] + $case['15_above']['Male'] + $treatment['15_above']['Male'];
                                        $totalAboveF = $enrollment['15_above']['Female'] + $case['15_above']['Female'] + $treatment['15_above']['Female'];
                                    @endphp
                                    <td class="table__details">Enrollment</td>
                                    <td class="table__details">{{ $enrollment['14_below']['Male'] }}</td>
                                    <td class="table__details">{{ $enrollment['14_below']['Female'] }}</td>
                                    <td class="table__details">{{ $enrollment['15_above']['Male'] }}</td>
                                    <td class="table__details">{{ $enrollment['15_above']['Female'] }}</td>
                                    <td class="table__details">{{ $enrollment['total_Male'] }}</td>
                                    <td class="table__details">{{ $enrollment['total_Female'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Case Management</td>
                                    <td class="table__details">{{ $case['14_below']['Male'] }}</td>
                                    <td class="table__details">{{ $case['14_below']['Female'] }}</td>
                                    <td class="table__details">{{ $case['15_above']['Male'] }}</td>
                                    <td class="table__details">{{ $case['15_above']['Female'] }}</td>
                                    <td class="table__details">{{ $case['total_Male'] }}</td>
                                    <td class="table__details">{{ $case['total_Female'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Treatment Outcome</td>
                                    <td class="table__details">{{ $treatment['14_below']['Male'] }}</td>
                                    <td class="table__details">{{ $treatment['14_below']['Female'] }}</td>
                                    <td class="table__details">{{ $treatment['15_above']['Male'] }}</td>
                                    <td class="table__details">{{ $treatment['15_above']['Female'] }}</td>
                                    <td class="table__details">{{ $treatment['total_Male'] }}</td>
                                    <td class="table__details">{{ $treatment['total_Female'] }}</td>
                                </tr>
                                <tr>
                                    <td class="table__details">Total</td>
                                    <td class="table__details table__details--green">{{ $totalBelowM }}</td>
                                    <td class="table__details table__details--green">{{ $totalBelowF }}</td>
                                    <td class="table__details table__details--green">{{ $totalAboveM }}</td>
                                    <td class="table__details table__details--green">{{ $totalAboveF }}</td>
                                    <td class="table__details table__details--green">{{ $report['male_total'] }}</td>
                                    <td class="table__details table__details--green">{{ $report['female_total'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </li>
                    {{-- N-TB MAC --}}
                    <li class="card__item">
                        <div class="grid grid--start">
                          <div class="form__content">
                            <span class="form__text">{{ $report->period }}</span>
                            <h2 class="section__heading">Summary</h2>
                          </div>
                        </div>
                        <div class="grid grid--three grid--start">
                          <div class="grid grid--column">
                            <table class="table table--reports table--full">
                              <thead>
                                <tr>
                                  <th class="table__head">Total cases presented to N-TB MAC</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="table__details">{{ $reportData['ntb_presentation']['total_case'] }}</td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table--reports table--full">
                              <thead>
                                <tr>
                                  <th class="table__head">No. of cases resolved by N-TB MAC Chair</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td class="table__details">{{ $reportData['ntb_presentation']['total_resolved'] }}</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                          <input type="hidden" id="ntb_enrollment_total_case" value="{{ $reportData['ntb_presentation']['total_enrollment'] }}">
                          <input type="hidden" id="ntb_case_total_case" value="{{ $reportData['ntb_presentation']['total_case_management'] }}">
                          <input type="hidden" id="ntb_treatment_total_case" value="{{ $reportData['ntb_presentation']['total_treatment_outcome'] }}">
                          <input type="hidden" id="ntb_total_resolved" value="{{ $reportData['ntb_presentation']['total_resolved'] }}">
                          <input type="hidden" id="ntb_total_not_resolved" value="{{ $reportData['ntb_presentation']['total_not_resolved'] }}">
                          <div class="grid grid--column"><canvas class="chart" id="chartPresentedNTB"> </canvas></div>
                          <div class="grid grid--column"><canvas class="chart" id="chartStatusNTB"></canvas></div>
                        </div>
                      </li>
                      <li class="card__item">
                        <h2 class="section__heading section__heading--full">Breakdown of all cases presented to N-TB MAC by resolution {{ $report->period }}</h2>
                        <table class="table table--reports">
                          <thead>
                            <tr>
                              <th class="table__head">Reason for Presentation to</th>
                              <th class="table__head">Resolved</th>
                              <th class="table__head">Not Resolved</th>
                              <th class="table__head">Total</th>
                            </tr>
                          </thead>
                          <tbody>
                            @php
                              $r = $reportData['ntb_presentation']['resolved'];
                              $nr = $reportData['ntb_presentation']['not_resolved'];
                            @endphp
                          <tr>
                            <td class="table__details">Enrollment</td>
                            <td class="table__details">{{ $r['enrollment'] }}</td>
                            <td class="table__details">{{ $nr['enrollment'] }}</td>
                            <td class="table__details">{{ $r['enrollment'] + $nr['enrollment'] }}</td>
                          </tr>
                          <tr>
                            <td class="table__details">Case Management</td>
                            <td class="table__details">{{ $r['case_management'] }}</td>
                            <td class="table__details">{{ $nr['case_management'] }}</td>
                            <td class="table__details">{{ $r['case_management'] + $nr['case_management'] }}</td>
                          </tr>
                          <tr>
                            <td class="table__details">Treatment Outcome</td>
                            <td class="table__details">{{ $r['treatment_outcome'] }}</td>
                            <td class="table__details">{{ $nr['treatment_outcome'] }}</td>
                            <td class="table__details">{{ $r['treatment_outcome'] + $nr['treatment_outcome'] }}</td>
                          </tr>
                          <tr>
                            <td class="table__details">Total</td>
                            <td class="table__details table__details--green">{{ $reportData['ntb_presentation']['total_resolved'] }}</td>
                            <td class="table__details table__details--green">{{ $reportData['ntb_presentation']['total_not_resolved'] }}</td>
                            <td class="table__details table__details--green">{{ $reportData['ntb_presentation']['total_case'] }}</td>
                          </tr>
                        </tbody>
                        </table>
                      </li>
                      <li class="card__item">
                        <h2 class="section__heading">Other info</h2>
                        <table class="table table--reports table--half">
                          <tbody>
                            <tr>
                              <th class="table__head">R-TB MAC Average Turnaround Time</th>
                              <td class="table__details">{{ $reportData['rtb_mac_average_ta_time'] }}</td>
                            </tr>
                            <tr>
                              <th class="table__head">N-TB MAC Average Turnaround Time</th>
                              <td class="table__details">{{ $reportData['ntb_mac_average_ta_time'] }}</td>
                            </tr>
                            <tr>
                              <th class="table__head">Average no. of Presentations per week R-TB MAC</th>
                              <td class="table__details">{{ $reportData['rtb_average_per_week'] }}</td>
                            </tr>
                            <tr>
                              <th class="table__head">Average no. of Presentations per month R-TB MAC</th>
                              <td class="table__details">{{ $reportData['rtb_average_per_month'] }}</td>
                            </tr>
                            <tr>
                              <th class="table__head">Average no. of Presentations per week N-TB MAC</th>
                              <td class="table__details">{{ $reportData['ntb_average_per_week'] }}</td>
                            </tr>
                            <tr>
                              <th class="table__head">Average no. of Presentations per month N-TB MAC</th>
                              <td class="table__details">{{ $reportData['ntb_average_per_month'] }}</td>
                            </tr>
                          </tbody>
                        </table>
                      </li>
                </ul>
            </form>
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/report.js') }}"></script>
@endsection
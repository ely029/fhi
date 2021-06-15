<li class="card__item">
    <div class="grid grid--start">
        <div class="form__content">
            <span class="form__text">{{ $report['period'] }}</span>
            <h2 class="section__heading">Summary</h2>
        </div>
        <input class="button" id="submit_report" type="button" value="Submit" />
    </div>
    <div class="grid">
        <div class="form__content">
            <span class="form__text">{{ $report['province'] }}</span>
            <label class="form__label">Province</label></div>
        <div class="form__content">
            <span class="form__text">{{ $report['health_facility'] }}</span>
            <label class="form__label">Health facility</label>
        </div>
        <div class="form__content">
            <span class="form__text">{{ $report['date_generated'] }}</span>
            <label class="form__label">Date generated</label></div>
        <div class="form__content"><span class="form__text">{{ $report['prepared_by'] }}</span>
            <label class="form__label">Prepared by</label></div>
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
                        <td class="table__details">{{ $report['total_cases'] }}</td>
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
                        <td class="table__details">{{ $report['total_resolved'] }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" id="enrollment_total_case" value="{{ $report['enrollment_total_case'] }}">
        <input type="hidden" id="case_total_case" value="{{ $report['case_total_case'] }}">
        <input type="hidden" id="treatment_total_case" value="{{ $report['treatment_total_case'] }}">
        <input type="hidden" id="male_total" value="{{ $report['male_total'] }}">
        <input type="hidden" id="female_total" value="{{ $report['female_total'] }}">
        <input type="hidden" id="14_below" value="{{ $report['14_below'] }}">
        <input type="hidden" id="15_above" value="{{ $report['15_above'] }}">
        <input type="hidden" id="total_resolved" value="{{ $report['total_resolved'] }}">
        <input type="hidden" id="total_not_resolved" value="{{ $report['total_not_resolved'] }}">

        <div class="grid grid--column"><canvas class="chart" id="chartPresented"> </canvas><canvas class="chart"
                id="chartSex"></canvas></div>
        <div class="grid grid--column"><canvas class="chart" id="chartStatus"></canvas><canvas class="chart"
                id="chartAge"></canvas></div>
    </div>
</li>
<li class="card__item">
    <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by resolution
        {{ $report['period'] }}</h2>
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
                <td class="table__details">{{ $report['resolved_cases_enrollment'] }}</td>
                <td class="table__details">{{ $report['not_resolved_cases_enrollment'] }}</td>
                <td class="table__details">{{ $report['resolved_cases_enrollment'] + $report['not_resolved_cases_enrollment']  }}</td>
            </tr>
            <tr>
                <td class="table__details">Case Management</td>
                <td class="table__details">{{ $report['resolved_cases_case_management'] }}</td>
                <td class="table__details">{{ $report['not_resolved_cases_case_management'] }}</td>
                <td class="table__details">{{ $report['resolved_cases_case_management'] + $report['not_resolved_cases_case_management'] }}</td>
            </tr>
            <tr>
                <td class="table__details">Treatment Outcome</td>
                <td class="table__details">{{ $report['resolved_cases_treatment_outcome'] }}</td>
                <td class="table__details">{{ $report['not_resolved_cases_treatment_outcome'] }}</td>
                <td class="table__details">{{ $report['resolved_cases_treatment_outcome'] + $report['not_resolved_cases_treatment_outcome'] }}</td>
            </tr>
            <tr>
                <td class="table__details">Total</td>
                <td class="table__details table__details--green">{{ $report['total_resolved'] }}</td>
                <td class="table__details table__details--green">{{ $report['total_not_resolved'] }}</td>
                <td class="table__details table__details--green">{{ $report['total_resolved'] + $report['total_not_resolved'] }}</td>
            </tr>
        </tbody>
    </table>
</li>
<li class="card__item">
    <h2 class="section__heading section__heading--full">Breakdown of all cases presented to R-TB MAC by age and sex
        {{ $report['period'] }}</h2>
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
                    $enrollment = $report['age_gender']['enrollment'];
                    $case = $report['age_gender']['case_management'];
                    $treatment = $report['age_gender']['treatment_outcome'];
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
        <span class="form__text">1st Quarter 2021 </span>
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
              <td class="table__details">{{ $report['ntb_presentation']['total_case'] }}</td>
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
              <td class="table__details">{{ $report['ntb_presentation']['total_resolved'] }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      <input type="hidden" id="ntb_enrollment_total_case" value="{{ $report['ntb_presentation']['total_enrollment'] }}">
      <input type="hidden" id="ntb_case_total_case" value="{{ $report['ntb_presentation']['total_case_management'] }}">
      <input type="hidden" id="ntb_treatment_total_case" value="{{ $report['ntb_presentation']['total_treatment_outcome'] }}">
      <input type="hidden" id="ntb_total_resolved" value="{{ $report['ntb_presentation']['total_resolved'] }}">
      <input type="hidden" id="ntb_total_not_resolved" value="{{ $report['ntb_presentation']['total_not_resolved'] }}">
      <div class="grid grid--column"><canvas class="chart" id="chartPresentedNTB"> </canvas></div>
      <div class="grid grid--column"><canvas class="chart" id="chartStatusNTB"></canvas></div>
    </div>
  </li>
  <li class="card__item">
    <h2 class="section__heading section__heading--full">Breakdown of all cases presented to N-TB MAC by resolution {{ $report['period'] }}</h2>
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
            $r = $report['ntb_presentation']['resolved'];
            $nr = $report['ntb_presentation']['not_resolved'];
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
          <td class="table__details table__details--green">{{ $report['ntb_presentation']['total_resolved'] }}</td>
          <td class="table__details table__details--green">{{ $report['ntb_presentation']['total_not_resolved'] }}</td>
          <td class="table__details table__details--green">{{ $report['ntb_presentation']['total_case'] }}</td>
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
          <td class="table__details">{{ $report['rtb_mac_average_ta_time'] }}</td>
        </tr>
        <tr>
          <th class="table__head">N-TB MAC Average Turnaround Time</th>
          <td class="table__details">{{ $report['ntb_mac_average_ta_time'] }}</td>
        </tr>
        <tr>
          <th class="table__head">Average no. of Presentations per week</th>
          <td class="table__details">666</td>
        </tr>
        <tr>
          <th class="table__head">Average no. of Presentations per month</th>
          <td class="table__details">666</td>
        </tr>
      </tbody>
    </table>
  </li>
<div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Pending ({{ $referred->count() }})</li>
          <li class="tabs__item">Completed ({{ $completed->count() }})</li>
          <li class="tabs__item">Pending from N-TB MAC Chair ({{ $pendingFromNTBMacChair->count() }})</li>
          <li class="tabs__item">All enrollments ({{ $allEnrollments->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Health facility</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($referred as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id.'?from_tab=referred') }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
 
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="tabs__details">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Facility code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($completed as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
 
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="tabs__details">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Facility code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pendingFromNTBMacChair as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id.'?from_tab=pending') }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
 
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="tabs__details">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Facility code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollments as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
 
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
</div>
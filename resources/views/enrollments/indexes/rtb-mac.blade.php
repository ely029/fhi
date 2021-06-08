<div class="section__container">
    @include('partials.alerts')

    <div class="section__content">
      <ul class="tabs__list tabs__list--table">
        <li class="tabs__item js-tabs js-tabs-current">Pending ({{ $pending->count() }})</li>
        <li class="tabs__item js-tabs">Completed ({{ $completed->count() }})</li>
        <li class="tabs__item js-tabs">With consensus ({{$withRecommendations->count()}})</li>
        <li class="tabs__item js-tabs">All enrollments ({{ $allEnrollments->count() }})</li>
      </ul>
      <div class="tabs__details js-tabs-details js-tabs-details-active">
        <table class="table table--filter js-table">
          <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Health facility</th>
              <th class="table__head">Province</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Drug susceptibility</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pending as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id.'?from_tab=pending') }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                <td class="table__details">
                {{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}
                </td>
                <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                <td class="table__details">{{ $enrollment->status }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <div class="tabs__details js-tabs-details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Facility code</th>
              <th class="table__head">Province</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Drug susceptibility</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($completed as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                <td class="table__details">
                {{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}
                </td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
                <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                <td class="table__details">{{ $enrollment->status }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tabs__details js-tabs-details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Facility code</th>
              <th class="table__head">Province</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Drug susceptibility</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($withRecommendations as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                <td class="table__details">
                {{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}
                </td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
                <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                <td class="table__details">{{ $enrollment->status }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
      <div class="tabs__details js-tabs-details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Facility code</th>
              <th class="table__head">Province</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Drug susceptibility</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($allEnrollments as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                <td class="table__details">
                {{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}
                </td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
                <td class="table__details">{{ $enrollment->created_at->format('m-d-Y')}}</td>
                <td class="table__details">{{ $enrollment->status }}</td>
              </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
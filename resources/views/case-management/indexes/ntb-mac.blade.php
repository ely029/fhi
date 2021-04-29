<div class="section__container">
    @include('partials.alerts')

    <div class="section__content">
      <ul class="tabs__list tabs__list--table">
        <li class="tabs__item tabs__item--current">Referred cases ({{ $referredCases->count() }})</li>
        <li class="tabs__item">Completed ({{ $completed->count() }})</li>
        <li class="tabs__item">All Cases ({{ $allCases->count() }})</li>
      </ul>
      <div class="tabs__details tabs__details--active">
        <table class="table table--filter js-table">
          <thead>
            <tr>
              <th class="table__head">Presentation No.</th>
              <th class="table__head">Patient Initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Gender</th>
              <th class="table__head">Current Drug Susceptibility</th>
              <th class="table__head">Date submitted by Health Care Worker</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($referredCases as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('case-management/show/'.$enrollment->id.'?from_tab=referred') }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
                <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Current Drug Susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
            @foreach($completed as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('case-management/'.$enrollment->id) }}">
              <td class="table__details">{{ $enrollment->presentation_number }}</td>
              <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
              <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
              <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
              <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
              <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Current Drug Susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
            @foreach($allCases as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('case-management/'.$enrollment->id) }}">
              <td class="table__details">{{ $enrollment->presentation_number }}</td>
              <td class="table__details">{{ empty($enrollment->patient->initials) ? '' : $enrollment->patient->initials}}</td>
              <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
              <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
              <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
              <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
              <td class="table__details">{{ $enrollment->status }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
<div class="section__container">
    @include('partials.alerts')

    <div class="section__content">
      <ul class="tabs__list tabs__list--table">
        <li class="tabs__item js-tabs js-tabs-current">Pending ({{ $pending->count() }})</li>
        <li class="tabs__item js-tabs">Need Further Details ({{ $needFurtherDetails->count() }})</li>
        <li class="tabs__item js-tabs">All cases ({{ $allCases->count() }})</li>
      </ul>
      <div class="tabs__details js-tabs-details js-tabs-details-active">
        <table class="table table--filter js-table">
          <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Updated drug susceptibility</th>
              <th class="table__head">Date submitted</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($pending as $case)
              <tr class="table__row js-view" data-href="{{ url('case-management/show/'.$case->id.'?from_tab=pending') }}">
                <td class="table__details">{{ $case->presentation_number }}</td>
                <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
                <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
                <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
                <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
                <td class="table__details">{{ $case->created_at->format('m-d-Y')}}</td>
                <td class="table__details">{{ $case->status }}</td>
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
                <th class="table__head">Patient initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted</th>
                <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
            @foreach($needFurtherDetails as $case)
            <tr class="table__row js-view" data-href="{{ url('case-management/show/'.$case->id) }}">
              <td class="table__details">{{ $case->presentation_number }}</td>
              <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
              <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
              <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
              <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
              <td class="table__details">{{ $case->created_at->format('m-d-Y')}}</td>
              <td class="table__details">{{ $case->status }}</td>
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
                <th class="table__head">Patient initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted</th>
                <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
            @foreach($allCases as $case)
            <tr class="table__row js-view" data-href="{{ url('case-management/show/'.$case->id) }}">
              <td class="table__details">{{ $case->presentation_number }}</td>
              <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
              <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
              <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
              <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
              <td class="table__details">{{ $case->created_at->format('m-d-Y')}}</td>
              <td class="table__details">{{ $case->status }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
</div>
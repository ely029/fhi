<div class="section__container">
    @include('partials.alerts')

    <div class="section__content">
    <ul class="tabs__list tabs__list--table">
    {{--<a href="{{ url('treatment-outcomes?status=Referred to N-TB MAC') }}">
            <li class="tabs__item {{ request('status') == 'Referred to National' ? 'tabs__item--current' : ''}}">Pending({{ $referredCases->count() }})</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=Referred to National Chair') }}">
            <li class="tabs__item {{ request('status') == 'Referred to National Chair' ? 'tabs__item--current' : ''}}">Completed({{ $completed->count() }})</li>
        </a>
    <a href="{{ url('treatment-outcomes?treatmentOutcomeTabs=all_cases_ntb') }}">
            <li class="tabs__item {{ request('treatmentOutcomeTabs') == 'all_cases_ntb' ? 'tabs__item--current' : ''}}">All cases({{ $allCases->count() }})</li>
        </a>--}}
        <li class="tabs__item js-tabs js-tabs-current">Pending ({{ $referredCases->count() }})</li>
        <li class="tabs__item js-tabs">Completed ({{ $completed->count() }})</li>
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
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($referredCases as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab='.$case->status)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->treatmentOutcomeForm->current_drug_susceptibility }}</td>
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
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($completed as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab='.$case->status)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->treatmentOutcomeForm->current_drug_susceptibility }}</td>
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
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($allCases as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab='.$case->status)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->treatmentOutcomeForm->current_drug_susceptibility }}</td>
            <td class="table__details">{{ $case->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{ $case->status }}</td>
            </tr>
        @endforeach
          </tbody>
        </table>
      </div>
        </table>
      </div>
    </div>
</div>
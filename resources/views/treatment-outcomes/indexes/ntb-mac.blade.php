<div class="section__container">
    @include('partials.alerts')

    <div class="section__content">
    <ul class="tabs__list tabs__list--table">
    <a href="{{ url('treatment-outcomes?treatmentOutcomeTabs=all_cases') }}">
            <li class="tabs__item {{ request('treatmentOutcomeTabs') == 'all_cases' ? 'tabs__item--current' : ''}}">All Cases</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=Referred to Regional Chair') }}">
            <li class="tabs__item {{ request('status') == 'Referred to Regional Chair' ? 'tabs__item--current' : ''}}">Referred Cases</li>
        </a>
        <a href="{{ url('treatment-outcomes?treatmentOutcomeTabs=with_recommendations') }}">
            <li class="tabs__item {{ request('treatmentOutcomeTabs') == 'with_recommendations' ? 'tabs__item--current' : ''}}">Pending From N-TB MAC Chair</li>
        </a>
        <a href="{{ url('treatment-outcomes?treatmentOutcomeTabs=completed') }}">
            <li class="tabs__item {{ request('treatmentOutcomeTabs') == 'completed' ? 'tabs__item--current' : ''}}">Completed</li>
        </a>
    </ul>
      <div class="tabs__details tabs__details--active">
        <table class="table table--filter js-table">
          <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted by Health Care Worker</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
          @foreach($cases as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab='.request('status'))}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->treatmentOutcomeForm->current_drug_susceptibility }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
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
<div class="section__container">
    <a class="button button--create" href="{{ url('enrollments/create') }}">Create new enrollment</a>
  
    @include('partials.alerts')

    <div class="section__content">
      <ul class="tabs__list tabs__list--table">
        <li class="tabs__item tabs__item--current">All enrollments</li>
        <li class="tabs__item">For enrollment ({{ $forEnrollments->count() }})</li>
        <li class="tabs__item">Not for enrollment ({{ $notForEnrollments->count() }})</li>
        <li class="tabs__item">Need further details ({{ $needFurtherDetails->count() }})</li>
        <li class="tabs__item">Not for referral ({{ $notForReferrals->count() }})</li>
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
              <th class="table__head">Date submitted to R-TB MAC</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($enrollments as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ $enrollment->patient->code }}</td>
                <td class="table__details">{{ $enrollment->patient->age }}</td>
                <td class="table__details">{{ $enrollment->patient->gender }}</td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
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
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted to R-TB MAC</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($forEnrollments as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ $enrollment->patient->code }}</td>
                <td class="table__details">{{ $enrollment->patient->age }}</td>
                <td class="table__details">{{ $enrollment->patient->gender }}</td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
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
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted to R-TB MAC</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notForEnrollments as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ $enrollment->patient->code }}</td>
                <td class="table__details">{{ $enrollment->patient->age }}</td>
                <td class="table__details">{{ $enrollment->patient->gender }}</td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
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
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted to R-TB MAC</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($needFurtherDetails as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id.'?from_tab=need_further_details') }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ $enrollment->patient->code }}</td>
                <td class="table__details">{{ $enrollment->patient->age }}</td>
                <td class="table__details">{{ $enrollment->patient->gender }}</td>
                <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility }}</td>
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
              <th class="table__head">Patient initials</th>
              <th class="table__head">Age</th>
              <th class="table__head">Sex</th>
              <th class="table__head">Current drug susceptibility</th>
              <th class="table__head">Date submitted to R-TB MAC</th>
              <th class="table__head">Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($notForReferrals as $enrollment)
            <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id.'?from_tab=not_for_referral') }}">
                <td class="table__details">{{ $enrollment->presentation_number }}</td>
                <td class="table__details">{{ $enrollment->patient->code }}</td>
                <td class="table__details">{{ $enrollment->patient->age }}</td>
                <td class="table__details">{{ $enrollment->patient->gender }}</td>
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
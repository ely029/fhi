<div class="section__container">
    <a class="button button--create" href="{{url('treatment-outcomes/create') }}">Create new case</a>

    @include('partials.alerts')

    <div class="section__content">
    <ul class="tabs__list tabs__list--table">
        {{-- <a href="{{ url('treatment-outcomes') }}">
            <li class="tabs__item {{ request('status') == '' ? 'tabs__item--current' : ''}}">All cases({{$cases->count()}})</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=For approval') }}">
            <li class="tabs__item {{ request('status') == 'For approval' ? 'tabs__item--current' : ''}}">For approval({{$forApproval->count()}})</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=Other suggestions') }}">
            <li class="tabs__item {{ request('status') == 'Other suggestions' ? 'tabs__item--current' : ''}}">Other suggestions({{$otherSuggestion->count()}})</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=Need Further Details') }}">
            <li class="tabs__item {{ request('status') == 'Need Further Details' ? 'tabs__item--current' : ''}}">Need further details({{$needFurtherDetails->count()}})</li>
        </a>
        <a href="{{ url('treatment-outcomes?status=Not for Referral') }}">
            <li class="tabs__item {{ request('status') == 'Not for Referral' ? 'tabs__item--current' : ''}}">Not for referral({{$notForReferral->count()}})</li>
        </a>--}} 
        <li class="tabs__item tabs__item--current">All cases ({{$allCases->count()}})</li>
        <li class="tabs__item">For approval ({{$forApproval->count()}})</li>
        <li class="tabs__item">Other suggestions ({{$otherSuggestion->count()}})</li>
        <li class="tabs__item">Need further details ({{$needFurtherDetails->count()}})</li>
        <li class="tabs__item">Not for referral ({{$notForReferral->count()}})</li>
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
    <div class="tabs__details">
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
        @foreach($forApproval as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
            <td class="table__details">{{ $case->status }}</td>
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
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($otherSuggestion as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
            <td class="table__details">{{ $case->status }}</td>
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
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($needFurtherDetails as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab=Need Further Details')}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
            <td class="table__details">{{ $case->status }}</td>
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
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notForReferral as $case)
        <tr class="table__row js-view" data-href="{{url('/treatment-outcomes/'.$case->id.'?from_tab=Not for Referral')}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
            <td class="table__details">{{ $case->status }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
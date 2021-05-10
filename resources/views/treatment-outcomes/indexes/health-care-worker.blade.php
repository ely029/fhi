<div class="section__container">
    <a class="button button--create" href="{{url('treatment-outcomes/create') }}">Create new case</a>
    <div class="section__content">
    <ul class="tabs__list tabs__list--table">
        <li class="tabs__item tabs__item--current">All Cases ()</li>
        <li class="tabs__item">For approval ()</li>
        <li class="tabs__item">Other suggestions ()</li>
        <li class="tabs__item">Need further details ()</li>
        <li class="tabs__item">Not for referral ()</li>
    </ul>

    <div class="tabs__details tabs__details--active">
        <table class="table table--filter js-table">
        <thead>
            <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Patient initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        {{-- @foreach($allCases as $case)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$case->id)}}">
            <td class="table__details">{{ $case->presentation_number }}</td>
            <td class="table__details">{{ empty($case->patient->initials) ? '' : $case->patient->initials}}</td>
            <td class="table__details">{{ empty($case->patient->age) ? '' : $case->patient->age}}</td>
            <td class="table__details">{{ empty($case->patient->gender) ? '' : $case->patient->gender}}</td>
            <td class="table__details">{{ $case->caseManagementForm->updated_type_of_case ?? '' }}</td>
            <td class="table__details">{{ $case->created_at->format('Y-m-d')}}</td>
            <td class="table__details">{{ $case->status }}</td>
            </tr>
        @endforeach --}}
            
        </tbody>
        </table>
    </div>
    {{-- <div class="tabs__details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Patient initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Sex</th>
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($forApproval as $case)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$case->id)}}">
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
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($otherSuggestion as $case)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$case->id)}}">
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
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($needFurtherDetails as $case)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$case->id)}}">
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
                <th class="table__head">Updated drug susceptibility</th>
                <th class="table__head">Date submitted by Health Care Worker</th>
                <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notForReferral as $case)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$case->id)}}">
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
    </div> --}}
    </div>
</div>
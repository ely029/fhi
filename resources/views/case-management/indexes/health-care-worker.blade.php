<div class="section__container">
    <a class="button button--create" href="{{url('case-management/create') }}">Create new case</a>
    <div class="section__content">
    <ul class="tabs__list tabs__list--table">
        <li class="tabs__item tabs__item--current">All Cases</li>
        <li class="tabs__item">For approval ({{$forApproval->count()}})</li>
        <li class="tabs__item">For follow up ({{$forFollowUp->count()}})</li>
        <li class="tabs__item">Other suggestion ({{$otherSuggestion->count()}})</li>
        <li class="tabs__item">Not for referral ({{$notForReferral->count()}})</li>
    </ul>
    <div class="tabs__details tabs__details--active">
        <table class="table table--filter js-table">
        <thead>
            <tr>
            <th class="table__head">Case no.</th>
            <th class="table__head">Facility Code</th>
            <th class="table__head">Patient</th>
            <th class="table__head">Date</th>
            <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($allCases as $cases)
        <tr class="table__row js-view" data-href="{{url('/case-management/show/'.$cases->id)}}">
            <td class="table__details">{{$cases->presentation_number}}</td>
            <td class="table__details">{{$cases->patient->facility_code}}</td>
            <td class="table__details">{{$cases->patient->code}}</td>
            <td class="table__details">{{$cases->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{$cases->status}}</td>
            </tr>
        @endforeach
            
        </tbody>
        </table>
    </div>
    <div class="tabs__details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
            <th class="table__head">Case no.</th>
            <th class="table__head">Faculty Code</th>
            <th class="table__head">Patient</th>
            <th class="table__head">Date</th>
            <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($forApproval as $case)
        <tr class="table__row js-view" data-href="view-case.html">
        <td class="table__details">{{$cases->presentation_number}}</td>
            <td class="table__details">{{$cases->patient->facility_code}}</td>
            <td class="table__details">{{$cases->patient->code}}</td>
            <td class="table__details">{{$cases->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{$cases->status}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="tabs__details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
            <th class="table__head">Case no.</th>
            <th class="table__head">Faculty Code</th>
            <th class="table__head">Patient</th>
            <th class="table__head">Date</th>
            <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($forFollowUp as $case)
        <tr class="table__row js-view" data-href="view-case.html">
        <td class="table__details">{{$cases->presentation_number}}</td>
            <td class="table__details">{{$cases->patient->facility_code}}</td>
            <td class="table__details">{{$cases->patient->code}}</td>
            <td class="table__details">{{$cases->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{$cases->status}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    <div class="tabs__details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
            <th class="table__head">Case no.</th>
            <th class="table__head">Faculty Code</th>
            <th class="table__head">Patient</th>
            <th class="table__head">Date</th>
            <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($otherSuggestion as $case)
        <tr class="table__row js-view" data-href="view-case.html">
        <td class="table__details">{{$cases->presentation_number}}</td>
            <td class="table__details">{{$cases->patient->facility_code}}</td>
            <td class="table__details">{{$cases->patient->code}}</td>
            <td class="table__details">{{$cases->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{$cases->status}}</td>
            </tr>
        @endforeach>
        </tbody>
        </table>
    </div>
    <div class="tabs__details">
        <table class="table table--filter js-table">
        <thead>
            <tr>
            <th class="table__head">Case no.</th>
            <th class="table__head">Faculty Code</th>
            <th class="table__head">Patient</th>
            <th class="table__head">Date</th>
            <th class="table__head">Status</th>
            </tr>
        </thead>
        <tbody>
        @foreach($notForReferral as $case)
        <tr class="table__row js-view" data-href="view-case.html">
        <td class="table__details">{{$cases->presentation_number}}</td>
            <td class="table__details">{{$cases->patient->facility_code}}</td>
            <td class="table__details">{{$cases->patient->code}}</td>
            <td class="table__details">{{$cases->created_at->format('m-d-Y')}}</td>
            <td class="table__details">{{$cases->status}}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
    </div>
</div>
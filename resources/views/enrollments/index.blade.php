@extends('layouts.app')

@section('title', 'View Enrollments')
@section('description', 'View Enrollments')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">Enrollments</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Enrollment Regimen</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    @if (Auth::user()->role_id === 3)
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date submitted to RTB MAC</th>
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
                  <td class="table__details">{{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility }}</td>
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
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
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
                  <td class="table__details">{{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility }}</td>
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
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
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
                  <td class="table__details">{{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility }}</td>
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
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($needFurtherDetails as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ $enrollment->patient->code }}</td>
                  <td class="table__details">{{ $enrollment->patient->age }}</td>
                  <td class="table__details">{{ $enrollment->patient->gender }}</td>
                  <td class="table__details">{{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility }}</td>
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
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notForReferrals as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ $enrollment->patient->code }}</td>
                  <td class="table__details">{{ $enrollment->patient->age }}</td>
                  <td class="table__details">{{ $enrollment->patient->gender }}</td>
                  <td class="table__details">{{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility }}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
    @if (Auth::user()->role_id === 4)
    <div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Pending ({{ $newEnrollments->count() }})</li>
          <li class="tabs__item">All Enrollments ({{ $allEnrollment->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Province</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($newEnrollments as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ $enrollment->patient->facility_code }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ empty($enrollment->created_at->format('M d, Y')) ? '' : $enrollment->created_at->format('M d, Y')}}</td>
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
                <th class="table__head">Facility Code</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Province</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB MAC</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollment as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ empty($enrollment->created_at->format('M d, Y')) ? '' : $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
    @if (Auth::user()->role_id === 5)
    <div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Pending ({{ $referredToRegional->count() }})</li>
          <li class="tabs__item">With Recommendations ({{$withRecommendationForRTBMac->count()}})</li>
          <li class="tabs__item">All Enrollments ({{ $allEnrollment->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($referredToRegional as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">
                  {{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}
                  </td>
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
                <th class="table__head">Facility Code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($withRecommendationForRTBMac as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->tbMacForms->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->tbMacForms->patient->facility_code) ? '' : $enrollment->tbMacForms->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->tbMacForms->patient->province) ? '' : $enrollment->tbMacForms->patient->province}}</td>
                  <td class="table__details">
                  {{ empty($enrollment->tbMacForms->patient->code) ? '' : $enrollment->tbMacForms->patient->code}}
                  </td>
                  <td class="table__details">{{ empty($enrollment->tbMacForms->enrollmentForm->drug_susceptibility) ? '' : $enrollment->tbMacForms->enrollmentForm->drug_susceptibility }}</td>
                  <td class="table__details">{{ $enrollment->tbMacForms->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->tbMacForms->status }}</td>
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
                <th class="table__head">Facility Code</th>
                <th class="table__head">Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollment as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">
                  {{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}
                  </td>
                  <td class="table__details">{{ $enrollment->enrollmentForm->drug_susceptibility }}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
    @if (Auth::user()->role_id === 6)
    <div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Pending ({{ $referred->count() }})</li>
          <li class="tabs__item">Pending Recommendation ({{ $allEnrollments->count() }})</li>
          <li class="tabs__item">All Enrollments ({{ $allEnrollments->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Province</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($referred as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Province</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollments as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
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
                <th class="table__head">Facility Code</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Province</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollments as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->age) ? '' : $enrollment->patient->age}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->gender) ? '' : $enrollment->patient->gender}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
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
    @endif
    @if (Auth::user()->role_id === 7)
    <div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Referred Enrolments ({{ $referred->count() }})</li>
          <li class="tabs__item">All Enrollments ({{ $allEnrollments->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Region & Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @if (!empty($referred))
              @foreach($referred as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient['facility_code']) ? '' : $enrollment->patient['facility_code']}}</td>
                  <td class="table__details">NCR - {{ empty($enrollment->patient['province']) ? '' : $enrollment->patient['province'] }}</td>
                  <td class="table__details">{{ empty($enrollment->patient['code']) ? '' : $enrollment->patient['code']}}</td>
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div class="tabs__details">
          <table class="table table--filter js-table">
          <thead>
          <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Region & Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
            @if(!empty($allEnrollments))
            @foreach($allEnrollments as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
              <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient['facility_code']) ? '' : $enrollment->patient['facility_code']}}</td>
                  <td class="table__details">NCR - {{ empty($enrollment->patient['province']) ? '' : $enrollment->patient['province'] }}</td>
                  <td class="table__details">{{ empty($enrollment->patient['code']) ? '' : $enrollment->patient['code']}}</td>
                  <td class="table__details">{{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}</td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif

    @if (Auth::user()->role_id === 8)
    <div class="section__container">
      @include('partials.alerts')

      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">Referred Enrolments ({{ $pending->count() }})</li>
          <li class="tabs__item">All Enrollments ({{ $allEnrollments->count() }})</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Facility Code</th>
                <th class="table__head">Region & Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pending as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">NCR - {{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">
                  {{ empty($enrollment->drug_susceptibility) ? '' : $enrollment->drug_susceptibility}}
                  </td>
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
                <th class="table__head">Facility Code</th>
                <th class="table__head">Region & Province</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($allEnrollments as $enrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details">{{ empty($enrollment->patient->facility_code) ? '' : $enrollment->patient->facility_code}}</td>
                  <td class="table__details">NCR - {{ empty($enrollment->patient->province) ? '' : $enrollment->patient->province}}</td>
                  <td class="table__details">{{ empty($enrollment->patient->code) ? '' : $enrollment->patient->code}}</td>
                  <td class="table__details">
                  {{ empty($enrollment->enrollmentForm->drug_susceptibility) ? '' : $enrollment->enrollmentForm->drug_susceptibility}}
                  </td>
                  <td class="table__details">{{ $enrollment->created_at->format('M d, Y')}}</td>
                  <td class="table__details">{{ $enrollment->status }}</td>
                </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
    @endif
  </div>
@endsection

@extends('layouts.app')

@section('title', 'View Enrollments')
@section('description', 'View Enrollments')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">Enrollments</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Enrollment Regimen</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
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
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($enrollments as $enrollment)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$enrollment->id) }}">
                  <td class="table__details">{{ $enrollment->presentation_number }}</td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
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
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($forEnrollments as $forEnrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$forEnrollment->id) }}">
                <td class="table__details">{{ $forEnrollment->id }}</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details">{{ $forEnrollment->status }}</td>
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
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notForEnrollments as $notForEnrollment)
              <tr class="table__row js-view" data-href="{{ url('enrollments/'.$notForEnrollment->id) }}">
                <td class="table__details">{{ $notForEnrollment->id }}</td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details"></td>
                <td class="table__details">{{ $notForEnrollment->status }}</td>
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
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($needFurtherDetails as $needFurtherDetail)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$needFurtherDetail->id) }}">
                  <td class="table__details">{{ $needFurtherDetail->id }}</td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details">{{ $needFurtherDetail->status }}</td>
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
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($notForReferrals as $notForReferral)
                <tr class="table__row js-view" data-href="{{ url('enrollments/'.$notForReferral->id) }}">
                  <td class="table__details">{{ $notForReferral->id }}</td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details"></td>
                  <td class="table__details">{{ $notForReferral->status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

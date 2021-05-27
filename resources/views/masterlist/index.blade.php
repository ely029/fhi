@extends('layouts.app')

@section('title', 'Master List')
@section('description', 'Master List')

@section('content')
<div class="section">
  <div class="section__top">
    <div class="section__top-text">
    <h1 class="section__title">Masterlist</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Masterlist</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__top-menu">
      <input class="section__top-trigger" type="checkbox" />
      <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
      <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
    </div>
  </div>
  <div class="section__container">
    <form class="form" action="{{ url('masterlist/filter')}}" method="POST">
    {{ csrf_field() }}
      @php
      $firstDayofPreviousMonth = Carbon\Carbon::now()->startOfMonth()->format('m-d-Y');
      $lastDayofPreviousMonth = Carbon\Carbon::now()->endOfMonth()->format('m-d-Y');
      $defaultFirstDayofPreviousMonth = Carbon\Carbon::now()->startOfMonth()->format('Y-m-d');
      $defaultLastDayofPreviousMonth = Carbon\Carbon::now()->endOfMonth()->format('Y-m-d');
      @endphp
      <div class="form__container">
        <h2 class="section__heading">TB Medical Advisory Committee Masterlist</h2>
        <div class="form--quarter">
          <div class="grid grid--three grid--end">
          @if (request('date_from') !== null && request('date_to') !== null )
          <div class="form__content"><input class="form__input" value="{{ request('date_from') }}" type="date" name="date_from" /><label class="form__label" for="">Start date</label></div>
            <div class="form__content"><input class="form__input" value="{{ request('date_to') }}"type="date" name="date_to" /><label class="form__label" for="">End date</label></div>
            @else
            <div class="form__content"><input class="form__input" value="{{ $defaultFirstDayofPreviousMonth }}" type="date" name="date_from" /><label class="form__label" for="">Start date</label></div>
            <div class="form__content"><input class="form__input" value="{{ $defaultLastDayofPreviousMonth }}"type="date" name="date_to" /><label class="form__label" for="">End date</label></div>
          @endif
            <button class="button button--masterlist" type="submit">Apply</button>
          </div>
        </div>
      </div>
      <div class="form__container">
      @if (request('date_from') !== null && request('date_to') !== null )
      <h2 class="section__heading">Showing results for {{date('m-d-Y', strtotime( request('date_from'))) }} - {{date('m-d-Y', strtotime( request('date_to'))) }}</h2>
      @else
      <h2 class="section__heading">Showing results for {{ $firstDayofPreviousMonth }} - {{ $lastDayofPreviousMonth }}</h2>
      @endif
        
        <table class="table table--filter js-table-unset">
          <thead>
            <tr>
              <th class="table__head">Presentation no.</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Reason for referral</th>
              <th class="table__head">Recommendation</th>
              <th class="table__head">Status</th>
              <th class="table__head">Date resolved</th>
              @if (auth()->user()->role_id == 4)
              <th class="table__head">Remarks</th>
              @else
              @endif
            </tr>
          </thead>
          <tbody>
            @foreach($enrollment as $details)
              @php
              $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
              $age = Carbon\Carbon::parse($details->birthday)->age;
              $gender = Str::upper(Str::substr($details->gender, 0, 1));
              @endphp
            <tr class="table__row-{{ $details->id }}">
            <td class="table__details">E-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
              <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
              <td class="table__details">Enrollment</td>
              <td class="table__details">{{ empty($details->recom_status) ? '' : $details->recom_status }}</td>
              <td class="table__details">{{ $details->header_status }}</td>
              <td class="table__details">{{date('m-d-Y', strtotime( $details->updated_at )) }}</td>
              @if (auth()->user()->role_id == 4)
              <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
              @else
              @endif
              <input type="hidden" value="{{ $details->id}}" class="form_id">
            </tr>
            <div class="modal" id="remarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal__background js-modal-background"></div>
        <div class="modal__container">
          <div class="modal__box">
            <h2 class="modal__title">Edit remarks</h2>
            <p class="modal__text">Edit remarks for the masterlist.</p>
            <form class="form">
              <div class="form__content"><textarea class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
            </form>
            <div class="modal__button"><input class="button" type="submit" value="Save" /></div>
          </div>
        </div>
      </div>
            @endforeach
            @foreach($caseManagement as $details)
              @php
              $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
              $age = Carbon\Carbon::parse($details->birthday)->age;
              $gender = Str::upper(Str::substr($details->gender, 0, 1));
              @endphp
            <tr class="table__row-{{ $details->id }}">
              <td class="table__details">C-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
              <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
              <td class="table__details">Case management</td>
              <td class="table__details">{{ empty($details->recom_status) ? '' : $details->recom_status }}</td>
              <td class="table__details">{{ $details->header_status }}</td>
              <td class="table__details">{{date('m-d-Y', strtotime( $details->updated_at )) }}</td>
              @if (auth()->user()->role_id == 4)
              <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
              @else
              @endif
              <input type="hidden" value="{{ $details->id }}" class="form_id">
              <input type="hidden" value="{{ $details->remarks}}" name="remarks">
            </tr>
            @endforeach
            @foreach($treatmentOutcome as $details)
              @php
              $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
              $age = Carbon\Carbon::parse($details->birthday)->age;
              $gender = Str::upper(Str::substr($details->gender, 0, 1));
              @endphp
            <tr class="table__row-{{ $details->id }}">
              <td class="table__details">T-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
              <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
              <td class="table__details">Treatment outcome</td>
              <td class="table__details">{{ empty($details->recom_status) ? '' : $details->recom_status }}</td>
              <td class="table__details">{{ $details->header_status }}</td>
              <td class="table__details">{{date('m-d-Y', strtotime( $details->updated_at )) }}</td>
              @if (auth()->user()->role_id == 4)
              <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
              @else
              @endif
              <input type="hidden" value="{{ $details->remarks}}" name="remarks">
              <input type="hidden" value="{{ $details->id }}" class="form_id">
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </form>
  </div>
</div>
@endsection
@section('additional_scripts')
<script src="{{ asset('assets/app/js/master-list/remarks.js') }}"></script>  
@endsection
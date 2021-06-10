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
      $defaultFirstDayofPreviousMonth = Carbon\Carbon::now()->startOfMonth()->format('m/d/Y');
      $defaultLastDayofPreviousMonth = Carbon\Carbon::now()->endOfMonth()->format('m/d/Y');
      $requestDateFrom = request('date_from');
      $requestDateTo = request('date_to');
      @endphp
      <div class="form__container">
        <h2 class="section__heading">TB Medical Advisory Committee Masterlist</h2>
        <div class="form--quarter">
          <div class="grid grid--three grid--end">
          @if ($requestDateFrom !== null && $requestDateTo !== null )
          <div class="form__content"><input class="form__input form__input--date" value="{{ date('Y-m-d', strtotime($requestDateFrom)) }}" type="text" name="date_from" /><label class="form__label" for="">Start date</label></div>
            <div class="form__content"><input class="form__input form__input--date" value="{{  date('Y-m-d', strtotime($requestDateTo)) }}"type="text" name="date_to" /><label class="form__label" for="">End date</label></div>
            @else
            <div class="form__content"><input class="form__input form__input--date" value="{{  $defaultFirstDayofPreviousMonth  }}" type="text" name="date_from" /><label class="form__label" for="">Start date</label></div>
            <div class="form__content"><input class="form__input form__input--date" value="{{  $defaultLastDayofPreviousMonth }}"type="text" name="date_to" /><label class="form__label" for="">End date</label></div>
          @endif
            <button class="button button--masterlist" type="submit">Apply</button>
          </div>
        </div>
      </div>
      <div class="form__container">
        <div class="section__content">
          @if (request('date_from') !== null && request('date_to') !== null )
          <h2 class="section__heading section__heading--absolute">Showing results for {{date('m-d-Y', strtotime( request('date_from'))) }} - {{date('m-d-Y', strtotime( request('date_to'))) }}</h2>
          @else
          <h2 class="section__heading section__heading--absolute">Showing results for {{ $firstDayofPreviousMonth }} - {{ $lastDayofPreviousMonth }}</h2>
          @endif
        
          <table id="masterlist" class="table table--filter js-table-feedback">
            <thead>
              <tr>
                <th class="table__head">Presentation no.</th>
                <th class="table__head">Patient</th>
                <th class="table__head">Reason for referral</th>
                <th class="table__head">Recommendation</th>
                <th class="table__head">Status</th>
                <th class="table__head">Date resolved</th>
                <th class="table__head">Remarks</th>
              </tr>
            </thead>
            <tbody>
              @foreach($enrollment as $details)
                @php
                $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
                $age = Carbon\Carbon::parse($details->birthday)->age;
                $gender = Str::upper(Str::substr($details->gender, 0, 1));
                @endphp
              @if(auth()->user()->role_id == 4)
              <tr class="table_row_enrollment sec table__row-{{ $details->id }}">
              @else
              <tr class="table_row_enrollment table__row-{{ $details->id }}">
              @endif
              <td class="table__details">E-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
                <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
                <td class="table__details">Enrollment</td>
                <td class="table__details">{{ in_array($details->recom_status,['For Enrollment', 'Not For Enrollment', 'Need Further Details', 'Referred to national']) ? $details->recom_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Enrolled' || $details->header_status == 'Not Enrolled' ? $details->header_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Enrolled' || $details->header_status == 'Not Enrolled'  ? date('m-d-Y', strtotime( $details->updated_at )) : ''  }}</td>
                @if (auth()->user()->role_id == 4)
                  @if($details->remarks === NULL)
                  <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
                  @else
                  <td class="table__details"><span class="table__link remarks">{{ $details->remarks }}</span></td>
                  @endif
                @else
                <td class="table__details">{{ $details->remarks }}</td>
                @endif
                <input type="hidden" value="{{ $details->id}}" id="form_id">
                <input type="hidden" value="{{ $details->remarks}}" id="sec_remarks">
                <input type="hidden" value="enrollment" id="form_type">
              </tr>
              @endforeach
              @foreach($caseManagement as $details)
                @php
                $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
                $age = Carbon\Carbon::parse($details->birthday)->age;
                $gender = Str::upper(Str::substr($details->gender, 0, 1));
                @endphp
                @if(auth()->user()->role_id == 4) 
              <tr class="table_row_enrollment sec table__row-{{ $details->id }}">
              @else
              <tr class="table_row_enrollment table__row-{{ $details->id }}">
              @endif
              <td class="table__details">C-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
                <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
                <td class="table__details">Case Management</td>
                <td class="table__details">{{ in_array($details->recom_status,['Approved', 'Other suggestions', 'Need Further Details', 'Referred to national']) ? $details->recom_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Resolved' || $details->header_status == 'Not Resolved' ? $details->header_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Resolved' || $details->header_status == 'Not Resolved'  ? date('m-d-Y', strtotime( $details->updated_at )) : ''  }}</td>
                @if (auth()->user()->role_id == 4)
                  @if ($details->remarks === NULL)
                  <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
                  @else
                  <td class="table__details"><span class="table__link remarks">{{ $details->remarks }}</span></td>
                  @endif
                @else
                <td class="table__details">{{ $details->remarks }}</td>
                @endif
                <input type="hidden" value="{{ $details->id}}" id="form_id">
                <input type="hidden" value="{{ $details->remarks}}" id="sec_remarks">
                <input type="hidden" value="case_management" id="form_type">
              </tr>
              @endforeach
              @foreach($treatmentOutcome as $details)
                @php
                $initials = Str::upper(Str::substr($details->first_name, 0, 1).Str::substr($details->middle_name, 0, 1).Str::substr($details->last_name, 0, 1));
                $age = Carbon\Carbon::parse($details->birthday)->age;
                $gender = Str::upper(Str::substr($details->gender, 0, 1));
                @endphp
                @if(auth()->user()->role_id == 4)
              <tr class="table_row_enrollment sec table__row-{{ $details->id }}">
              @else
              <tr class="table_row_enrollment table__row-{{ $details->id }}">
              @endif
              <td class="table__details">T-{{ empty($details->presentation_number) ? '' : $details->presentation_number }}</td>
                <td class="table__details">{{ $initials }}    {{ $age }}   {{ $gender }}</td>
                <td class="table__details">Treatment Outcome</td>
                <td class="table__details">{{ in_array($details->recom_status,['Approved', 'Other suggestions', 'Need Further Details', 'Referred to national']) ? $details->recom_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Resolved' || $details->header_status == 'Not Resolved' ? $details->header_status : '' }}</td>
                <td class="table__details">{{ $details->header_status == 'Resolved' || $details->header_status == 'Not Resolved'  ? date('m-d-Y', strtotime( $details->updated_at )) : ''  }}</td>
                @if (auth()->user()->role_id == 4)
                  @if ($details->remarks === NULL)
                  <td class="table__details"><span class="table__link remarks">Edit remarks</span></td>
                  @else
                  <td class="table__details"><span class="table__link remarks">{{ $details->remarks }}</span></td>
                  @endif
                @else
                <td class="table__details">{{ $details->remarks }}</td>
                @endif
                <input type="hidden" value="{{ $details->id}}" id="form_id">
                <input type="hidden" value="{{ $details->remarks}}" id="sec_remarks">
                <input type="hidden" value="treatment_outcome" id="form_type">
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </form>
  </div>
  <div class="modal" id="sec_remarks_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal__background" data-dismiss="modal"></div>
        <div class="modal__container">
          <div class="modal__box">
            <h2 class="modal__title">Edit remarks</h2>
            <p class="modal__text">Edit remarks for the masterlist.</p>
            <form class="form form--full" method="POST" action="{{ url('masterlist/update-remarks') }}">
            @csrf
              <div class="form__content"><textarea class="form__input form__input--message" name="remarks" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
              <div class="modal__button"><input class="button" type="submit" value="Save" /></div>
              <input type="hidden" id="form_id" name="form_id"/>
              <input type="hidden" id="form_type" name="form_type">
            </form>
          </div>
        </div>
      </div>
      <div class="modal" id="remarks" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
        <div class="modal__box">
            <h2 class="modal__title">Report issue</h2>
            <p class="modal__text">Please elaborate on the issue encountered.</p>
            <form class="form form--full" method="POST" action="{{ url('/report-and-feedbacks')}}">
            @csrf
                <div class="form__content"> <textarea name="issue" class="form__input form__input--message" placeholder="Enter issue" required></textarea><label class="form__label" for="">Report issue</label></div>
                <div class="modal__button modal__button--end"><input class="button" type="submit" value="Submit" /></div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('additional_scripts')
<script src="{{ asset('assets/app/js/master-list/remarks.js') }}"></script>  
<script src="{{ asset('assets/app/js/feedbacks.js') }}"></script>
<script src="{{ asset('assets/dashboard/js/datepicker-init.js') }}"></script>
@endsection
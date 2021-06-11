@extends('layouts.app')

@section('title', 'View Enrollments')
@section('description', 'View Enrollments')

@section('content')

<div class="section">
    <div class="section__top">
      <div class="section__top-text">
      <h1 class="section__title">{{ $tbMacForm->presentation_number }}</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('enrollments') }}">Enrollment regimen</a>
        <a class="breadcrumbs__link">View {{ $tbMacForm->presentation_number }}</a>
        <a class="breadcrumbs__link"></a>
      </div>
      </div>
      <div class="section__top-menu">
        <input class="section__top-trigger" type="checkbox" />
        <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
        <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
      </div>
    </div>

      <div class="section__container">

        @include('partials.alerts')
        @include('partials.modal', $tbMacForm)

        <form class="form" action="">
          <div class="grid grid--two grid--start">
            <div class="form--half">
              <div class="form__container">
              <h2 class="section__heading section__heading--full">Patient  {{ $tbMacForm->patient->code }}
                  <span class="form__text">Health facility  {{ $tbMacForm->patient->facility_code }}  &nbsp;&nbsp;&nbsp;  {{ $tbMacForm->patient->province }} </span></h2>
                <div class="form__content"><span class="form__text">
                @if ($tbMacForm->status == 'Referred to N-TB MAC')
                  Referred to N-TB MAC
                  @else
                  {{ ucfirst(Str::lower($tbMacForm->status)) }}
                  @endif
                </span>
                    <label class="form__label" for="">Status</label>
                </div>
                <br />
              </div>
              <div class="form__container">
                <h2 class="section__heading">Health Care Worker</h2>
                <div class="grid grid--two grid--start">
                  <div class="form__content"><span class="form__text">{{ $tbMacForm->submittedBy->name }}</span><label class="form__label" for="">Primary Health Care Worker </label></div>
                  <div class="form__content"><span class="form__text">{{ $tbMacForm->created_at->format('m-d-Y') }}</span><label class="form__label" for="">Date submitted</label></div>
                </div>
              </div>
            </div>
            {{-- Regional Secretariat --}}
            @if (auth()->user()->role_id == 4 && request('from_tab') == 'pending')
            <div class="grid grid--action">
              <div class="form__content">
                <select id="refer" class="form__input form__input--select">
                  <option value="1">Refer to R-TB MAC</option>
                  <option value="5">Need further details</option>
                  <option value="2">Not for referral</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button id="refer-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
            </div>
            @endif
             {{-- Regional TB Mac --}}
            @if (auth()->user()->role_id == 5 && request('from_tab') == 'pending')
            <div class="grid grid--action">
              <div class="form__content">
                <select id="refer" class="form__input form__input--select">
                  <option value="3">Recommend not for enrollment</option>
                  <option value="4">Recommend for enrollment</option>
                  <option value="recommend_further_details">Recommend for need further details</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button id="refer-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
            </div>
            @endif
             {{-- Regional TB Mac Chair --}}
            @if (auth()->user()->role_id == 6 && (request('from_tab') == 'referred' || request('from_tab') == 'pending'))
            <div class="grid grid--action">
              <div class="form__content">
                <select id="refer" class="form__input form__input--select">
                  <option value="6">For enrollment</option>
                  <option value="7">Not for enrollment</option>
                  <option value="8">Need further details</option>
                  <option value="9">Refer to N-TB MAC</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button id="refer-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
            </div>
            @endif
            {{-- National TB Mac --}}
            @if (auth()->user()->role_id == 7 && request('from_tab') == 'referred')
            <div class="grid grid--action">
              <div class="form__content">
                <label class="form__label" for="">Action</label>
              </div>
              <button  class="button js-trigger create-recom" type="button">Create recommendation</button>
            </div>
            @endif
            {{-- National TB Mac Chair --}}
            @if (auth()->user()->role_id == 8 && request('from_tab') == 'referred')
            <div class="grid grid--action">
              <div class="form__content">
                <select id="refer" class="form__input form__input--select">
                  <option value="Resolved">Resolved</option>
                  <option value="Not resolved">Not resolved</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button id="refer-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
            </div>
            @endif
            @if (auth()->user()->role_id == 3 && in_array($tbMacForm->status, ['Not For Referral','Need Further Details','Other suggestions','For Enrollment','Not For Enrollment']))
            <div class="grid grid--action">
              <div class="form__content">
                <select id="refer" class="form__input form__input--select">
                  <option value="10">Enrolled</option>
                  <option value="11">Not Enrolled</option>
                  @if($tbMacForm->status == 'Not For Referral' || $tbMacForm->status == 'Need Further Details')
                    <option value="Resubmit Enrollment">Resubmit enrollment</option>
                  @endif
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button id="refer-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
            </div>
            @endif
          </div>
        </form>
        <hr class="line" />
        <ul class="tabs__list">
          <li class="tabs__item js-tabs js-tabs-current">Case information</li>
          <li class="tabs__item js-tabs">Remarks &amp; Recommendations</li>
        </ul>
        
        <div class="tabs__details js-tabs-details js-tabs-details-active">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Treatment information</h2>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->enrollmentForm->treatment_history) ? '' : $tbMacForm->enrollmentForm->treatment_history }}</span>
                    <label class="form__label" for="">Treatment history</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->registration_group }}</span>
                    <label class="form__label" for="">Registration group</label>
                </div>
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->risk_factor }}</span>
                    <label class="form__label" for="">Risk factor</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Current bacteriological result</h2>
              <ul class="card">
                @php
                $bacteriologicalResults = $tbMacForm->bacteriologicalResults->filter(function($item){
                      return $item->type != 'dst_from_other_lab';
                });
                @endphp
                @foreach($bacteriologicalResults as $result)
                    <li class="card__item">
                    <div class="form__container">
                        <span class="form__text form__text--bold">{{ $result->name }}</span>
                        <span class="form__text">{{ $result->name_of_laboratory }}</span>
                        <span class="form__text">{{ $result->date_collected->format('m-d-Y') }}</span>
                    </div>
                    <div class="form__container">
                        <div class="form__content">
                          @if(is_array($result->result))
                            @foreach($result->result as $finalResult)
                              <span class="form__text">{{ $finalResult }}</span>
                            @endforeach
                          
                          @else
                            <span class="form__text">{{ $result->result }}</span>
                          @endif
                            <label class="form__label" for="">Result </label>
                        </div>
                    </div>
                    </li>   
                @endforeach
              </ul>
            </div>
            <div class="form__container">
                <h2 class="section__heading">DST from other laboratory</h2>
                <ul class="card">
                  @php
                      $dstFromOtherLab = $tbMacForm->bacteriologicalResults->filter(function($item){
                            return $item->type == 'dst_from_other_lab';
                      });
                  @endphp
                  @foreach($dstFromOtherLab as $result)
                      <li class="card__item">
                      <div class="form__container">
                          <span class="form__text">{{ $result->name_of_laboratory }}</span>
                          <span class="form__text">{{ $result->date_collected->format('m-d-Y') }}</span>
                      </div>
                      <div class="form__container">
                          <div class="form__content">
                              <span class="form__text">{{ $result->result }}</span>
                              <label class="form__label" for="">Result </label>
                          </div>
                      </div>
                      </li>   
                  @endforeach
                </ul>
              </div>
            <div class="form__container">
              <h2 class="section__heading">Regimen information</h2>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->enrollmentForm->drug_susceptibility) ? '' : $tbMacForm->enrollmentForm->drug_susceptibility }}</span>
                    <label class="form__label" for="">Drug susceptibility</label></div>
                <div class="form__content"><span class="form__text">{{ $tbMacForm->enrollmentForm->current_weight }}kg</span>
                    <label class="form__label" for="">Current weight</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">{{ $tbMacForm->enrollmentForm->suggested_regimen }}</span>
                    <label class="form__label" for="">Suggested regimen</label>
                </div>
                @if(\Str::startsWith($tbMacForm->enrollmentForm->suggested_regimen,'ITR'))
                    <div class="form__content"><span class="form__text">{{ $tbMacForm->enrollmentForm->suggested_regimen }}</span>
                        <label class="form__label" for="">ITR Drugs</label>
                    </div>
                @endif
              </div>
              
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">{{ $tbMacForm->enrollmentForm->regimen_notes }}</span>
                  <label class="form__label" for="">Regimen notes</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">If for treatment of clinically diagnosed cases</h2>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->clinical_status }}</span>
                    <label class="form__label" for="">Clinical status</label>
                </div>
                
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">{{ $tbMacForm->enrollmentForm->vital_signs }}</span>
                  <label class="form__label" for="">Vital signs</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->diag_and_lab_findings }}</span>
                    <label class="form__label" for="">Pertinent diagnostic and laboratory findings</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->signs_and_symptoms }}</span>
                    <label class="form__label" for="">Signs and symptoms</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Laboratory results and information</h2>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">
                        {{ empty($tbMacForm->laboratoryResults->cxr_date) ? ''  : $tbMacForm->laboratoryResults->cxr_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">CXR date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                {{ $tbMacForm->laboratoryResults->cxr_result }}
                <br/>
                @if($tbMacForm->laboratoryResults->cxr_reading)
                    @foreach($tbMacForm->laboratoryResults->cxr_reading as $cxrReading)
                      {{ $cxrReading }}
                    @endforeach
                @endif
                {{-- @if($cxrReadings = empty($tbMacForm->laboratoryResults->cxr_reading) ? '' : $tbMacForm->laboratoryResults->cxr_reading)
                        {{ $cxrReadings }}
                    
                @endif --}}
                  </span>
                  <label class="form__label" for="">CXR result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">
                        {{ empty($tbMacForm->laboratoryResults->ct_scan_date) ? '' : $tbMacForm->laboratoryResults->ct_scan_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">CT scan date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ $tbMacForm->laboratoryResults->ct_scan_result }}
                  </span>
                  <label class="form__label" for="">CT scan result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->laboratoryResults->ultrasound_date) ? '' : $tbMacForm->laboratoryResults->ultrasound_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">Ultrasound date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ $tbMacForm->laboratoryResults->ultrasound_result }}
                  </span>
                  <label class="form__label" for="">Ultrasound result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->laboratoryResults->histopathological_date) ? '' : $tbMacForm->laboratoryResults->histopathological_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">Histopathological date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ empty($tbMacForm->laboratoryResults->histopathological_result) ? '' : $tbMacForm->laboratoryResults->histopathological_result }}
                  </span>
                  <label class="form__label" for="">Histopathological result</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Related media</h2>
              <ul class="form__gallery">
                @foreach($tbMacForm->attachments as $key => $attachment)
                  <li class="form__gallery-item">
                    <a class="form__gallery-link" href="{{ url('enrollments/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" target="__blank">
                    <div class="form__gallery-image">
                      @if(\Str::endsWith($attachment->file_name, '.pdf'))
                        <img class="image" src="{{ asset('assets/app/img/pdf.png') }}" alt="Placeholder" />
                      @else
                        <img class="image" src="{{ url('enrollments/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" alt="Placeholder" />
                      @endif
                    </div>
                    <p class="form__gallery-text">{{ $attachment->file_name }}</p>
                  </a>
                  </li>
                @endforeach
              </ul>
            </div>
          </form>
        </div>
        <div class="tabs__details js-tabs-details">
          <form class="form form--half" action="">
            <h2 class="section__heading">Remarks | Recommendations</h2>
            @php
            
              if(auth()->user()->role_id == 3 || auth()->user()->role_id == 4)
              {
                  $recommendations = $tbMacForm->regionalRecommendations;
              }
              if(auth()->user()->role_id == 5 || auth()->user()->role_id == 6)
              {
                  $recommendations = $tbMacForm->rtbMacRecommendations;
              }
              if(auth()->user()->role_id == 7 || auth()->user()->role_id == 8)
              {
                  $recommendations = $tbMacForm->ntbMacRecommendations;
              }
              
            @endphp
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="{{ asset('assets\app\img\icon-user.png')}}" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">{{ $tbMacForm->submittedBy->name }}<span class="form__label">Health Care Worker | [Region]</span></h2>
                  <label class="form__label form__label--date">{{ $tbMacForm->created_at->format('m-d-Y')}}</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="{{ asset('assets\app\img\icon-flag.png')}}" alt="action icon" />
                  <div class="form__content"><span class="form__text form__text--green">New Enrollment</span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
                  {{ $tbMacForm->laboratoryResults->remarks }}
                </span>
              </div>
            </div>
           @foreach($recommendations as $recommendation)
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="{{ asset('assets\app\img\icon-user.png')}}" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">{{ $recommendation->users->name}}<span class="form__label">{{ $recommendation->users->role->name }} | [Region]</span></h2>
                  <label class="form__label form__label--date">{{ $recommendation->created_at->format('m-d-Y')}}</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="{{ asset('assets\app\img\icon-flag.png')}}" alt="action icon" />
                  
                  <div class="form__content"><span class="form__text form__text--green">
                  {{ $recommendation->status = 'Referred to national chair' ? 'Referred to national chair' : ucfirst(Str::lower($recommendation->status)) }}
                  </span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
                  {{$recommendation->recommendation }}
                </span>
              </div>
            </div>
            @endforeach
          </form>
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

     
  
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/feedbacks.js') }}"></script>
@endsection
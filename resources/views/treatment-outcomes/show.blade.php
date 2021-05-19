@extends('layouts.app')

@section('title', 'View Treatment Outcome')
@section('description', 'View Treatment Outcome')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">{{ $tbMacForm->presentation_number }}</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('treatment-outcomes') }}">Treatment outcome</a>
        <a class="breadcrumbs__link">View {{ $tbMacForm->presentation_number }}</a>
        <a class="breadcrumbs__link"></a>
      </div>
    </div>

    <div class="section__container">

        @include('partials.alerts')

        <div class="modal" id="treatment_outcome_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
      <div class="modal__box">
        <h2 class="modal__title" id="modal-title"></h2>
        <p class="modal__text" id="modal-text"></p>
        <form class="form" id="modal-form" method="POST" action="{{ url('treatment-outcomes/'.$tbMacForm->id.'/recommendation') }}">
            @csrf
            <input type="hidden" name="status"/>
            <input type="hidden" name="recommendation_status"/>
            <div class="form__content">
                <textarea name="recommendation" required class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
                </div>
            <div class="modal__button">
                <button class="button" type="submit">Submit</button>
                <a href="{{ url('/treatment-outcomes/resubmit/'.$tbMacForm->id)}}"class="button hide--button">Submit</a>
            </div>
        </form>
      </div>
    </div>
</div>
          <form class="form" action="">
            <div class="grid grid--two grid--start">
              <div class="form--full">
                <div class="form__container">
                  <h2 class="section__heading">Patient {{ $tbMacForm->patient->code }}
                    <span class="form__text">
                        Health Facility {{ $tbMacForm->patient->facility_code }} &nbsp;&nbsp;&nbsp; {{ $tbMacForm->patient->province }}</span>
                    </h2>
                  <div class="form__content">
                      <span class="form__text ">{{ ucfirst(Str::lower($tbMacForm->status)) }}</span>
                      <label class="form__label" for="">Status</label>
                    </div>
                  <br />
                  <div class="grid grid--patient grid--start">
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->treatmentOutcomeForm->tb_case_number }}</span>
                        <label class="form__label" for="">TB case number</label></div>
                    <div class="form__content">
                        <span class="form__text">{{  date('m-d-Y', strtotime($tbMacForm->treatmentOutcomeForm->date_started_treatment )) }}</span>
                        <label class="form__label" for="">Date started treatment</label></div>
                    <div class="form__content"><span class="form__text drug-susceptibility-label">{{ $tbMacForm->treatmentOutcomeForm->current_drug_susceptibility }}
                        </span>
                        <label class="form__label" for="">Current drug susceptibility</label>
                    </div>
                    <div class="form__content"><span class="form__text">{{ $tbMacForm->treatmentOutcomeForm->outcome }}
                    </span>
                    <label class="form__label" for="">Outcome</label>
                </div>
                  </div>
                </div>
                <div class="form__container">
                  <h2 class="section__heading">Health Care Worker</h2>
                  <div class="grid grid--two">
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->submittedBy->name }}</span>
                        <label class="form__label" for="">Primary Health Care Worker </label>
                    </div>
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->created_at->format('m-d-Y') }}</span>
                        <label class="form__label" for="">Date submitted</label>
                    </div>
                  </div>
                </div>

                {{-- Health Care Worker --}}
                @if(auth()->user()->role_id == 3 && $tbMacForm->status != 'Resolved' && in_array(request('from_tab'),['For approval','Other suggestions','Need Further Details','Not for Referral']))
                    <div class="grid grid--action">
                        <div class="form__content">
                            <select id="action-dropdown" class="form__input form__input--select">
                            <option value="Resolved">Resolved</option>
                            <option value="Not Resolved">Not resolved</option>
                            @if($tbMacForm->status == 'Not for Referral' || $tbMacForm->status == 'Need Further Details')
                              <option value="Resubmit Treatment Outcome">Resubmit treatment outcome</option>
                            @endif
                            </select>
                            <div class="triangle triangle--down"></div>
                            <label class="form__label" for="">Action</label>
                        </div>
                    <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                    </div>
                @endif

                {{-- Regional Secretariat --}}
                @if(auth()->user()->role_id == 4 && request('from_tab') == 'New Case')
                    <div class="grid grid--action">
                        <div class="form__content">
                            <select id="action-dropdown" class="form__input form__input--select" style="width:62%;">
                            <option value="Referred to Regional">Refer to R-TB MAC</option>
                            <option value="Not for Referral">Not for referral</option>
                            </select>
                            <div class="triangle triangle--down"></div>
                            <label class="form__label" for="">Action</label>
                        </div>
                    <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                    </div>
                @endif

                {{-- Regional TB Mac --}}
                @if(auth()->user()->role_id == 5 && request('from_tab') == 'Referred to Regional')
                  <div class="grid grid--action">
                      <div class="form__content">
                          <select id="action-dropdown" class="form__input form__input--select" style="width:62%;">
                          <option value="Recommend for Approval">Recommend for approval</option>
                          <option value="Recommend for other suggestions">Recommend for other suggestions</option>
                          <option value="Recommend for need further details">Recommend for need further details </option>
                          </select>
                          <div class="triangle triangle--down"></div>
                          <label class="form__label" for="">Action</label>
                      </div>
                  <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                  </div>
                @endif

                {{-- Regional TB Mac Chair --}}
                @if(auth()->user()->role_id == 6 && (request('from_tab') == 'Referred to Regional Chair' || request('from_tab') == 'Referred back to Regional Chair'))
                    <div class="grid grid--action">
                        <div class="form__content">
                            <select id="action-dropdown" class="form__input form__input--select" style="width:62%;">
                            <option value="For approval">For Approval</option>
                            <option value="Other suggestions">Other suggestions</option>
                            <option value="Need Further Details">Need further details</option>
                            <option value="Referred to N-TB MAC">Referred to N-TB MAC</option>
                            </select>
                            <div class="triangle triangle--down"></div>
                            <label class="form__label" for="">Action</label>
                        </div>
                    <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                    </div>
                @endif

                {{-- National TB Mac Chair --}}
                 @if(auth()->user()->role_id == 7  && request('from_tab') == 'Referred to N-TB MAC')
                 <div class="grid grid--action">
                    <div class="form__content">
                      <label class="form__label" for="">Action</label>
                    </div>
                    <button class="button js-trigger create-recommendation" data-role="{{ auth()->user()->role_id }}" type="button">Create Recommendation</button>
                  </div>
                @endif

                 {{-- National TB Mac Chair --}}
                 @if(auth()->user()->role_id == 8 && request('from_tab') == 'Referred to National Chair')
                 <div class="grid grid--action">
                    <div class="form__content">
                      <label class="form__label" for="">Action</label>
                    </div>
                    <button class="button js-trigger create-recommendation" data-role="{{ auth()->user()->role_id }}" type="button">Create Recommendation</button>
                  </div>
                @endif
                

              </div>
  
            </div>
          </form>
          <hr class="line" />
          <ul class="tabs__list">
            <li class="tabs__item tabs__item--current">Bacteriological results</li>
            <li class="tabs__item">Case information</li>
            <li class="tabs__item">Remarks &amp; Recommendations</li>
          </ul>
          <div class="tabs__details tabs__details--active">
            <form class="form" action="">
              <div class="form__container">
                <h2 class="section__heading">Screenings</h2>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head no-sort"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Method used</th>
                      <th class="table__head">Resistance pattern</th>
                    </tr>
                  </thead>
                  <tbody>
                  @php
                    $bacteriologicalResults = $tbMacForm->treatmentOutcomeBacteriologicalResults;
                    $screenings = $bacteriologicalResults->filter(function($item){
                        return $item->type == 'screenings';
                    });
                    $lpa = $bacteriologicalResults->filter(function($item){
                        return $item->type == 'lpa';
                    })->first();
                    $dst = $bacteriologicalResults->filter(function($item){
                        return $item->type == 'dst';
                    })->first();
                    $monthlyScreenings = $bacteriologicalResults->filter(function($item){
                        return $item->type == 'monthly_screenings';
                    })->values();

                  @endphp
                  @foreach($screenings as $key => $screening)
                    <tr class="table__row">
                      <td class="table__details">Screening {{ $key + 1 }}</td>
                      <td class="table__details">{{ $screening->date_collected->format('m-d-Y') }}</td>
                      <td class="table__details">{{ $screening->method_used }}</td>
                      <td class="table__details">{{ $screening->resistance_pattern }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">LPA information</h2>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head no-sort"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Resistance pattern</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table__row">
                      <td class="table__details">LPA</td>
                      <td class="table__details">{{ $lpa->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{ $lpa->resistance_pattern }}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">DST information</h2>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head no-sort"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Resistance pattern</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr class="table__row">
                      <td class="table__details">DST</td>
                      <td class="table__details">{{ $dst->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{ $dst->resistance_pattern === 'Other (specify)' ? $dst->resistance_pattern_others : $dst->resistance_pattern}}</td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Month</h2>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head">Month</th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Smear microscopy</th>
                      <th class="table__head">TB-LAMP</th>
                      <th class="table__head">Culture</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($monthlyScreenings->all() as $key => $monthlyScreening)
                    <tr class="table__row">
                      <td class="table__details">{{ $loop->first ? 'B' : $key }}</td>
                      <td class="table__details">{{$monthlyScreening->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{$monthlyScreening->smear_microscopy}}</td>
                      <td class="table__details">{{$monthlyScreening->tb_lamp}}</td>
                      <td class="table__details">{{$monthlyScreening->culture}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <div class="tabs__details">
            <form class="form" action="">

              <div class="form__container">
                <h2 class="section__heading">Laboratory results and information</h2>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->laboratoryResults->cxr_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">CXR date</label>
                  </div>
                  <div class="form__content">
                    <span class="form__text">
                      {{ $tbMacForm->laboratoryResults->cxr_result}}
                    </span>
                    <label class="form__label" for="">CXR result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->laboratoryResults->cxr_reading }}</span>
                    <label class="form__label" for="">Latest comparative CXR reading</label>
                  </div>
                </div>
              </div>
              
              <div class="form__container">
                <h2 class="section__heading">Related media</h2>
                <ul class="form__gallery">
                @foreach($tbMacForm->attachments as $key => $attachment)
                  <li class="form__gallery-item">
                    <a class="form__gallery-link" href="{{ url('treatment-outcomes/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" target="__blank">
                    <div class="form__gallery-image">
                      <img class="image" src="{{ url('treatment-outcomes/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" alt="Placeholder" />
                      </div>
                    <p class="form__gallery-text">{{ $attachment->file_name }}</p>
                  </a>
                  </li>
                @endforeach
              </ul>
              </div>
            </form>
          </div>
          <div class="tabs__details">
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
                    <div class="form__content"><span class="form__text form__text--green">New case</span><label class="form__label form__label--green">Action</label></div>
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
                    
                    <div class="form__content"><span class="form__text form__text--green">{{ ucfirst(Str::lower($recommendation->status)) }}</span><label class="form__label form__label--green">Action</label></div>
               
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

     
  
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/treatment-outcome/show.js') }}"></script>
@endsection
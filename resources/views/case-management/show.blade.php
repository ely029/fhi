@extends('layouts.app')

@section('title', 'View Case')
@section('description', 'View Case')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">{{ $tbMacForm->presentation_number }}</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('case-management') }}">Case Management</a>
        <a class="breadcrumbs__link">View {{ $tbMacForm->presentation_number }}</a>
        <a class="breadcrumbs__link"></a>
      </div>
    </div>

    <div class="section__container">

        @include('partials.alerts')

        <div class="modal" id="case_management_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
      <div class="modal__box">
        <h2 class="modal__title" id="modal-title"></h2>
        <p class="modal__text" id="modal-text"></p>
        <form class="form" id="modal-form" method="POST" action="{{ url('case-management/'.$tbMacForm->id.'/recommendation') }}">
            @csrf
            <input type="hidden" name="status"/>
            <input type="hidden" name="recommendation_status"/>
            <div class="form__content">
                <textarea name="recommendation" required class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
                </div>
            <div class="modal__button modal__button--end">
                <button class="button" type="submit">Submit</button>
                <a href="{{ url('/case-management/resubmit/'.$tbMacForm->id)}}"class="button hide--button">Submit</a>
            </div>
        </form>
      </div>
    </div>
</div>

        
          <form class="form" action="">
            <div class="grid grid--two grid--start">
              <div class="form--full">
                <div class="form__container">
                  <h2 class="section__heading section__heading--full">Patient {{ $tbMacForm->patient->code }}
                    <span class="form__text">
                        Facility {{ $tbMacForm->patient->facility_code }} &nbsp;&nbsp;&nbsp; {{ $tbMacForm->patient->province }}</span>
                    </h2>
                  <div class="form__content">
                      <span class="form__text ">{{ ucfirst(Str::lower($tbMacForm->status)) }}</span>
                      <label class="form__label" for="">Status</label>
                    </div>
                  <br />
                  <div class="grid grid--patient grid--start">
                    <div class="form__content">
                        <span class="form__text">{{ empty($tbMacForm->caseManagementForm->case_number) ? '' : $tbMacForm->caseManagementForm->case_number}}</span>
                        <label class="form__label" for="">TB case number</label></div>
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->caseManagementForm ? $tbMacForm->caseManagementForm->month_of_treatment : ''}}</span>
                        <label class="form__label" for="">Month of treatment</label></div>
                  </div>
                  <br/>
                  <div class="form__content"><span class="form__text">{{ empty($tbMacForm->casemanagementForm->current_drug_susceptibility) ? '' : $tbMacForm->casemanagementForm->current_drug_susceptibility}}
                        </span>
                        <label class="form__label" for="">Current drug susceptibility</label>
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
              </div>

              {{-- Health Care Worker --}}
              @if(auth()->user()->role_id == 3 && $tbMacForm->status == 'Not for Referral' || $tbMacForm->status == 'Need Further Details')
                  <div class="grid grid--action">
                      <div class="form__content">
                          <select id="action-dropdown" class="form__input form__input--select">
                          <option value="Resolved">Resolved</option>
                          <option value="Not Resolved">Not resolved</option>
                          <option value="Resubmit Case Management">Resubmit case management</option>
                          </select>
                          <div class="triangle triangle--down"></div>
                          <label class="form__label" for="">Action</label>
                      </div>
                  <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                  </div>
              @endif

              {{-- Regional Secretariat --}}
              @if(auth()->user()->role_id == 4 && request('from_tab') == 'pending')
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
<<<<<<< HEAD
                @endif

                {{-- Regional TB Mac Chair --}}
                @if(auth()->user()->role_id == 6 && (request('from_tab') == 'referred' || request('from_tab') == 'pending'))
                    <div class="grid grid--action">
                        <div class="form__content">
                            <select id="action-dropdown" class="form__input form__input--select" style="width:62%;">
                            <option value="For approval">For Approval</option>
                            <option value="Other suggestions">Other suggestions</option>
                            <option value="Need Further Details">Need further details</option>
                            <option value="Referred to N-TB MAC">Refer to N-TB MAC</option>
                            </select>
                            <div class="triangle triangle--down"></div>
                            <label class="form__label" for="">Action</label>
                        </div>
                    <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                    </div>
                @endif
=======
              @endif
>>>>>>> e27c22f9cadda7e5ea9d51a95734d32cdf5e2c48

              {{-- Regional TB Mac --}}
              @if(auth()->user()->role_id == 5 && request('from_tab') == 'pending')
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
              @if(auth()->user()->role_id == 6 && (request('from_tab') == 'referred' || request('from_tab') == 'pending'))
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

                {{-- National TB Mac --}}
                @if((auth()->user()->role_id == 7 || auth()->user()->role_id == 8) && request('from_tab') == 'referred')
                <div class="grid grid--action">
                  <div class="form__content">
                    <label class="form__label" for="">Action</label>
                  </div>
                  <button class="button js-trigger create-recommendation" data-role="{{ auth()->user()->role_id }}" type="button">Create Recommendation</button>
                </div>
              @endif
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
                  $screenone = $tbMacForm->screenOne;
                  $screenTwo = $tbMacForm->screenTwo;
                  $lpa = $tbMacForm->lpa;
                  $dst = $tbMacForm->dst;
                  $monthlyScreening = $tbMacForm->monthlyScreening;
                  @endphp
                  <tr class="table__row">
                      <td class="table__details">{{ empty($screenone->label) ? '' : $screenone->label}}</td>
                      <td class="table__details">{{ empty($screenone->date_collected) ? '' : $screenone->date_collected->format('m-d-Y') }}</td>
                      <td class="table__details">{{ empty($screenone->resistance_pattern) ? '' : $screenone->resistance_pattern }}</td>
                      <td class="table__details">{{ empty($screenone->method_used) ? '' : $screenone->method_used }}</td>
                    </tr>
                    <tr class="table__row">
                      <td class="table__details">{{ empty($screenTwo->label) ? '' : $screenTwo->label}}</td>
                      <td class="table__details">{{ empty($screenTwo->date_collected) ? '' : $screenTwo->date_collected->format('m-d-Y') }}</td>
                      <td class="table__details">{{ empty($screenTwo->resistance_pattern) ? '' : $screenTwo->resistance_pattern }}</td>
                      <td class="table__details">{{ empty($screenTwo->method_used) ? '' : $screenTwo->method_used }}</td>
                    </tr>
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
                      <td class="table__details">{{ empty($lpa->label) ? '' : $lpa->label}}</td>
                      <td class="table__details">{{ empty($lpa->date_collected) ? '' : $lpa->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{ empty($lpa->resistance_pattern) ? '' : $lpa->resistance_pattern }}</td>
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
                      <td class="table__details">{{ $dst->label}}</td>
                      <td class="table__details">{{ $dst->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{ $dst->resistance_pattern === 'Other (specify)' ? $dst->others : $dst->resistance_pattern}}</td>
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
                    @foreach($monthlyScreening as $a)
                    <tr class="table__row">
                      <td class="table__details">{{$a->count}}</td>
                      <td class="table__details">{{$a->date_collected->format('m-d-Y')}}</td>
                      <td class="table__details">{{$a->smear_microscopy}}</td>
                      <td class="table__details">{{$a->tb_lamp}}</td>
                      <td class="table__details">{{$a->culture}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <div class="tabs__details">
            <form class="form" action="">
              {{-- <div class="form__container">
                <h2 class="section__heading">Treatment information</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">06/20/2021 ➞ Treatment unit 1 ➞ Drug name 1 5 weeks ➞ Success</span><label class="form__label" for="">Treatment history</label></div>
                </div>
                <div class="grid grid--two">
                 <div class="form__content"><span class="form__text">Previous Treatment Outcome Unknown</span><label class="form__label" for="">Registration group</label></div>
                  <div class="form__content"><span class="form__text"></span><label class="form__label" for="">Risk factor</label></div>  
                </div>
              </div> --}}
             {{-- <div class="form__container">
                <h2 class="section__heading">Current bacteriological result</h2>
                <ul class="card">
                  <li class="card__item">
                    <div class="form__container">
                      <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                    </div>
                    <div class="form__container">
                      <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                    </div>
                  </li>
                  <li class="card__item">
                    <div class="form__container">
                      <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                    </div>
                    <div class="form__container">
                      <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                    </div>
                  </li>
                  <li class="card__item">
                    <div class="form__container">
                      <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                    </div>
                    <div class="form__container">
                      <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                    </div>
                  </li>
                  <li class="card__item">
                    <div class="form__container">
                      <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                    </div>
                    <div class="form__container">
                      <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                    </div>
                  </li>
                </ul>
              </div> --}}
              <div class="form__container">
                <h2 class="section__heading">Regimen information</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ $tbMacForm->patient->facility_code }}</span><label class="form__label" for="">Facility code</label></div>
                  <div class="form__content"><span class="form__text">{{ empty($tbMacForm->caseManagementForm->current_weight) ? '' : $tbMacForm->caseManagementForm->current_weight }}kg</span><label class="form__label" for="">Current weight</label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ empty($tbMacForm->caseManagementForm->current_regiment) ? '' : $tbMacForm->caseManagementForm->current_regiment}}</span><label class="form__label" for="">Current regimen </label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->caseManagementForm ? $tbMacForm->caseManagementForm->reason_case_management_presentation : ''}}</span>
                    <label class="form__label" for="">Reason for case management presentation</label>
                  </div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Suggested regimen</h2>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">
                      {{ $tbMacForm->caseManagementForm->suggested_regimen === 'Other (Specify)' ? $tbMacForm->caseManagementForm->others : $tbMacForm->caseManagementForm->suggested_regimen}}
                    </span>
                    <label class="form__label" for="">Suggested regimen</label>
                  </div>
                  @if($tbMacForm->caseManagementForm->suggested_regimen == 'ITR')
                  <div class="form__content">
                    <span class="form__text">
                      {{ $tbMacForm->caseManagementForm->itr_drugs }}
                    </span>
                      <label class="form__label" for="">ITR Drugs</label>
                    </div>
                  @endif
                </div>
                <div class="grid grid--two">
                 
                  <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->caseManagementForm->suggested_regimen_notes) ? '' : $tbMacForm->caseManagementForm->suggested_regimen_notes}}</span>
                    <label class="form__label" for="">Suggested regimen notes</label>
                  </div>
                  <div class="form__content"><span class="form__text">{{ empty($tbMacForm->caseManagementForm->updated_type_of_case) ? '' : $tbMacForm->caseManagementForm->updated_type_of_case}}</span>
                    <label class="form__label" for="">Updated drug Susceptibility</label>
                  </div>
                </div>
              </div>
              @foreach ($tbMacForm->caseManagementLaboratoryResults as $results)
              <div class="form__container">
                <h2 class="section__heading">Laboratory results and information</h2>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">{{ $results->cxr_date->format('m-d-Y') }}</span>
                    <label class="form__label" for="">CXR date</label>
                  </div>
                  <div class="form__content">
                    <span class="form__text">
                      {{ $results->cxr_result}}
                    </span>
                    <label class="form__label" for="">CXR result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text">{{ empty($tbMacForm->caseManagementForm->latest_comparative_cxr_reading) ? '' : $tbMacForm->caseManagementForm->latest_comparative_cxr_reading}}</span>
                    <label class="form__label" for="">Latest comparative CXR reading</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ $results->ct_scan_date ? $results->ct_scan_date->format('m-d-Y') : ''}}</span><label class="form__label" for="">CT Scan date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      {{ $results->ct_scan_result }}
                    </span>
                    <label class="form__label" for="">CT Scan result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ $results->ultra_sound_date ? $results->ultra_sound_date->format('m-d-Y') : ''}}</span><label class="form__label" for="">Ultrasound date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      {{ $results->ultra_sound_result }}
                    </span>
                    <label class="form__label" for="">Ultrasound result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ $results->histhopathological_date ? $results->histhopathological_date->format('m-d-Y') : ''}}</span><label class="form__label" for="">Histopathological date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      {{ $results->histhopathological_result }}
                    </span>
                    <label class="form__label" for="">Histopathological result</label>
                  </div>
                </div>
              </div>
              @endforeach
              
              <div class="form__container">
                <h2 class="section__heading">Related media</h2>
                <ul class="form__gallery">
                @foreach($tbMacForm->caseManagementAttachments as $key => $attachment)
                  <li class="form__gallery-item">
                  <a class="form__gallery-link" href="{{ url('case-management/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" target="__blank">
                    <div class="form__gallery-image">
                      <img class="image" src="{{ url('case-management/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}" alt="Placeholder" />
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
                    {{ $tbMacForm->caseManagementForm->remarks }}
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
    <script src="{{ asset('assets/app/js/case-management/show.js') }}"></script>
@endsection

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

        <div class="modal js-modal" id="refer-to-regional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal__background js-modal-background"></div>
            <div class="modal__container">
              <div class="modal__box">
                <h2 class="modal__title" id="modal-title"></h2>
                <p class="modal__text" id="modal-text"></p>
                <form class="form" id="modal-form" method="POST" action="{{ url('case-management/'.$tbMacForm->id.'/recommendation') }}">
                    @csrf
                   <input type="hidden" name="status"/>
                   <div class="form__content">
                       <textarea name="recommendation" required class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
                        </div>
                   <div class="modal__button">
                       <button class="button" type="submit">Submit</button>
                    </div>
                </form>
              </div>
            </div>
        </div>


        <ul class="tabs__list tabs__list--sub">
          <li class="tabs__item-sub tabs__item-sub--current">Case management</li>
          {{-- <li class="tabs__item-sub">Enrollment</li> --}}
        </ul>
        <div class="tabs__details-sub tabs__details-sub--active">
          <form class="form" action="">
            <div class="grid grid--two grid--start">
              <div class="form--half">
                <div class="form__container">
                  <h2 class="section__heading">Patient {{ $tbMacForm->patient->code }}
                    <span class="form__text">
                        Facility {{ $tbMacForm->patient->facility_code }} &nbsp;&nbsp;&nbsp; {{ $tbMacForm->patient->province }}</span>
                    </h2>
                  <div class="form__content">
                      <span class="form__text">{{ $tbMacForm->status }}</span>
                      <label class="form__label" for="">Status</label>
                    </div>
                  <br />
                  <div class="grid grid--three">
                    <div class="form__content">
                        <span class="form__text">2121</span>
                        <label class="form__label" for="">TB case number</label></div>
                    <div class="form__content">
                        <span class="form__text">may</span>
                        <label class="form__label" for="">Month of treatment</label></div>
                    <div class="form__content"><span class="form__text">
                        </span>
                        <label class="form__label" for="">Current drug susceptibility</label>
                    </div>
                  </div>
                </div>
                <div class="form__container">
                  <h2 class="section__heading">Healthcare worker</h2>
                  <div class="grid grid--two">
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->submittedBy->name }}</span>
                        <label class="form__label" for="">Primary healthcare worker </label>
                    </div>
                    <div class="form__content">
                        <span class="form__text">{{ $tbMacForm->created_at->format('m-d-Y') }}</span>
                        <label class="form__label" for="">Date submitted</label>
                    </div>
                  </div>
                </div>

                {{-- Regional Secretariat --}}
                @if(auth()->user()->role_id == 4 && request('from_tab') == 'pending')
                    <div class="grid grid--action">
                        <div class="form__content">
                            <select id="action-dropdown" class="form__input form__input--select">
                            <option value="Referred to Regional">Refer to R-TB MAC</option>
                            <option value="Not for Referral">Not for Referral</option>
                            </select>
                            <div class="triangle triangle--down"></div>
                            <label class="form__label" for="">Action</label>
                        </div>
                    <button id="recommendation-button" class="button button--masterlist js-trigger" type="button">Confirm</button>
                    </div>
                @endif

                {{-- Regional TB Mac --}}
                @if(auth()->user()->role_id == 5 && request('from_tab') == 'pending')
                  <div class="grid grid--action">
                      <div class="form__content">
                          <select id="action-dropdown" class="form__input form__input--select">
                          <option value="Recommend for Approval">Recommend for Approval</option>
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
                            <select id="action-dropdown" class="form__input form__input--select">
                            <option value="For approval">Approve</option>
                            <option value="Other suggestions">Other suggestions</option>
                            <option value="Need Further Details">Need Further Details</option>
                            <option value="Referred to National">Refer to N-TB MAC</option>
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
                      <th class="table__head"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Resistance pattern</th>
                      <th class="table__head">Method used</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table__row">
                      <td class="table__details">Screening 1</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                    </tr>
                    <tr class="table__row">
                      <td class="table__details">Screening 2</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">LPA information</h2>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Resistance pattern</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table__row">
                      <td class="table__details">LSA</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">DST information</h2>
                <div class="form__content"><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><label class="form__label" for="">Name of laboratory</label></div>
                <table class="table table--unset js-table-unset">
                  <thead>
                    <tr>
                      <th class="table__head"></th>
                      <th class="table__head">Done date</th>
                      <th class="table__head">Resistance pattern</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr class="table__row">
                      <td class="table__details">DST</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="form__container">
                <h2 class="section__heading">DST information</h2>
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
                    <tr class="table__row">
                      <td class="table__details">Screening 1</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                      <td class="table__details">sample</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </form>
          </div>
          <div class="tabs__details">
            <form class="form" action="">
              <div class="form__container">
                <h2 class="section__heading">Treatment information</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">06/20/2021 ➞ Treatment unit 1 ➞ Drug name 1 5 weeks ➞ Success</span><label class="form__label" for="">Treatment history</label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">Previous Treatment Outcome Unknown</span><label class="form__label" for="">Registration group</label></div>
                  <div class="form__content"><span class="form__text"></span><label class="form__label" for="">Risk factor</label></div>
                </div>
              </div>
              <div class="form__container">
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
              </div>
              <div class="form__container">
                <h2 class="section__heading">Regimen information</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">Stable/Unchange</span><label class="form__label" for="">Facility code</label></div>
                  <div class="form__content"><span class="form__text">45kg</span><label class="form__label" for="">Current weight</label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">Regimen 6b SLOR FQ-S</span><label class="form__label" for="">Current regimen </label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text"></span>
                    <label class="form__label" for="">Regimen notes</label>
                  </div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Suggested regimen</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">ITR</span><label class="form__label" for="">Suggested regiment</label></div>
                  <div class="form__content"><span class="form__text"></span><label class="form__label" for="">ITR Drugs</label></div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content">
                    <span class="form__text"></span>
                    <label class="form__label" for="">Suggested Regimen notes</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">Bacteriologically-confirmd XDR-TB</span><label class="form__label" for="">Update type of case, if applicable</label></div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Laboratory results and information</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CXR date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      
                    </span>
                    <label class="form__label" for="">CXR result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CT Scan date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      
                    </span>
                    <label class="form__label" for="">CT Scan result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Ultrasound date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      
                    </span>
                    <label class="form__label" for="">Ultrasound result</label>
                  </div>
                </div>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Histopathological date</label></div>
                  <div class="form__content">
                    <span class="form__text">
                      
                    </span>
                    <label class="form__label" for="">Histopathological result</label>
                  </div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Related media</h2>
                <ul class="form__gallery">
                  <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                  <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                  <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                </ul>
              </div>
            </form>
          </div>
          <div class="tabs__details">
            <form class="form form--half" action="">
              <h2 class="section__heading">Remarks | Recommendations</h2>
              @php
              
                if(auth()->user()->role_id == 3)
                {
                    $recommendations = $tbMacForm->recommendations;
                }
                if(auth()->user()->role_id == 4)
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
                    <label class="form__label">{{ $tbMacForm->created_at->format('d M, Y')}}</label>
                  </div>
                  <div class="form__container form__container--remarks form__container--actions">
                    <img class="image image--flag" src="{{ asset('assets\app\img\icon-flag.png')}}" alt="action icon" />
                    <div class="form__content"><span class="form__text form__text--green">Remarks</span><label class="form__label form__label--green">Action</label></div>
                  </div>
                  <span class="form__text">
                    {{ $tbMacForm->caseManagementLaboratoryResults[0]->remarks }}
                  </span>
                </div>
              </div>
             @foreach($recommendations as $recommendation)
              <div class="form__container form__container--remarks">
                <img class="image image--user" src="{{ asset('assets\app\img\icon-user.png')}}" alt="user icon" />
                <div class="form__container">
                  <div class="grid grid--two">
                    <h2 class="section__heading section__heading--healthworker">{{ $recommendation->users->name}}<span class="form__label">{{ $recommendation->users->role->name }} | [Region]</span></h2>
                    <label class="form__label">{{ $recommendation->created_at->format('d M, Y')}}</label>
                  </div>
                  <div class="form__container form__container--remarks form__container--actions">
                    <img class="image image--flag" src="{{ asset('assets\app\img\icon-flag.png')}}" alt="action icon" />
                    
                    <div class="form__content"><span class="form__text form__text--green">{{$recommendation->status }}</span><label class="form__label form__label--green">Action</label></div>
               
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
      </div>

     
  
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/case-management/show.js') }}"></script>
@endsection

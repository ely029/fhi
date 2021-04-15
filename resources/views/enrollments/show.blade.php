@extends('layouts.app')

@section('title', 'View Enrollments')
@section('description', 'View Enrollments')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">{{ $tbMacForm->presentation_number }}</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('enrollments') }}">Enrollment Regimen</a>
        <a class="breadcrumbs__link">View {{ $tbMacForm->presentation_number }}</a>
        <a class="breadcrumbs__link"></a>
      </div>
    </div>

      <div class="section__container">

        @include('partials.alerts')

        <form class="form" action="">
          <div class="grid grid--two grid--unset">
            <div class="form--quarter">
              <div class="form__container">
                <h2 class="section__heading">Patient RAGT 18F<span class="form__text">Facility 2323 &nbsp;&nbsp;&nbsp; Ilocos Norte</span></h2>
<<<<<<< HEAD
                <div class="form__content"><span class="form__text">New case</span><label class="form__label" for="">Status</label></div>
                <br />
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">may</span><label class="form__label" for="">Month of treatment</label></div>
=======
                <div class="form__content"><span class="form__text">{{ $tbMacForm->status }}</span>
                    <label class="form__label" for="">Status</label>
>>>>>>> a54a1b4447477d5c663461d40fedfab80024aa7a
                </div>
                <br />
              </div>
              <div class="form__container">
                <h2 class="section__heading">Healthcare worker</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">{{ $tbMacForm->submittedBy->name }}</span><label class="form__label" for="">Primary healthcare worker </label></div>
                  <div class="form__content"><span class="form__text">{{ $tbMacForm->created_at->format('m/d/Y') }}</span><label class="form__label" for="">Date submitted</label></div>
                </div>
              </div>
            </div>
            <div class="grid grid--action">
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option>New</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Action</label>
              </div>
              <button class="button" type="button">Confirm</button>
            </div>
          </div>
        </form>
        <hr class="line" />
        <ul class="tabs__list">
          <li class="tabs__item tabs__item--current">Case information</li>
          <li class="tabs__item">Remarks &amp; Recommendations</li>
        </ul>
        
        <div class="tabs__details tabs__details--active">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Treatment information</h2>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->treatment_history }}</span>
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
                        <span class="form__text">{{ $result->date_collected->format('d F Y') }}</span>
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
                          <span class="form__text">{{ $result->date_collected->format('d F Y') }}</span>
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
                    <span class="form__text">{{ $tbMacForm->enrollmentForm->registration_group }}</span>
                    <label class="form__label" for="">Drug Susceptibility</label></div>
                <div class="form__content"><span class="form__text">{{ $tbMacForm->enrollmentForm->current_weight }}kg</span>
                    <label class="form__label" for="">Current weight</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">{{ $tbMacForm->enrollmentForm->suggested_regimen }}</span>
                    <label class="form__label" for="">Suggested Regimen</label>
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
                    <label class="form__label" for="">Clinical Status</label>
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
                        {{ $tbMacForm->laboratoryResults->cxr_date ? $tbMacForm->laboratoryResults->cxr_date->format('m/d/y') : '' }}</span>
                    <label class="form__label" for="">CXR date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ $tbMacForm->laboratoryResults->cxr_result }}
                    @if($cxrReadings = $tbMacForm->laboratoryResults->cxr_reading)
                        @foreach($cxrReadings as $cxrReading)
                            {{ $cxrReading }} </br>
                        @endforeach
                    @endif
                  </span>
                  <label class="form__label" for="">CXR result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">
                        {{ $tbMacForm->laboratoryResults->ct_scan_date ? $tbMacForm->laboratoryResults->ct_scan_date->format('m/d/y') : '' }}</span>
                    <label class="form__label" for="">CT Scan date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ $tbMacForm->laboratoryResults->ct_scan_result }}
                  </span>
                  <label class="form__label" for="">CT Scan result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $tbMacForm->laboratoryResults->ultrasound_date ? $tbMacForm->laboratoryResults->ultrasound_date->format('m/d/y') : '' }}</span>
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
                    <span class="form__text">{{ $tbMacForm->laboratoryResults->hispathological_date ? $tbMacForm->laboratoryResults->hispathological_date->format('m/d/y') : '' }}</span>
                    <label class="form__label" for="">Histopatholigical date</label>
                </div>
                <div class="form__content">
                  <span class="form__text">
                    {{ $tbMacForm->laboratoryResults->hispathological_result }}
                  </span>
                  <label class="form__label" for="">Histopatholigical result</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Related media</h2>
              <ul class="form__gallery">
                @foreach($tbMacForm->attachments as $key => $attachment)
                  <li class="form__gallery-item">
                    @php
                      $fileName = ($key+1).'.'.$attachment->extension;
                    @endphp
                    <img class="image" src="{{ url('enrollments/'.$tbMacForm->id.'/'.$fileName.'/attachment') }}" alt="Placeholder" />
                  </li>
                @endforeach
              </ul>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          {{-- <form class="form form--half" action="">
            <h2 class="section__heading">Remarks | Recommendations</h2>
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="src/img/icon-user.png" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">[Healthcare worker name]<span class="form__label">[Role] | [Region]</span></h2>
                  <label class="form__label">06 June 2021</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="src/img/icon-flag.png" alt="action icon" />
                  <div class="form__content"><span class="form__text form__text--green">New case</span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum commodo turpis eu elit egestas lobortis. Quisque semper risus nec lacus condimentum consectetur. Quisque facilisis nibh a tincidunt gravida. Aliquam ut
                  velit magna. Nullam eu felis nunc. Sed at neque porttitor sapien convallis suscipit at pulvinar orci. Aliquam quis sodales massa, sed dictum magna. Vestibulum quis risus non eros sollicitudin tristique vel eget urna.
                  Donec at diam libero. Donec iaculis velit in enim pretium vulputate.
                </span>
              </div>
            </div>
          </form> --}}
        </div>
      </div>

     
  
@endsection

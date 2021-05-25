@extends('layouts.app')

@section('title', 'Create treatment outcome')
@section('description', 'Create treatment outcome')

@section('additional_styles')
    <link type="text/css" href="{{ asset('assets/app/css/forms.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="section">

    <div class="section__top">
      <div class="section__top-text">
        <h1 class="section__title">Create new treatment outcome</h1>
        <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('treatment-outcomes') }}">Treatment outcome</a>
          <a class="breadcrumbs__link">Create new treatment outcome</a>
          <a class="breadcrumbs__link"></a>
        </div>
      </div>
      <div class="section__top-menu">
        <input class="section__top-trigger" type="checkbox" />
        <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
        <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
      </div>
    </div>

    @include('partials.alerts')

    <div class="section__container">
        <form class="form" id="treatment-outcome-form" action="{{ url('treatment-outcomes') }}" method="post" enctype="multipart/form-data">
          @csrf
            <div id="steps" data-steps="3">
              @include('treatment-outcomes.steps.step-1')
              @include('treatment-outcomes.steps.step-2')
              @include('treatment-outcomes.steps.step-3')
            </div>
        </form>
        @include('partials.confirmation-modal')
        <div class="modal" id="loadingModal">
          <div class="modal__background" data-dismiss="modal"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">Finding match in database</h2>
              <p class="modal__text">Please make sure TB Case Number and Last name are correct.</p>
              <div class="modal__button modal__button--center">
                <div class="loader"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal" id="noMatchModal">
          <div class="modal__background" data-dismiss="modal"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">We did not find a match</h2>
              <p class="modal__text">Please make sure TB Case Number and Last name are correct.</p>
              <div class="modal__button">
                <a href="{{ url('treatment-outcomes') }}" class="button button--transparent" data-dismiss="modal">Cancel</a>
                <input class="button" type="button" value="Proceed manually" id="proceedManually"/>
              </div>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection

@section('additional_scripts')
  
  <script src="{{ asset('assets/app/js/bootstrap-validator.js') }}"></script>  
  <script src="{{ asset('assets/app/js/treatment-outcome/form.js') }}"></script>

  <script src="{{ asset('assets/app/js/dropzone.js') }}"></script>
  <script src="{{ asset('assets/app/js/dropzoneInit.js') }}"></script>
  <script src="{{ asset('assets/app/js/treatment-outcome/create-2.js') }}"></script>   

@endsection

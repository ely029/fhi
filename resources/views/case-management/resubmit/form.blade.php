@extends('layouts.app')

@section('title', 'Create Case')
@section('description', 'Create Case')

@section('additional_styles')
    <link type="text/css" href="{{ asset('assets/app/css/forms.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="section">
<div class="section__top">
      <div class="section__top-text">
      <h1 class="section__title">Create new case</h1>
        <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('case-management') }}">Case Management</a><a class="breadcrumbs__link">Create new case</a><a class="breadcrumbs__link"></a></div>
      </div>
      <div class="section__top-menu">
        <input class="section__top-trigger" type="checkbox" />
        <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
        <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
      </div>
    </div>

    @include('partials.alerts')

    <div class="section__container">
        <form class="form" id="case-management-form" action="{{ url('case-management/resubmit/'.$tbMacForm->id) }}" method="post" enctype="multipart/form-data">
          @csrf
            <div id="steps" data-steps="4">
              @include('case-management.resubmit.create-1')
              @include('case-management.resubmit.create-2')
              @include('case-management.resubmit.create-3')
              @include('case-management.resubmit.create-4')
            </div>
        </form>
        @include('partials.confirmation-modal')
        <div class="modal">
          <div class="modal__background" data-dismiss="modal"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">Finding match in database</h2>
              <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
              <div class="modal__button modal__button--center"><div class="loader"></div></div>
            </div>
          </div>
        </div>
        <div class="modal">
          <div class="modal__background" data-dismiss="modal"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">We did not find a match</h2>
              <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
              <div class="modal__button"><button class="button button--transparent" data-dismiss="modal" type="button">Cancel</button><input class="button" type="submit" value="Proceed manually" /></div>
            </div>
          </div>
        </div>
      </div>
  </div>
@endsection

@section('additional_scripts')
  
  <script src="{{ asset('assets/app/js/bootstrap-validator.js') }}"></script>  
  <script src="{{ asset('assets/app/js/forms.js') }}"></script>

  <script src="{{ asset('assets/app/js/dropzone.js') }}"></script>  
  <script src="{{ asset('assets/app/js/dropzoneInit.js') }}"></script>
  <script src="{{ asset('assets/app/js/case-management/create-2.js') }}"></script>   
  <script src="{{ asset('assets/app/js/case-management/create-3.js') }}"></script>   
  <script src="{{ asset('assets/app/js/case-management/resubmit.js') }}"></script> 
  <script src="{{ asset('assets/app/js/case-management/current_regimen.js') }}"></script>

@endsection

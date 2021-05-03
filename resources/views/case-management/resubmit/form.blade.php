@extends('layouts.app')

@section('title', 'Create Case')
@section('description', 'Create Case')

@section('additional_styles')
    <link type="text/css" href="{{ asset('assets/app/css/forms.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">Create new Case</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('enrollments') }}">Case Management</a>
        <a class="breadcrumbs__link">Create new Case</a>
        <a class="breadcrumbs__link"></a>
      </div>
    </div>

    @include('partials.alerts')

    <div class="section__container">
        <form class="form" id="enrollment-form" action="{{ url('case-management/resubmit/'.$tbMacForm->id) }}" method="post" enctype="multipart/form-data">
          @csrf
            <div id="steps" data-steps="4">
              @include('case-management.resubmit.create-1')
              @include('case-management.resubmit.create-2')
              @include('case-management.resubmit.create-3')
            </div>
        </form>
  
        <div class="modal js-modal">
          <div class="modal__background js-modal-background"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">Finding match in database</h2>
              <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
              <div class="modal__button modal__button--center"><div class="loader"></div></div>
            </div>
          </div>
        </div>
        <div class="modal js-modal">
          <div class="modal__background js-modal-background"></div>
          <div class="modal__container">
            <div class="modal__box">
              <h2 class="modal__title">We did not find a match</h2>
              <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
              <div class="modal__button"><button class="button button--transparent js-modal-close" type="button">Cancel</button><input class="button" type="submit" value="Proceed manually" /></div>
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

@endsection

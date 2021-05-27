@extends('layouts.app')

@section('title', 'View Enrollments')
@section('description', 'View Enrollments')

@section('content')

<div class="section">
    <div class="section__top">
    <div class="section__top-text">
    <h1 class="section__title">Enrollments</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Enrollment regimen</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__top-menu">
      <input class="section__top-trigger" type="checkbox" />
      <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
      <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
    </div>
  </div>
    @if (auth()->user()->role_id === 3)
      @include('enrollments.indexes.health-care-worker')
    @endif
    @if (auth()->user()->role_id === 4)
      @include('enrollments.indexes.regional-secretariat')
    @endif
    @if (auth()->user()->role_id === 5)
      @include('enrollments.indexes.rtb-mac')
    @endif
    @if (auth()->user()->role_id === 6)
      @include('enrollments.indexes.rtb-mac-chair')
    @endif
    @if (auth()->user()->role_id === 7)
      @include('enrollments.indexes.ntb-mac')
    @endif

    @if (auth()->user()->role_id === 8)
      @include('enrollments.indexes.ntb-mac-chair')
    @endif
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

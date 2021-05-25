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
@endsection

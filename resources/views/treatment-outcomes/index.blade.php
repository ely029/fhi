@extends('layouts.app')

@section('title', 'Treatment Outcome')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
@include('partials.sidebar')

<div class="section">
  <div class="section__top">
    <div class="section__top-text">
    <h1 class="section__title">Treatment Outcome</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Treatment Outcome</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__top-menu">
      <input class="section__top-trigger" type="checkbox" />
      <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
      <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
    </div>
  </div>
  @if (auth()->user()->role_id === 3)
    @include('treatment-outcomes.indexes.health-care-worker')
  @endif
  @if (auth()->user()->role_id === 4)
     @include('treatment-outcomes.indexes.regional-secretariat')
  @endif
  @if (auth()->user()->role_id === 5)
     @include('treatment-outcomes.indexes.rtb-mac')
  @endif
  @if (auth()->user()->role_id === 6)
     @include('treatment-outcomes.indexes.rtb-mac-chair')
  @endif
  @if (auth()->user()->role_id === 7)
     @include('treatment-outcomes.indexes.ntb-mac')
  @endif
  @if (auth()->user()->role_id === 8)
     @include('treatment-outcomes.indexes.ntb-mac-chair')
  @endif
  </div>

</div>
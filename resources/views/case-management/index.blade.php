@extends('layouts.app')

@section('title', 'Case Management')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
@include('partials.sidebar')

<div class="section">
  <div class="section__top">
      <h1 class="section__title">Case Management</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Case Management</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
  </div>
  @if (auth()->user()->role_id === 3)
    @include('case-management.indexes.health-care-worker')
  @endif
  @if (auth()->user()->role_id === 4)
    @include('case-management.indexes.regional-secretariat')
  @endif
  @if (auth()->user()->role_id === 5)
    @include('case-management.indexes.rtb-mac')
  @endif
  @if (auth()->user()->role_id === 6)
    @include('case-management.indexes.rtb-mac-chair')
  @endif
  @if (auth()->user()->role_id === 7)
    @include('case-management.indexes.ntb-mac')
  @endif
  @if (auth()->user()->role_id === 8)
    @include('case-management.indexes.ntb-mac-chair')
  @endif
  </div>

</div>
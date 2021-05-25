@extends('layouts.admin.dashboard')

@section('title', 'Enrollment')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
  @include('includes.sidebar')

  <div class="section">
    <div class="section__top">
      <div class="section__top-text">
      <h1 class="section__title">Create new enrollment</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="enrollment.html">Enrollment Regimen</a>
        <a class="breadcrumbs__link">Create new enrollment</a>
        <a class="breadcrumbs__link"></a>
      </div>
      </div>
      <div class="section__top-menu">
        <input class="section__top-trigger" type="checkbox" />
        <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
        <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
      </div>
    </div>
    
    <div class="section__container">
      <form class="form" id="js-form" action="">
       
      </form>    
    </div>
  </div>
</div>
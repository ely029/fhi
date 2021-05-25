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
        <div class="form__tab">
          <div class="form__container">
            <h2 class="section__heading">Case information 2</h2>
            <div class="grid">
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option>Drug-susceptible</option>
                  <option>Bacteriologically-confirmed RR-TB</option>
                  <option>Bacteriologically-confirmed MDR-TB</option>
                  <option>Bacteriologically-confirmed Pre-XDR-TB</option>
                  <option>Bacteriologically-confirmed XDR-TB</option>
                  <option>Clinically-confirmed MDR-TB</option>
                  <option>Other Drug-resistant TB</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Drug susceptibility</label>
              </div>
              <div class="form__content form__content--small"><input class="form__input" type="number" placeholder="Current weight (kg)" /><label class="form__label" for="">Current weight (kg)</label></div>
            </div>
            <div class="form__content">
              <select class="form__input form__input--select">
                <option>Regimen 3 SSOR</option>
                <option>Regimen 4 SLOR FQ-S</option>
                <option>Regimen 5 SLOR FQ-R</option>
                <option>Regimen 6a SLOR FQ-S</option>
                <option>Regimen 6b SLOR FQ-S</option>
                <option>Regimen 6c SLOR FQ-S</option>
                <option>Regimen 7a SLOR FQ-R</option>
                <option>Regimen 7b SLOR FQ-R</option>
                <option>Regimen 7c SLOR FQ-R</option>
                <option>ITR</option>
                <option>BPaL</option>
                <option>Other (specify)</option>
              </select>
              <div class="triangle triangle--down"></div>
              <label class="form__label" for="">Suggested regimen</label>
            </div>
            <div class="form__content"><textarea class="form__input form__input--message" placeholder=""></textarea><label class="form__label" for="">Regimen notes</label></div>
          </div>
          <div class="form__container">
            <h2 class="section__heading">If for treatment of clinically diagnosed cases</h2>
            <div class="form__content"><textarea class="form__input form__input--message" placeholder="Clinical Status"></textarea><label class="form__label" for="">Clinical status</label></div>
            <div class="form__content"><input class="form__input" type="text" placeholder="Signs and symptoms" /><label class="form__label" for="">Signs and symptoms</label></div>
            <div class="form__content"><input class="form__input" type="text" placeholder="Vital signs" /><label class="form__label" for="">Vital signs</label></div>
            <div class="form__content"><input class="form__input" type="text" placeholder="Pertinent diagnostic and laboratory findings" /><label class="form__label" for="">Pertinent diagnostic and laboratory findings</label></div>
          </div>
        </div>
        <div class="form__button form__button--space form__button--pagination">
          <a class="button button--back" href="">Back</a><a class="button button--next" href="">Next</a>
        </div>
      </form>    
    </div>
  </div>
</div>

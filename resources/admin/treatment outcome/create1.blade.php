@extends('layouts.admin.dashboard')

@section('title', 'Treatment outcome')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
  @include('includes.sidebar')

<div class="section">
  <div class="section__top">
  <h1 class="section__title">Create new treatment outcome</h1>
  <div class="breadcrumbs"><a class="breadcrumbs__link" href="treatment.html">Treatment outcome</a><a class="breadcrumbs__link">Create new treatment outcome</a><a class="breadcrumbs__link"></a></div>
  </div>
  <div class="section__container">
    <form class="form" id="js-form" action="">
      <div class="form__tab">
        <h2 class="section__heading">Patient Information</h2>
        <div class="grid grid--two">
          <div class="form__content"><input class="form__input" id="tbNumber" type="number" min="0" placeholder="TB Case number" /><label class="form__label" for="">Case number</label></div>
          <div class="form__content"><input class="form__input" id="lastName" type="text" placeholder="Last name" /><label class="form__label" for="">Last name</label></div>
        </div>
        <div class="grid grid--two">
          <div class="form__content"><input class="form__input" id="firstName" type="text" placeholder="First name" /><label class="form__label" for="">First name</label></div>
          <div class="form__content"><input class="form__input" id="middleName" type="text" placeholder="Middle name" /><label class="form__label" for="">Middle name</label></div>
        </div>
        <div class="grid grid--two">
          <div class="form__content"><input class="form__input" id="facilityCode" type="number" min="0" placeholder="Facility code" /><label class="form__label" for="">Facility code</label></div>
          <div class="form__content">
            <select class="form__input form__input--select" id="province" disabled>
            <option value="Metro Manila">Metro Manila</option>
            <option value="Abra">Abra</option>
            <option value="Agusan del Norte">Agusan del Norte</option>
            <option value="Agusan del Sur">Agusan del Sur</option>
            <option value="Aklan">Aklan</option>
            <option value="Albay">Albay</option>
            <option value="Antique">Antique</option>
            <option value="Apayao">Apayao</option>
            <option value="Aurora">Aurora</option>
            <option value="Basilan">Basilan</option>
            <option value="Bataan">Bataan</option>
            <option value="Batanes">Batanes</option>
            <option value="Batangas">Batangas</option>
            <option value="Biliran">Biliran</option>
            <option value="Benguet">Benguet</option>
            <option value="Bohol">Bohol</option>
            <option value="Bukidnon">Bukidnon</option>
            <option value="Bulacan">Bulacan</option>
            <option value="Cagayan">Cagayan</option>
            <option value="Camarines Norte">Camarines Norte</option>
            <option value="Camarines Sur">Camarines Sur</option>
            <option value="Camiguin">Camiguin</option>
            <option value="Capiz">Capiz</option>
            <option value="Catanduanes">Catanduanes</option>
            <option value="Cavite">Cavite</option>
            <option value="Cebu">Cebu</option>
            <option value="Compostela">Compostela</option>
            <option value="Davao del Norte">Davao del Norte</option>
            <option value="Davao del Sur">Davao del Sur</option>
            <option value="Davao Oriental">Davao Oriental</option>
            <option value="Eastern Samar">Eastern Samar</option>
            <option value="Guimaras">Guimaras</option>
            <option value="Ifugao">Ifugao</option>
            <option value="Ilocos Norte">Ilocos Norte</option>
            <option value="Ilocos Sur">Ilocos Sur</option>
            <option value="Iloilo">Iloilo</option>
            <option value="Isabela">Isabela</option>
            <option value="Kalinga">Kalinga</option>
            <option value="Laguna">Laguna</option>
            <option value="Lanao del Norte">Lanao del Norte</option>
            <option value="Lanao del Sur">Lanao del Sur</option>
            <option value="La Union">La Union</option>
            <option value="Leyte">Leyte</option>
            <option value="Maguindanao">Maguindanao</option>
            <option value="Marinduque">Marinduque</option>
            <option value="Masbate">Masbate</option>
            <option value="Mindoro Occidental">Mindoro Occidental</option>
            <option value="Mindoro Oriental">Mindoro Oriental</option>
            <option value="Misamis Occidental">Misamis Occidental</option>
            <option value="Misamis Oriental">Misamis Oriental</option>
            <option value="Mountain Province">Mountain Province</option>
            <option value="Negros Occidental">Negros Occidental</option>
            <option value="Negros Oriental">Negros Oriental</option>
            <option value="North Cotabato">North Cotabato</option>
            <option value="Northern Samar">Northern Samar</option>
            <option value="Nueva Ecija">Nueva Ecija</option>
            <option value="Nueva Vizcaya">Nueva Vizcaya</option>
            <option value="Palawan">Palawan</option>
            <option value="Pampanga">Pampanga</option>
            <option value="Pangasinan">Pangasinan</option>
            <option value="Quezon">Quezon</option>
            <option value="Quirino">Quirino</option>
            <option value="Rizal">Rizal</option>
            <option value="Romblon">Romblon</option>
            <option value="Samar">Samar</option>
            <option value="Sarangani">Sarangani</option>
            <option value="Siquijor">Siquijor</option>
            <option value="Sorsogon">Sorsogon</option>
            <option value="South Cotabato">South Cotabato</option>
            <option value="Southern Leyte">Southern Leyte</option>
            <option value="Sultan Kudarat">Sultan Kudarat</option>
            <option value="Sulu">Sulu</option>
            <option value="Surigao del Norte">Surigao del Norte</option>
            <option value="Surigao del Sur">Surigao del Sur</option>
            <option value="Tarlac">Tarlac</option>
            <option value="Tawi-Tawi">Tawi-Tawi</option>
            <option value="Zambales">Zambales</option>
            <option value="Zamboanga del Norte">Zamboanga del Norte</option>
            <option value="Zamboanga del Sur">Zamboanga del Sur</option>
            <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Province</label>
        </div>
        </div>
        <div class="grid grid--two">
          <div class="form__content"><input class="form__input" id="birthday" type="date" placeholder="Birthday" /><label class="form__label" for="">Birthday</label></div>
          <div class="form__content">
            <select class="form__input form__input--select" id="gender">
            <option>Male</option>
            <option>Female</option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Gender</label>
          </div>
        </div>
        <div class="grid grid--two">
          <div class="form__content">
            <select class="form__input form__input--select" id="drugSusceptibility">
            <option> </option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Drug susceptibility</label>
          </div>
          <div class="form__content">
            <select class="form__input form__input--select" id="outcome">
            <option> </option>
            <option> </option>
            <option> </option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Outcome</label>
          </div>
        </div>
      </div>
      <div class="form__button form__button--space form__button--pagination">
        <a class="button button--next" href="">Next</a>
      </div>
    </form>
  </div>
</div>
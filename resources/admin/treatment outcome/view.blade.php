@extends('layouts.admin.dashboard')

@section('title', 'Treatment outcome')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
@include('includes.sidebar')

  <div class="section">
    <div class="section__top">
      <h1 class="section__title">12345 RAGT 18F</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="treatment.html">Treatment outcome</a><a class="breadcrumbs__link">View</a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__container">
      <ul class="tabs__list tabs__list--sub">
        <li class="tabs__item-sub tabs__item-sub--current">Treatment outcome</li>
        <li class="tabs__item-sub">Case management</li>
        <li class="tabs__item-sub">Enrollment</li>
      </ul>

      <div class="tabs__details-sub tabs__details-sub--active">
        <form class="form" action="">
          <div class="grid grid--two grid--start">
            <div class="form--quarter">
              <div class="form__container">
                <h2 class="section__heading">Patient RAGT 18F<span class="form__text">Facility 2323 &nbsp;&nbsp;&nbsp; Ilocos Norte</span></h2>
                <div class="form__content"><span class="form__text">New case</span><label class="form__label" for="">Status</label></div>
                <br />
                <div class="grid grid--three">
                  <div class="form__content"><span class="form__text">212121</span><label class="form__label" for="">TB case number</label></div>
                  <div class="form__content"><span class="form__text">sample text</span><label class="form__label" for="">Drug susceptibility</label></div>
                  <div class="form__content"><span class="form__text">crued</span><label class="form__label" for="">Outcome</label></div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Healthcare worker</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">orem</span><label class="form__label" for="">Primary healthcare worker </label></div>
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Date submitted</label></div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr class="line" />
        <ul class="tabs__list">
          <li class="tabs__item tabs__item--current">Bacteriological results</li>
          <li class="tabs__item">Case information</li>
          <li class="tabs__item">Remarks &amp; Recommendations</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Screenings</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                    <th class="table__head">Method used</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">Screening 1</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                  <tr class="table__row">
                    <td class="table__details">Screening 2</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">LPA information</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">LSA</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">DST information</h2>
              <div class="form__content"><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><label class="form__label" for="">Name of laboratory</label></div>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">DST</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">DST information</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head">Month</th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Smear microscopy</th>
                    <th class="table__head">TB-LAMP</th>
                    <th class="table__head">Culture</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">Screening 1</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Treatment information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">06/20/2021 ➞ Treatment unit 1 ➞ Drug name 1 5 weeks ➞ Success</span><label class="form__label" for="">Treatment history</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Previous Treatment Outcome Unknown</span><label class="form__label" for="">Registration group</label></div>
                <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">Risk factor</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Current bacteriological result</h2>
              <ul class="card">
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Regimen information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Stable/Unchange</span><label class="form__label" for="">Facility code</label></div>
                <div class="form__content"><span class="form__text">45kg</span><label class="form__label" for="">Current weight</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Regimen 6b SLOR FQ-S</span><label class="form__label" for="">Current regimen </label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text"></span>
                  <label class="form__label" for="">Regimen notes</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Suggested regimen</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">ITR</span><label class="form__label" for="">Suggested regiment</label></div>
                <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">ITR Drugs</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text"></span>
                  <label class="form__label" for="">Suggested Regimen notes</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Bacteriologically-confirmd XDR-TB</span><label class="form__label" for="">Update type of case, if applicable</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Laboratory results and information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CXR date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CXR result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CT Scan date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CT Scan result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Ultrasound date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Ultrasound result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Histopathological date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Histopathological result</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Related media</h2>
              <ul class="form__gallery">
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
              </ul>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          <form class="form form--half" action="">
            <h2 class="section__heading">Remarks | Recommendations</h2>
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="src/img/icon-user.png" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">[Healthcare worker name]<span class="form__label">[Role] | [Region]</span></h2>
                  <label class="form__label">06 June 2021</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="src/img/icon-flag.png" alt="action icon" />
                  <div class="form__content"><span class="form__text form__text--green">New case</span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
               sample text
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="tabs__details-sub">
        <form class="form" action="">
          <div class="grid grid--two grid--start">
            <div class="form--quarter">
              <div class="form__container">
                <h2 class="section__heading">Patient RAGT 18F<span class="form__text">Facility 2323 &nbsp;&nbsp;&nbsp; Ilocos Norte</span></h2>
                <div class="form__content"><span class="form__text">New case</span><label class="form__label" for="">Status</label></div>
                <br />
                <div class="grid grid--three">
                  <div class="form__content"><span class="form__text">212121</span><label class="form__label" for="">TB case number</label></div>
                  <div class="form__content"><span class="form__text">may</span><label class="form__label" for="">Month of treatment</label></div>
                  <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">Current drug susceptibility</label></div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Healthcare worker</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">orem</span><label class="form__label" for="">Primary healthcare worker </label></div>
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Date submitted</label></div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr class="line" />
        <ul class="tabs__list">
          <li class="tabs__item tabs__item--current">Bacteriological results</li>
          <li class="tabs__item">Case information</li>
          <li class="tabs__item">Remarks &amp; Recommendations</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Screenings</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                    <th class="table__head">Method used</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">Screening 1</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                  <tr class="table__row">
                    <td class="table__details">Screening 2</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">LPA information</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">LSA</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">DST information</h2>
              <div class="form__content"><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><label class="form__label" for="">Name of laboratory</label></div>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head"></th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Resistance pattern</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">DST</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="form__container">
              <h2 class="section__heading">DST information</h2>
              <table class="table table--unset js-table-unset">
                <thead>
                  <tr>
                    <th class="table__head">Month</th>
                    <th class="table__head">Done date</th>
                    <th class="table__head">Smear microscopy</th>
                    <th class="table__head">TB-LAMP</th>
                    <th class="table__head">Culture</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="table__row">
                    <td class="table__details">Screening 1</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                    <td class="table__details">sample</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Treatment information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">06/20/2021 ➞ Treatment unit 1 ➞ Drug name 1 5 weeks ➞ Success</span><label class="form__label" for="">Treatment history</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Previous Treatment Outcome Unknown</span><label class="form__label" for="">Registration group</label></div>
                <div class="form__content"><span class="form__text">sample text</span><label class="form__label" for="">Risk factor</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Current bacteriological result</h2>
              <ul class="card">
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Regimen information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Stable/Unchange</span><label class="form__label" for="">Facility code</label></div>
                <div class="form__content"><span class="form__text">45kg</span><label class="form__label" for="">Current weight</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Regimen 6b SLOR FQ-S</span><label class="form__label" for="">Current regimen </label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">sample text</span>
                  <label class="form__label" for="">Regimen notes</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Suggested regimen</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">ITR</span><label class="form__label" for="">Suggested regiment</label></div>
                <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">ITR Drugs</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">sample text</span>
                  <label class="form__label" for="">Suggested Regimen notes</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Bacteriologically-confirmd XDR-TB</span><label class="form__label" for="">Update type of case, if applicable</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Laboratory results and information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CXR date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CXR result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CT Scan date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CT Scan result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Ultrasound date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Ultrasound result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Histopathological date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Histopathological result</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Related media</h2>
              <ul class="form__gallery">
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
              </ul>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          <form class="form form--half" action="">
            <h2 class="section__heading">Remarks | Recommendations</h2>
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="src/img/icon-user.png" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">[Healthcare worker name]<span class="form__label">[Role] | [Region]</span></h2>
                  <label class="form__label">06 June 2021</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="src/img/icon-flag.png" alt="action icon" />
                  <div class="form__content"><span class="form__text form__text--green">New case</span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
                    sample text
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="tabs__details-sub">
        <form class="form" action="">
          <div class="grid grid--two grid--start">
            <div class="form--quarter">
              <div class="form__container">
                <h2 class="section__heading">Patient RAGT 18F<span class="form__text">Facility 2323 &nbsp;&nbsp;&nbsp; Ilocos Norte</span></h2>
                <div class="form__content"><span class="form__text">New case</span><label class="form__label" for="">Status</label></div>
                <br />
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">may</span><label class="form__label" for="">Month of treatment</label></div>
                </div>
              </div>
              <div class="form__container">
                <h2 class="section__heading">Healthcare worker</h2>
                <div class="grid grid--two">
                  <div class="form__content"><span class="form__text">orem</span><label class="form__label" for="">Primary healthcare worker </label></div>
                  <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Date submitted</label></div>
                </div>
              </div>
            </div>
          </div>
        </form>
        <hr class="line" />
        <ul class="tabs__list">
          <li class="tabs__item tabs__item--current">Case information</li>
          <li class="tabs__item">Remarks &amp; Recommendations</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <form class="form" action="">
            <div class="form__container">
              <h2 class="section__heading">Treatment information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">06/20/2021 ➞ Treatment unit 1 ➞ Drug name 1 5 weeks ➞ Success</span><label class="form__label" for="">Treatment history</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Previous Treatment Outcome Unknown</span><label class="form__label" for="">Registration group</label></div>
                <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">Risk factor</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Current bacteriological result</h2>
              <ul class="card">
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
                <li class="card__item">
                  <div class="form__container">
                    <span class="form__text form__text--bold">TB Loop-Mediated Isothermal</span><span class="form__text">Tondo Foreshore Health Center Lying-In- IDOTS</span><span class="form__text">10 June 2021</span>
                  </div>
                  <div class="form__container">
                    <div class="form__content"><span class="form__text">Indeterminate</span><label class="form__label" for="">Result </label></div>
                  </div>
                </li>
              </ul>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Regimen information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Stable/Unchange</span><label class="form__label" for="">Facility code</label></div>
                <div class="form__content"><span class="form__text">45kg</span><label class="form__label" for="">Current weight</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Regimen 6b SLOR FQ-S</span><label class="form__label" for="">Current regimen </label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">sample text</span>
                  <label class="form__label" for="">Regimen notes</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Suggested regimen</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">ITR</span><label class="form__label" for="">Suggested regiment</label></div>
                <div class="form__content"><span class="form__text">sample</span><label class="form__label" for="">ITR Drugs</label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content">
                  <span class="form__text">sample text</span>
                  <label class="form__label" for="">Suggested Regimen notes</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Bacteriologically-confirmd XDR-TB</span><label class="form__label" for="">Update type of case, if applicable</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Laboratory results and information</h2>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CXR date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CXR result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">CT Scan date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">CT Scan result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Ultrasound date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Ultrasound result</label>
                </div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">12/12/12</span><label class="form__label" for="">Histopathological date</label></div>
                <div class="form__content">
                  <span class="form__text">
                    
                  </span>
                  <label class="form__label" for="">Histopathological result</label>
                </div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Related media</h2>
              <ul class="form__gallery">
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
                <li class="form__gallery-item"><img class="image" src="src/img/placeholder.jpg" alt="Placeholder" /></li>
              </ul>
            </div>
          </form>
        </div>
        <div class="tabs__details">
          <form class="form form--half" action="">
            <h2 class="section__heading">Remarks | Recommendations</h2>
            <div class="form__container form__container--remarks">
              <img class="image image--user" src="src/img/icon-user.png" alt="user icon" />
              <div class="form__container">
                <div class="grid grid--two">
                  <h2 class="section__heading section__heading--healthworker">[Healthcare worker name]<span class="form__label">[Role] | [Region]</span></h2>
                  <label class="form__label">06 June 2021</label>
                </div>
                <div class="form__container form__container--remarks form__container--actions">
                  <img class="image image--flag" src="src/img/icon-flag.png" alt="action icon" />
                  <div class="form__content"><span class="form__text form__text--green">New case</span><label class="form__label form__label--green">Action</label></div>
                </div>
                <span class="form__text">
                  sample text
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
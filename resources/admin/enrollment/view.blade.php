@extends('layouts.admin.dashboard')

@section('title', 'Enrollment')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
    @include('includes.sidebar')

    <div class="section">

        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">12345 RAGT 18F</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link" href="enrollment.html">Enrollment Regimen</a><a class="breadcrumbs__link">View</a><a class="breadcrumbs__link"></a></div>
          </div>
          <div class="section__top-menu">
            <input class="section__top-trigger" type="checkbox" />
            <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
            <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
          </div>
        </div>
        <div class="section__container">
          <form class="form" action="">
            <div class="grid grid--two grid--unset">
              <div class="form--quarter">
                <div class="form__container">
                  <h2 class="section__heading">Patient RAGT 18F<span class="form__text">Facility 2323 &nbsp;&nbsp;&nbsp; Ilocos Norte</span></h2>
                  <div class="form__content"><span class="form__text">New case</span><label class="form__label" for="">Status</label></div>
                  <br />
                  <div class="grid grid--two">
                    <div class="form__content"><span class="form__text">may</span><label class="form__label" for="">Month of treatment</label></div>
                    <div class="form__content"><span class="form__text"></span><label class="form__label" for="">Current type of case </label></div>
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
              <div class="grid grid--action">
                <div class="form__content">
                  <select class="form__input form__input--select">
                    <option>New</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Action</label>
                </div>
                <button class="button" type="button">Confirm</button>
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
                  <div class="form__content"><span class="form__text"></span><label class="form__label" for="">Risk factor</label></div>
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
                  <div class="form__content"><span class="form__text"></span><label class="form__label" for="">ITR Drugs</label></div>
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

                  </span>
                </div>
              </div>
              <div class="modal js-modal">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Confirm Enrollment</h2>
                    <p class="modal__text">You are about to confirm 'Enrollment' for this case and patient. If you have additional remarks, enter them below.</p>
                    <form class="form">
                      <div class="form__content"><textarea class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                    </form>
                    <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                  </div>
                </div>
              </div>
              <div class="modal js-modal">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Confirm Not for enrollment</h2>
                    <p class="modal__text">You are about to confirm 'Not for ennrollment' for this case and patient. If you have additional remarks, enter them below.</p>
                    <form class="form">
                      <div class="form__content"><textarea class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                    </form>
                    <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                  </div>
                </div>
              </div>
              <div class="modal js-modal">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Resubmit new enrolment</h2>
                    <p class="modal__text">You are about to resubmit a new enrolment. Please read and prepare the requested information and documents the remarks and recommendations section.</p>
                    <form class="form">
                      <div class="form__content"><textarea class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                    </form>
                    <div class="modal__button"><input class="button" type="submit" value="Resubmit" /></div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
</div>

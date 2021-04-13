@extends('layouts.admin.dashboard')

@section('title', 'Enrollment')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
  @include('includes.sidebar')

  <div class="section">
    <div class="section__top">
      <h1 class="section__title">Create new enrollment</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link" href="enrollment.html">Enrollment Regimen</a><a class="breadcrumbs__link">Create new enrollment</a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__container">
      <form class="form" id="js-form" action="">
        <div class="form__tab">
          <div class="form__container">
            <h2 class="section__heading">Case information 1</h2>
            <div class="form__content">
              <textarea class="form__input form__input--message" placeholder="Treatment Started ➞ Name of Treatment Unit ➞ Treatment Regimen (Drugs and Duration) ➞ Outcome"></textarea>
              <label class="form__label" for="">Treatment History</label>
            </div>
            <div class="grid grid--two">
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option>New</option>
                  <option>Relapse</option>
                  <option>Treatment After Lost to Follow-up (TALF)</option>
                  <option>Treatment After Failure (TAF)</option>
                  <option>Previous Treatment Outcome Unknown (PTOU)</option>
                  <option>Unknown History</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Registration group</label>
              </div>
              <div class="form__content">
                <select class="form__input form__input--select">
                  <option>Retreatment</option>
                  <option>Close Contact of a Confirmed DR-TB</option>
                  <option>Non-converter of a DS-TB Regimen</option>
                </select>
                <div class="triangle triangle--down"></div>
                <label class="form__label" for="">Risk factor</label>
              </div>
            </div>
          </div>
          <div class="form__container">
            <h2 class="section__heading">Current bacteriological result</h2>
            <ul class="form__group">
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll1">Xpert MTB/RIF <input class="form__trigger" id="js-toggle-enroll1" type="checkbox" /><span class="form__checkmark"></span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll1">
                  <div id="js-section1">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section1" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section1" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll2">Xpert MTB/RIF ULTRA <input class="form__trigger" id="js-toggle-enroll2" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll2">
                  <div id="js-section2">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section2" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section2" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll3">Truenat TB <input class="form__trigger" id="js-toggle-enroll3" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll3">
                  <div id="js-section3">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section3" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section3" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll4">Line Probe Assay (LPA) <input class="form__trigger" id="js-toggle-enroll4" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll4">
                  <div id="js-section4">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section4" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section4" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll5">Smear Microscop <input class="form__trigger" id="js-toggle-enroll5" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll5">
                  <div id="js-section5">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section5" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section5" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll6">TB Loop-Mediated Isothermal<input class="form__trigger" id="js-toggle-enroll6" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll6">
                  <div id="js-section6">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section6" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section6" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll7">Amplification (TB-LAMP)<input class="form__trigger" id="js-toggle-enroll7" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll7">
                  <div id="js-section7">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section7" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section7" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll8">TB Culture<input class="form__trigger" id="js-toggle-enroll8" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll8">
                  <div id="js-section8">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section8" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section8" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll9">Drug Susceptibility Test (DST)<input class="form__trigger" id="js-toggle-enroll9" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll9">
                  <div id="js-section9">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section9" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section9" type="button">Add one more</button>
                </div>
              </li>
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll10">Others<input class="form__trigger" id="js-toggle-enroll10" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll10">
                  <div id="js-section10">
                    <div class="js-section-others">
                      <div class="form__content"><input class="form__input" type="text" placeholder="Please specify" /><label class="form__label" for="">Please specify</label></div>
                      <div class="grid grid--three grid--close">
                        <div class="form__content"><input class="form__input" type="date" placeholder="Date done" /><label class="form__label" for="">Date done</label></div>
                        <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                        <div class="form__content">
                          <select class="form__input form__input--select">
                            <option> </option>
                            <option> </option>
                            <option> </option>
                          </select>
                          <div class="triangle triangle--down"></div>
                          <label class="form__label" for="">Result</label>
                        </div>
                        <img class="image image--close image--relative js-delete-section10" src="src/img/icon-close.png" />
                      </div>
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section10" type="button">Add one more</button>
                </div>
              </li>
            </ul>
          </div>
          <div class="form__container">
            <h2 class="section__heading">DST from Other Laboratory</h2>
            <ul class="form__group">
              <li class="form__group-item">
                <label class="form__sublabel" id="enroll11">Drug Susceptibility Test (DST)<input class="form__trigger" id="js-toggle-enroll11" type="checkbox" /><span class="form__checkmark"> </span></label>
                <div class="form__trigger-content" id="js-toggle-content-enroll11">
                  <div id="js-section11">
                    <div class="grid grid--three grid--close">
                      <div class="form__content"><input class="form__input" type="date" placeholder="Date collected" /><label class="form__label" for="">Date collected</label></div>
                      <div class="form__content"><input class="form__input" type="text" placeholder="Name of laboratory" /><label class="form__label" for="">Name of laboratory</label></div>
                      <div class="form__content">
                        <select class="form__input form__input--select">
                          <option> </option>
                          <option> </option>
                          <option> </option>
                        </select>
                        <div class="triangle triangle--down"></div>
                        <label class="form__label" for="">Result</label>
                      </div>
                      <img class="image image--close image--relative js-delete-section11" src="src/img/icon-close.png" />
                    </div>
                  </div>
                  <button class="button button--transparent" id="js-add-section11" type="button">Add one more</button>
                </div>
              </li>
            </ul>
          </div>
        </div>
        <div class="form__button form__button--space form__button--pagination">
          <a class="button button--back" href="">Back</a><a class="button button--next" href="">Next</a>
        </div>
      </form>    
    </div>
  </div>
</div>
<div class="form__tab step-2">
    <div class="form__container form-step-2">
      <h2 class="section__heading">Case information 1</h2>
      <div class="form__content form-group">
        <textarea class="form__input form__input--message" name="treatment_history" required placeholder="Treatment Started ➞ Name of Treatment Unit ➞ Treatment Regimen (Drugs and Duration) ➞ Outcome">{{ $tbMacForm->enrollmentForm->treatment_history }}</textarea>
        <label class="form__label" for="">Treatment History</label>
        <div class="help-block with-errors"></div>
      </div>
      <div class="grid grid--two">
        <div class="form__content">
          <input type="hidden" id="registration_group" value="{{ $tbMacForm->enrollmentForm->registration_group }}">
          <select class="form__input form__input--select" name="registration_group" id="registration-group-select">
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
          <input type="hidden" id="risk_factor" value="{{ $tbMacForm->enrollmentForm->risk_factor }}">
          <select class="form__input form__input--select" name="risk_factor" id="risk_factor-select">
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
          @php
            $bacteriologicalResults = $tbMacForm->bacteriologicalResults->filter(function ($item) {
            return $item->type !== 'dst_from_other_lab';
            })->map(function ($item) {
                return [
                    'name' => $item->name,
                    'name_of_laboratory' => $item->name_of_laboratory,
                    'date_collected' => $item->date_collected->format('d F Y'),
                    'result' => $item->result,
                ];
            })->values();

          @endphp
          <input type="hidden" id="bacteriological_status" value="{{ json_encode($bacteriologicalResults) }}"> 
          <label class="form__sublabel" id="enroll1">Xpert MTB/RIF 
            <input class="form__trigger bacteriological-check" data-type="xpert_mtb_rif" id="js-toggle-enroll1" type="checkbox" />
            <span class="form__checkmark"></span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll1">
            <div id="js-section1">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="xpert_mtb_rif"  value="xpert_mtb_rif"/>
                  <input class="form__input xpert_mtb_rif-field" type="date"  name="xpert_mtb_rif-date_collected[]" placeholder="Date collected" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input xpert_mtb_rif-field" type="text" placeholder="Name of laboratory" name="xpert_mtb_rif-name_of_laboratory[]"/>
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select" name="xpert_mtb_rif-result[]">
                    <option>MTB Detected, Rifampicin Resistance Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Not Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Indeterminate</option>
                    <option>MTB Not Detected</option>
                    <option>Invalid/No Result/Error</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section1" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section1" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll2">Xpert MTB/RIF ULTRA 
            <input class="form__trigger bacteriological-check" data-type="xpert_mtb_rif_ultra" id="js-toggle-enroll2" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll2">
            <div id="js-section2">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="xpert_mtb_rif_ultra"  value="xpert_mtb_rif_ultra"/>
                  <input class="form__input xpert_mtb_rif_ultra-field" type="date" name="xpert_mtb_rif_ultra-date_collected[]" placeholder="Date collected" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input xpert_mtb_rif_ultra-field" type="text" placeholder="Name of laboratory" name="xpert_mtb_rif_ultra-name_of_laboratory[]"/>
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content">
                <select class="form__input form__input--select" name="xpert_mtb_rif_ultra-result[]">
                    <option>MTB Detected, Rifampicin Resistance Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Not Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Indeterminate</option>
                    <option>MTB Detected Trace, Rifampicin Resistance Indeterminate</option>
                    <option>MTB Not Detected</option>
                    <option>Invalid/No Result/Error</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section2" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section2" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll3">Truenat TB 
            <input class="form__trigger bacteriological-check"  data-type="truenat_tb" id="js-toggle-enroll3" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll3">
            <div id="js-section3">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="truenat_tb"  value="truenat_tb"/>
                  <input class="form__input truenat_tb-field" type="date" placeholder="Date collected" name="truenat_tb-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input truenat_tb-field" type="text" placeholder="Name of laboratory" name="truenat_tb-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select" name="truenat_tb-result[]">
                    <option>MTB Detected, Rifampicin Resistance Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Not Detected</option>
                    <option>MTB Detected, Rifampicin Resistance Indeterminate</option>
                    <option>MTB Detected Trace, Rifampicin Resistance Indeterminate</option>
                    <option>MTB Not Detected</option>
                    <option>Invalid/No Result/Error</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section3" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section3" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll4">Line Probe Assay (LPA) 
            <input class="form__trigger bacteriological-check" data-type="lpa" id="js-toggle-enroll4" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll4">
            <div id="js-section4">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="lpa"  value="lpa"/>
                  <input class="form__input lpa-field" type="date" placeholder="Date collected" name="lpa-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input lpa-field" type="text" placeholder="Name of laboratory" name="lpa-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                 
          
                  <label class="form__label" for="">Result</label>
                  <label class="form__sublabel">MTB Detected, Fluoroquinolone Resistance Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, Fluoroquinolone Resistance Detected" />
                    <span class="form__checkmark"></span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Fluoroquinolone Resistance Not Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, Fluoroquinolone Resistance Not Detected" />
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Fluoroquinolone Resistance Indeterminate
                    <input class="form__trigger lpa-field" type="checkbox"  name="lpa-0-result[]" value="MTB Detected, Fluoroquinolone Resistance Indeterminate"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Second-line Injectable Resistance Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, Second-line Injectable Resistance Detected" />
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Second-line Injectable Resistance Indeterminate
                    <input class="form__trigger lpa-field" type="checkbox"  name="lpa-0-result[]"  value="MTB Detected, Second-line Injectable Resistance Indeterminate"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, High Dose Isoniazid Resistance Detected
                    <input class="form__trigger lpa-field" type="checkbox"  name="lpa-0-result[]" value="MTB Detected, High Dose Isoniazid Resistance Detected"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, High Dose Isoniazid Resistance Not Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, High Dose Isoniazid Resistance Not Detected"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, High Dose Isoniazid Resistance Indeterminate
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, High Dose Isoniazid Resistance Indeterminate"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Low Dose Isoniazid Resistance Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]"  value="MTB Detected, Low Dose Isoniazid Resistance Detected"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Low Dose Isoniazid Resistance Not Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, Low Dose Isoniazid Resistance Not Detected"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Detected, Low Dose Isoniazid Resistance Indeterminate
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Detected, Low Dose Isoniazid Resistance Indeterminate"/>
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >MTB Not Detected
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="MTB Not Detected" />
                    <span class="form__checkmark"> </span>
                  </label>
                  <label class="form__sublabel" >Invalid
                    <input class="form__trigger lpa-field" type="checkbox" name="lpa-0-result[]" value="Invalid" />
                    <span class="form__checkmark"> </span>
                  </label>
                  <div class="help-block with-errors"></div>
                </div>
                <img class="image image--close image--relative js-delete-section4" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section4" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll5">Smear Microscop 
            <input class="form__trigger bacteriological-check" data-type="smear_mic" id="js-toggle-enroll5" type="checkbox" />
            <span class="form__checkmark"> </span></label>
          <div class="form__trigger-content" id="js-toggle-content-enroll5">
            <div id="js-section5">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="smear_mic"  value="smear_mic"/>
                  <input class="form__input smear_mic-field" type="date" placeholder="Date collected" name="smear_mic-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input smear_mic-field" type="text" placeholder="Name of laboratory" name="smear_mic-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select" name="smear_mic-result[]">
                    <option>0</option>
                    <option>+n</option>
                    <option>1+</option>
                    <option>2+</option>
                    <option>3+</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section5" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section5" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll6">TB Loop-Mediated Isothermal Amplification (TB-LAMP)
            <input class="form__trigger bacteriological-check" data-type="tb_lamp" id="js-toggle-enroll6" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll6">
            <div id="js-section6">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="tb_lamp"  value="tb_lamp"/>
                  <input class="form__input tb_lamp-field" type="date" placeholder="Date collected" name="tb_lamp-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input tb_lamp-field" type="text" placeholder="Name of laboratory" name="tb_lamp-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select" name="tb_lamp-result[]">
                    <option>Positive</option>
                    <option>Negative</option>
                    <option>Indeterminate</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section6" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section6" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll8">TB Culture
            <input class="form__trigger bacteriological-check" data-type="tb_culture" id="js-toggle-enroll8" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll8">
            <div id="js-section8">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="tb_culture"  value="tb_culture"/>
                  <input class="form__input tb_culture-field" type="date" placeholder="Date collected" name="tb_culture-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input tb_culture-field" type="text" placeholder="Name of laboratory" name="tb_culture-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content">
                  <select class="form__input form__input--select" name="tb_culture-result[]">
                    <option>Positive</option>
                    <option>Negative</option>
                    <option>Non-tuberculous Mycobacteria (NTM)</option>
                    <option>Contaminated</option>
                  </select>
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                </div>
                <img class="image image--close image--relative js-delete-section8" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section8" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll9">Drug Susceptibility Test (DST)
            <input class="form__trigger bacteriological-check" data-type="dst" id="js-toggle-enroll9" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll9">
            <div id="js-section9">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="dst"  value="dst"/>
                  <input class="form__input dst-field" type="date" placeholder="Date collected" name="dst-date_collected[]" />
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input dst-field" type="text" placeholder="Name of laboratory" name="dst-name_of_laboratory[]" />
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <select class="form__input form__input--select dst_option" name="dst-result[]">
                    <option>H-Susceptible</option>
                    <option>H-Resistance</option>
                    <option>H-Not Done</option>
                    <option>R-Susceptible</option>
                    <option>R-Resistance</option>
                    <option>E-Susceptible</option>
                    <option>E-Resistant</option>
                    <option>E-Not Done</option>
                    <option>Z-Susceptible</option>
                    <option>Z-Resistant</option>
                    <option>Z-Not done</option>
                    <option>Mfx-Susceptible</option>
                    <option>Mfx-Resistant</option>
                    <option>Mfx-Not done</option>
                    <option>Lfx-Susceptible</option>
                    <option>Lfx-Resistant</option>
                    <option>Lfx-Not done</option>
                    <option>S-Susceptible</option>
                    <option>S-Resistant</option>
                    <option>S-Not Done</option>
                    <option>Am-Susceptible</option>
                    <option>Am-Resistant</option>
                    <option>Am-Not Done</option>
                    <option>Other (please specify)</option>
                  </select>
                 
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Result</label>
                  <div class="help-block with-errors"></div>
                </div>
                <img class="image image--close image--relative js-delete-section9" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section9" type="button">Add one more</button>
          </div>
        </li>
        <li class="form__group-item">
          <label class="form__sublabel" id="enroll10">Others
            <input class="form__trigger bacteriological-check" data-type="others" id="js-toggle-enroll10" type="checkbox" />
            <span class="form__checkmark"> </span>
          </label>
          <div class="form__trigger-content" id="js-toggle-content-enroll10">
            <div id="js-section10">
              <div class="js-section-others form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="others"  value="others"/>
                  <input class="form__input others-field" type="text" placeholder="Please specify" name="others-specify[]" />
                  <label class="form__label" for="">Please specify</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="grid grid--three grid--close">
                  <div class="form__content form-group">
                    <input class="form__input others-field" type="date" placeholder="Date done" name="others-date_collected[]"/>
                    <label class="form__label" for="">Date done</label>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form__content form-group">
                    <input class="form__input others-field" type="text" placeholder="Name of laboratory" name="others-name_of_laboratory[]"/>
                    <label class="form__label" for="">Name of laboratory</label>
                    <div class="help-block with-errors"></div>
                  </div>
                  <div class="form__content form-group">
                    <input class="form__input others-field" type="text" placeholder="Result" name="others-result[]"/>
                    <label class="form__label" for="">Result</label>
                    <div class="help-block with-errors"></div>
                  </div>
                  <img class="image image--close image--relative js-delete-section10" src="{{ asset('assets/app/img/icon-close.png') }}" />
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
          <label class="form__sublabel" id="enroll11">Drug Susceptibility Test (DST)
            <input class="form__trigger bacteriological-check" data-type="dst_from_other_lab" id="js-toggle-enroll11" type="checkbox" />
            <span class="form__checkmark"> </span></label>
          <div class="form__trigger-content" id="js-toggle-content-enroll11">
            <div id="js-section11">
              <div class="grid grid--three grid--close form-step-2">
                <div class="form__content form-group">
                  <input type="hidden" class="dst_from_other_lab"  value="dst_from_other_lab"/>
                  <input class="form__input dst_from_other_lab-field" type="date" placeholder="Date collected" name="dst_from_other_lab-date_collected[]"/>
                  <label class="form__label" for="">Date collected</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input dst_from_other_lab-field" type="text" placeholder="Name of laboratory" name="dst_from_other_lab-name_of_laboratory[]"/>
                  <label class="form__label" for="">Name of laboratory</label>
                  <div class="help-block with-errors"></div>
                </div>
                <div class="form__content form-group">
                  <input class="form__input dst_from_other_lab-field" type="text" placeholder="Result" name="dst_from_other_lab-result[]"/>
                  <label class="form__label" for="">Result</label>
                  <div class="help-block with-errors"></div>
                </div>
                <img class="image image--close image--relative js-delete-section11" src="{{ asset('assets/app/img/icon-close.png') }}" />
              </div>
            </div>
            <button class="button button--transparent" id="js-add-section11" type="button">Add one more</button>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-2">
    <a class="button button--back">Back</a>
    <a class="button button--next">Next</a>
  </div>
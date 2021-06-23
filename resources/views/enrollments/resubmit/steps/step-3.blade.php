<div class="form__tab step-3">
    <div class="form__container form-step-3">
      <h2 class="section__heading">Case information 2</h2>
      <div class="grid form-step-3">
        <div class="form__content ">
          <input type="hidden" id="drug_susceptibility" value="{{ $tbMacForm->enrollmentForm->drug_susceptibility }}">
          <select class="form__input form__input--select" name="drug_susceptibility" id="drug_susceptibility-select">
            <option>Drug-susceptible</option>
            <option>Bacteriologically-confirmed RR-TB</option>
            <option>Bacteriologically-confirmed MDR-TB</option>
            <option>Bacteriologically-confirmed Pre-XDR-TB</option>
            <option>Bacteriologically-confirmed XDR-TB</option>
            <option>Clinically-diagnosed MDR-TB</option>
            <option>Other Drug-resistant TB</option>
          </select>
          <div class="triangle triangle--down"></div>
          <label class="form__label" for="">Drug susceptibility</label>
        </div>
        <div class="form__content form__content--small form-group">
          <div class="help-block with-errors"></div>
            <input class="form__input" type="number" name="current_weight" value="{{ $tbMacForm->enrollmentForm->current_weight }}" placeholder="Current weight (kg)" required />
            <label class="form__label" for="">Current weight (kg)</label>
        </div>
      </div>
      <div class="form__content">
        <input type="hidden" id="suggested_regimen" value="{{ $tbMacForm->enrollmentForm->suggested_regimen }}">
        <select class="form__input form__input--select" id="suggested-regimen" name="suggested_regimen">
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
      <div class="form__content itr-drugs">
      <div class="help-block with-errors"></div>
        <input class="form__input" type="text" id="drugs_given" placeholder="Drugs given" />
        <label class="form__label" for="">Drugs given</label>
       
      </div>
      <div class="form__content  other-regimen">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="text" id="others_specify" placeholder="Other Specify" />
        <label class="form__label" for="">Other specify</label>
        
      </div>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <textarea class="form__input form__input--message" placeholder="" name="regimen_notes" required>{{ $tbMacForm->enrollmentForm->regimen_notes }}</textarea>
          <label class="form__label" for="">Regimen notes</label>
          
        </div>
    </div>
    <div class="form__container form-step-3 clinically-diagnosed">
      <h2 class="section__heading">If for treatment of clinically diagnosed cases</h2>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <textarea class="form__input form__input--message" name="clinical_status" placeholder="Clinical Status" >{{ $tbMacForm->enrollmentForm->clinical_status }}</textarea>
          <label class="form__label" for="">Clinical status</label>
          
        </div>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <input class="form__input" type="text" name="signs_and_symptoms" placeholder="Signs and symptoms"  value="{{ $tbMacForm->enrollmentForm->signs_and_symptoms }}" />
          <label class="form__label" for="">Signs and symptoms</label>
          
        </div>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <input class="form__input" type="text" name="vital_signs" placeholder="Vital signs"  value="{{ $tbMacForm->enrollmentForm->vital_signs }}"/>
          <label class="form__label" for="">Vital signs</label>
          
        </div>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <input class="form__input" type="text" name="diag_and_lab_findings" placeholder="Pertinent diagnostic and laboratory findings"  value="{{ $tbMacForm->enrollmentForm->diag_and_lab_findings }}"/>
          <label class="form__label" for="">Pertinent diagnostic and laboratory findings</label>
          
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-3">
    <button class="button button--back" type="button">Back</button>
    <button class="button button--next" type="button">Next</button>
  </div>
<div class="form__tab step-3">
    <div class="form__container form-step-3">
      <h2 class="section__heading">Case information 2</h2>
      <div class="grid">
        <div class="form__content form-group">
          <select class="form__input form__input--select" name="drug_susceptibility">
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
        <div class="form__content form__content--small form-group">
            <input class="form__input" type="number" name="current_weight" value="70" placeholder="Current weight (kg)" required />
            <label class="form__label" for="">Current weight (kg)</label>
            <div class="help-block with-errors"></div>
        </div>
      </div>
      <div class="form__content">
        <select class="form__input form__input--select" name="suggested_regimen">
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
      <div class="form__content form-group">
          <textarea class="form__input form__input--message" placeholder="" name="regimen_notes" required>Good Regimen</textarea>
          <label class="form__label" for="">Regimen notes</label>
          <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="form__container form-step-3">
      <h2 class="section__heading">If for treatment of clinically diagnosed cases</h2>
      <div class="form__content form-group">
          <textarea class="form__input form__input--message" name="clinical_status" placeholder="Clinical Status" required>Clinically Good</textarea>
          <label class="form__label" for="">Clinical status</label>
          <div class="help-block with-errors"></div>
        </div>
      <div class="form__content form-group">
          <input class="form__input" type="text" name="signs_and_symptoms" value="Asymptomatic" placeholder="Signs and symptoms" required />
          <label class="form__label" for="">Signs and symptoms</label>
          <div class="help-block with-errors"></div>
        </div>
      <div class="form__content form-group">
          <input class="form__input" type="text" name="vital_signs" value="Yes vital signs" placeholder="Vital signs" required />
          <label class="form__label" for="">Vital signs</label>
          <div class="help-block with-errors"></div>
        </div>
      <div class="form__content form-group">
          <input class="form__input" type="text" name="diag_and_lab_findings" value="no laboratory findings" placeholder="Pertinent diagnostic and laboratory findings" required />
          <label class="form__label" for="">Pertinent diagnostic and laboratory findings</label>
          <div class="help-block with-errors"></div>
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-3">
    <a class="button button--back">Back</a>
    <a class="button button--next">Next</a>
  </div>
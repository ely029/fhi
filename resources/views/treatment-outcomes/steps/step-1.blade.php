<div class="form__tab step-1">
    <h2 class="section__heading">Patient Information</h2>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="tb-case-number" type="number" min="0" required placeholder="TB Case number" name="tb_case_number"/>
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">TB case number</label>
        </div>
      <div class="form__content form-group">
          <input class="form__input" id="last-name" type="text" placeholder="Last name" name="last_name" required />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Last name</label>
        </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="facilityCode" disabled type="number" min="0" placeholder="Facility code" name="facility_code" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Health facility</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="province" disabled name="province">
          @foreach ($provinces as $province)
            <option value="{{ $province }}">{{ $province }}</option>
          @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Province</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="birthday" type="date" disabled placeholder="Birthday" name="birthday" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Birthday</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="gender" disabled name="gender">
        <option>Male</option>
        <option>Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Sex</label>
      </div>
    </div>
    <div class="grid grid--two form-step-1">
        <div class="form__content form-group">
            <input class="form__input" id="date_started_treatment" type="date" disabled placeholder="Date started treatment" name="date_started_treatment" />
            <div class="help-block with-errors"></div>
            <label class="form__label" for="">Date started treatment</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="drugSusceptibility" disabled name="current_drug_susceptibility">
            <option value="Drug-susceptible">Drug-susceptible</option>
            <option value="Bacteriologically-confirmed RR-TB">Bacteriologically-confirmed RR-TB</option>
            <option value="Bacteriologically-confirmed MDR-TB">Bacteriologically-confirmed MDR-TB</option>
            <option value="Bacteriologically-confirmed Pre-XDR-TB">Bacteriologically-confirmed Pre-XDR-TB</option>
            <option value="Bacteriologically-confirmed XDR-TB">Bacteriologically-confirmed XDR-TB</option>
            <option value="Clinically-confirmed MDR-TB">Clinically-confirmed MDR-TB</option>
            <option value="Other Drug-resistant TB">Other Drug-resistant TB</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Current drug susceptibility</label>
      </div>
     
    </div>
  </div>
  <input type="hidden" id="is_from_itis" value="0">
  <div class="form__button form__button--space form__button--pagination step-1">
    <button class="button button--next step-1-next" type="button">Next</button>
  </div>
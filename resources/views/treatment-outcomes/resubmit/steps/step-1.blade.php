<div class="form__tab step-1">
    <h2 class="section__heading">Patient Information</h2>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="tb-case-number" type="number" min="0" required placeholder="TB Case number" name="tb_case_number" value="{{ empty($tbMacForm->treatmentOutcomeForm->tb_case_number) ? '' : $tbMacForm->treatmentOutcomeForm->tb_case_number }}"/>
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">TB case number</label>
        </div>
      <div class="form__content form-group">
          <input class="form__input" id="last-name" type="text" placeholder="Last name" name="last_name" required value="{{ $tbMacForm->patient->last_name }}" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Last name</label>
        </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="facilityCode" disabled type="number" min="0" placeholder="Facility code" name="facility_code" value="{{ $tbMacForm->patient->facility_code }}" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Health facility</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="province" disabled name="province">
            @foreach ($provinces as $province)
                <option value="{{ $province }}" {{ $tbMacForm->patient->province == $province ? 'selected' : '' }}>{{ $province}}</option>
            @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Province</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
          <input class="form__input" id="birthday" type="date" disabled placeholder="Birthday" name="birthday" value="{{  $tbMacForm->patient->birthday->format('Y-m-d') }}" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">Birthday</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="gender" disabled name="gender">
        <option value="Male" {{ $tbMacForm->patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
        <option value="Female" {{ $tbMacForm->patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Sex</label>
      </div>
    </div>
    <div class="grid grid--two form-step-1">
        <div class="form__content form-group">
            <input class="form__input" id="date_started_treatment" type="date" disabled placeholder="Date started treatment" name="date_started_treatment" value="{{ empty($tbMacForm->treatmentOutcomeForm->date_started_treatment) ? '' : $tbMacForm->treatmentOutcomeForm->date_started_treatment->format('Y-m-d') }}" />
            <div class="help-block with-errors"></div>
            <label class="form__label" for="">Date started treatment</label>
        </div>
      <div class="form__content form-group">
        <select class="form__input form__input--select" id="drugSusceptibility" disabled name="current_drug_susceptibility">
            @foreach(current_drug_susceptibility() as $drugs)
            <option value="{{ $drugs }}" {{ $tbMacForm->treatmentOutcomeForm->current_drug_susceptibility == $drugs ? 'selected' : '' }}>{{ $drugs }}</option>
            @endforeach
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
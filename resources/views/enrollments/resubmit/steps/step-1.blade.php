<div class="form__tab step-1">
    <h2 class="section__heading">Patient information</h2>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
        <input class="form__input" type="number" min="0" placeholder="Facility code" name="facility_code" required value="{{ $tbMacForm->patient->facility_code }}"/>
        <label class="form__label" for="">Health facility code</label>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form__content">
        <select class="form__input form__input--select" name="province">
          @foreach ($provinces as $province)
            <option value="{{ $province }}" {{ $tbMacForm->patient->province == $province ? 'selected' : '' }}>{{ $province}}</option>
          @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Province</label>
      </div>
    </div>
    <div class="grid grid--three grid--close form-step-1">
        <div class="form__content form-group">
          <input class="form__input" type="text" placeholder="First name" name="first_name" required value="{{ $tbMacForm->patient->first_name }}" />
          <label class="form__label" for="">First name</label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form__content form-group">
          <input class="form__input" type="text" placeholder="Last name" name="last_name" value="{{ $tbMacForm->patient->last_name }}" required/>
          <label class="form__label" for="">Last name</label>
          <div class="help-block with-errors"></div>
        </div>
        <div class="form__content form-group">
            <input class="form__input" type="text" placeholder="Middle name" name="middle_name" value="{{ $tbMacForm->patient->middle_name }}" required/>
            <label class="form__label" for="">Middle name</label>
            <div class="help-block with-errors"></div>
        </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
        <input class="form__input" type="date" placeholder="Birthday" name="birthday" value="{{ $tbMacForm->patient->birthday->format('Y-m-d') }}" required/>
        <label class="form__label" for="">Birthday</label>
        <div class="help-block with-errors"></div>
      </div>
      <div class="form__content">
        <select class="form__input form__input--select" name="gender">
          <option value="Male" {{ $tbMacForm->patient->gender == 'Male' ? 'selected' : '' }}>Male</option>
          <option value="Female" {{ $tbMacForm->patient->gender == 'Female' ? 'selected' : '' }}>Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Sex</label>
      </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-1">
    <button class="button button--next" type="button">Next</button>
  </div>
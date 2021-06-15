<div class="form__tab step-1">
    <h2 class="section__heading">Patient information</h2>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="number" min="0" placeholder="Facility code" name="facility_code" required/>
        <label class="form__label" for="">Health facility code</label>
        
      </div>
      <div class="form__content">
        <select class="form__input form__input--select" name="province">
          @foreach ($provinces as $province)
            <option value="{{ $province }}">{{ $province }}</option>
          @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Province</label>
      </div>
    </div>
    <div class="grid grid--three grid--close form-step-1">
        <div class="form__content form-group">
          <div class="help-block with-errors"></div>
          <input class="form__input" type="text" placeholder="First name" name="first_name" required/>
          <label class="form__label" for="">First name</label>
          
        </div>
        <div class="form__content form-group">
          <div class="help-block with-errors"></div>
          <input class="form__input" type="text" placeholder="Last name" name="last_name" required/>
          <label class="form__label" for="">Last name</label>
          
        </div>
        <div class="form__content form-group">
          <div class="help-block with-errors"></div>
          <input class="form__input" type="text" placeholder="Middle name" name="middle_name" required/>
          <label class="form__label" for="">Middle name</label>
            
        </div>
    </div>
    <div class="grid grid--two form-step-1">
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="date" placeholder="Birthday" name="birthday" required/>
        <label class="form__label" for="">Birthday</label>
        
      </div>
      <div class="form__content">
        <select class="form__input form__input--select" name="gender">
          <option value="Male" data-property="M">Male</option>
          <option value="Female" data-property="F">Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Sex</label>
      </div>
    </div>
  </div>
  <input type="hidden" id="is_from_itis" value="0">
  <div class="form__button form__button--space form__button--pagination step-1">
    <button class="button button--next step-1-next" type="button">Next</button>
  </div>
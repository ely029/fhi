<div class="form__tab step-1">
    <h2 class="section__heading">Patient Information</h2>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="tbNumber" name="case_number" value="{{ empty($tbMacForm->caseManagementForm->case_number) ? '' : $tbMacForm->caseManagementForm->case_number }}" type="number" min="0" placeholder="TB Case number" required/><label class="form__label" for="">TB Case number</label></div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="lastName" name="last_name" value="{{ $tbMacForm->patient->last_name }}" type="text" placeholder="Last name" required /><label class="form__label" for="">Last name</label></div>
    </div>
    <div class="grid grid--two form-step-1">
    
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>    
    <input class="form__input" id="facilityCode" type="number" value="{{ $tbMacForm->patient->facility_code }}" min="0" placeholder="Facility code" name="facility_code" required/><label class="form__label" for="">Facility code</label></div>
    <div class="form__content form-group">
        <select class="form__input form__input--select " id="province" name="province">
        @foreach(provinces() as $province)
        <option value="{{ $province }}" {{ $tbMacForm->patient->province == $province ? 'selected' : '' }}>{{ $province}}</option>
        @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Province</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input " id="birthday" value="{{ $tbMacForm->patient->birthday->format('Y-m-d') }}" required name="birthday" type="date" placeholder="Birthday" /><label class="form__label" for="">Birthday</label></div>
    <div class="form__content">
        <select class="form__input form__input--select " id="gender" name="gender">
        <option {{ $tbMacForm->patient->gender === 'Male' ? 'selected' : ''}}>Male</option>
        <option {{ $tbMacForm->patient->gender === 'Female' ? 'selected' : ''}}>Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Gender</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content">
        <select class="form__input form__input--select" id="treatmentMonth" name="month_of_treatment">
        @foreach(month_treatment() as $month)
        <option value="{{ $month }}" {{ $tbMacForm->caseManagementForm->month_of_treatment == $month ? 'selected' : '' }}>{{ $month }}</option>
        @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Month of treatment</label>
    </div>
    <div class="form__content">
        <select class="form__input form__input--select" id="drugSusceptibility" name="current_drug_susceptibility">
        @foreach(current_drug_susceptibility() as $drugs)
        <option value="{{ $drugs }}" {{$tbMacForm->caseManagementForm->current_drug_susceptibility === $drugs ? 'selected': ''}}>{{ $drugs }}</option>
        @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Current drug susceptibility</label>
    </div>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--next" type="button">Next</button></div>
</div>

<div class="modal">
<div class="modal__background" data-dismiss="modal"></div>
<div class="modal__container">
    <div class="modal__box">
    <h2 class="modal__title">Finding match in database</h2>
    <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
    <div class="modal__button modal__button--center"><div class="modal__button"><div class="loader"></div></div></div>
    </div>
</div>
</div>
<div class="modal">
<div class="modal__background" data-dismiss="modal"></div>
<div class="modal__container">
    <div class="modal__box">
    <h2 class="modal__title">We did not find a match</h2>
    <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
    <div class="modal__button"><button class="button button--transparent " data-dismiss="modal">Cancel</button><input class="button" type="submit" value="Proceed manually" /></div>
    </div>
</div>
</div>
<div class="form__tab step-1">
    <h2 class="section__heading">Patient Information</h2>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="tbNumber" name="case_number" type="number" min="0" placeholder="TB Case number" required/><label class="form__label" for="">TB Case number</label></div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="lastName" name="last_name" type="text" placeholder="Last name" required /><label class="form__label" for="">Last name</label></div>
    </div>
    <div class="grid grid--two form-step-1">
    
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>    
    <input class="form__input" id="facilityCode" type="number" min="0" placeholder="Facility code" name="facility_code" required/><label class="form__label" for="">Health facility code</label></div>
    <div class="form__content form-group">
        <select class="form__input form__input--select " id="province" name="province">
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
    <div class="help-block with-errors"></div>
    <input class="form__input " id="birthday" required name="birthday" type="date" placeholder="Birthday" /><label class="form__label" for="">Birthday</label></div>
    <div class="form__content">
        <select class="form__input form__input--select " id="gender" name="gender">
        <option>Male</option>
        <option>Female</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Sex</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content">
        <select class="form__input form__input--select" id="treatmentMonth" name="month_of_treatment">
        <option value="0">0</option>
        <option value="1st">1st</option>
        <option value="2nd">2nd</option>
        <option value="3rd">3rd</option>
        <option value="4th">4th</option>
        <option value="5th">5th</option>
        <option value="6th">6th</option>
        <option value="7th">7th</option>
        <option value="8th">8th</option>
        <option value="9th">9th</option>
        <option value="10th">10th</option>
        <option value="11th">11th</option>
        <option value="12th">12th</option>
        <option value="13th">13th</option>
        <option value="14th">14th</option>
        <option value="15th">15th</option>
        <option value="16th">16th</option>
        <option value="17th">17th</option>
        <option value="18th">18th</option>
        <option value="19th">19th</option>
        <option value="20th">20th</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Month of treatment</label>
    </div>
    <div class="form__content">
        <select class="form__input form__input--select" id="drugSusceptibility" name="current_drug_susceptibility">
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
    <div class="modal__button"><button class="button button--transparent-close">Cancel</button><input class="button" type="submit" value="Proceed manually" /></div>
    </div>
</div>
</div>
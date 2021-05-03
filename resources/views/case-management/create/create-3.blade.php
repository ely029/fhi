<div class="form__tab step-3">
    <div class="form__container form-step-3">
    <h2 class="section__heading">Treatment information</h2>
    <div class="grid grid--two form-group">
        <div class="form__content">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="number" name="current_weight" placeholder="Current weight (kg)" required /><label class="form__label" for="">Current weight (kg)</label></div>
    </div>
    <div class="form__content form-group">
    <input class="form__input" type="text" required name="current_regiment" placeholder="Current Regiment" />
        <label class="form__label" for="">Current regimen</label>
    </div>
    <!-- <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea class="form__input form__input--message" name="reason_case_management_presentation"> 
    </textarea>
    <label class="form__label" for="">Reason for case management presentation</label>
        </div> -->
        <div class="form__content form-group">
            <div class="invalid-feedback">This field is required.</div>
            <textarea name="reason_case_management_presentation" class="form__input form__input--message" id="inputEmail" placeholder="" required></textarea>
            <label class="form__label" for="">Reason for case management presentation</label>
        </div>
    </div>
    <div class="form__container form-step-3">
    <h2 class="section__heading"></h2>
    <div class="form__content">
        <select class="form__input form__input--select" name="suggested_regimen">
        <option value="Regimen 3 SSOR">Regimen 3 SSOR</option>
        <option value="Regimen 4 SLOR FQ-S">Regimen 4 SLOR FQ-S</option>
        <option value="Regimen 5 SLOR FQ-R">Regimen 5 SLOR FQ-R</option>
        <option value="Regimen 6a SLOR FQ-S">Regimen 6a SLOR FQ-S</option>
        <option value="Regimen 6b SLOR FQ-S">Regimen 6b SLOR FQ-S</option>
        <option value="Regimen 6c SLOR FQ-S">Regimen 6c SLOR FQ-S</option>
        <option value="Regimen 7a SLOR FQ-R">Regimen 7a SLOR FQ-R</option>
        <option value="Regimen 7b SLOR FQ-R">Regimen 7b SLOR FQ-R</option>
        <option value="Regimen 7c SLOR FQ-R">Regimen 7c SLOR FQ-R</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Suggested regiment</label>
    </div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" name="itr_drugs" required type="text" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea required class="form__input form__input--message" name="suggested_regimen_notes"> </textarea>
    <label class="form__label" for="">Suggested regiment notes</label>
    </div>
    <div class="grid grid--two">
        <div class="form__content">
        <select class="form__input form__input--select" name="updated_type_of_case">
            <option value="Drug-susceptibility">Drug-susceptibility</option>
            <option value="Bacteriologically-confirmed RR-TB">Bacteriologically-confirmed RR-TB</option>
            <option value="Bacteriologically-confirmed MDR-TB">Bacteriologically-confirmed MDR-TB</option>
            <option value="Bacteriologically-confirmed Pre-XDR-TB">Bacteriologically-confirmed Pre-XDR-TB</option>
            <option value="Bacteriologically-confirmed XDR-TB">Bacteriologically-confirmed XDR-TB</option>
            <option value="Clinically-confirmed MDR-TB">Clinically-confirmed MDR-TB</option>
            <option value="Other Drug-resistant TB">Other Drug-resistant TB</option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Updated type of case (optional)</label>
        </div>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
    </div>
</div>

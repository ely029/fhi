<div class="form__tab step-1">
    <h2 class="section__heading">Patient Information</h2>
    <div class="grid grid--two form-step-1">
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="tbNumber" name="presentation_number" type="number" min="0" placeholder="TB Case number" required/><label class="form__label" for="">TB Case number</label></div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" id="lastName" name="last_name" type="text" placeholder="Last name" required /><label class="form__label" for="">Last name</label></div>
    </div>
    <div class="grid grid--two form-step-1">
    
    </div>
    <div class="grid grid--two form-step-1">
    <div class="help-block with-errors"></div>
    <div class="form__content form-group"><input class="form__input " required id="facilityCode" type="number" min="0" placeholder="Facility code" name="facility_code" /><label class="form__label" for="">Facility code</label></div>
    <div class="form__content form-group">
        <select class="form__input form__input--select " id="province" name="province">
        <option value="Metro Manila">Metro Manila</option>
        <option value="Abra">Abra</option>
        <option value="Agusan del Norte">Agusan del Norte</option>
        <option value="Agusan del Sur">Agusan del Sur</option>
        <option value="Aklan">Aklan</option>
        <option value="Albay">Albay</option>
        <option value="Antique">Antique</option>
        <option value="Apayao">Apayao</option>
        <option value="Aurora">Aurora</option>
        <option value="Basilan">Basilan</option>
        <option value="Bataan">Bataan</option>
        <option value="Batanes">Batanes</option>
        <option value="Batangas">Batangas</option>
        <option value="Biliran">Biliran</option>
        <option value="Benguet">Benguet</option>
        <option value="Bohol">Bohol</option>
        <option value="Bukidnon">Bukidnon</option>
        <option value="Bulacan">Bulacan</option>
        <option value="Cagayan">Cagayan</option>
        <option value="Camarines Norte">Camarines Norte</option>
        <option value="Camarines Sur">Camarines Sur</option>
        <option value="Camiguin">Camiguin</option>
        <option value="Capiz">Capiz</option>
        <option value="Catanduanes">Catanduanes</option>
        <option value="Cavite">Cavite</option>
        <option value="Cebu">Cebu</option>
        <option value="Compostela">Compostela</option>
        <option value="Davao del Norte">Davao del Norte</option>
        <option value="Davao del Sur">Davao del Sur</option>
        <option value="Davao Oriental">Davao Oriental</option>
        <option value="Eastern Samar">Eastern Samar</option>
        <option value="Guimaras">Guimaras</option>
        <option value="Ifugao">Ifugao</option>
        <option value="Ilocos Norte">Ilocos Norte</option>
        <option value="Ilocos Sur">Ilocos Sur</option>
        <option value="Iloilo">Iloilo</option>
        <option value="Isabela">Isabela</option>
        <option value="Kalinga">Kalinga</option>
        <option value="Laguna">Laguna</option>
        <option value="Lanao del Norte">Lanao del Norte</option>
        <option value="Lanao del Sur">Lanao del Sur</option>
        <option value="La Union">La Union</option>
        <option value="Leyte">Leyte</option>
        <option value="Maguindanao">Maguindanao</option>
        <option value="Marinduque">Marinduque</option>
        <option value="Masbate">Masbate</option>
        <option value="Mindoro Occidental">Mindoro Occidental</option>
        <option value="Mindoro Oriental">Mindoro Oriental</option>
        <option value="Misamis Occidental">Misamis Occidental</option>
        <option value="Misamis Oriental">Misamis Oriental</option>
        <option value="Mountain Province">Mountain Province</option>
        <option value="Negros Occidental">Negros Occidental</option>
        <option value="Negros Oriental">Negros Oriental</option>
        <option value="North Cotabato">North Cotabato</option>
        <option value="Northern Samar">Northern Samar</option>
        <option value="Nueva Ecija">Nueva Ecija</option>
        <option value="Nueva Vizcaya">Nueva Vizcaya</option>
        <option value="Palawan">Palawan</option>
        <option value="Pampanga">Pampanga</option>
        <option value="Pangasinan">Pangasinan</option>
        <option value="Quezon">Quezon</option>
        <option value="Quirino">Quirino</option>
        <option value="Rizal">Rizal</option>
        <option value="Romblon">Romblon</option>
        <option value="Samar">Samar</option>
        <option value="Sarangani">Sarangani</option>
        <option value="Siquijor">Siquijor</option>
        <option value="Sorsogon">Sorsogon</option>
        <option value="South Cotabato">South Cotabato</option>
        <option value="Southern Leyte">Southern Leyte</option>
        <option value="Sultan Kudarat">Sultan Kudarat</option>
        <option value="Sulu">Sulu</option>
        <option value="Surigao del Norte">Surigao del Norte</option>
        <option value="Surigao del Sur">Surigao del Sur</option>
        <option value="Tarlac">Tarlac</option>
        <option value="Tawi-Tawi">Tawi-Tawi</option>
        <option value="Zambales">Zambales</option>
        <option value="Zamboanga del Norte">Zamboanga del Norte</option>
        <option value="Zamboanga del Sur">Zamboanga del Sur</option>
        <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
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
        <label class="form__label" for="">Gender</label>
    </div>
    </div>
    <div class="grid grid--two form-step-1">
    <div class="form__content">
        <select class="form__input form__input--select" id="treatmentMonth" name="month_of_treatment">
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
        <option value="Drug-susceptible (for enrollment note)">Drug-susceptible</option>
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

<div class="modal js-modal">
<div class="modal__background js-modal-background"></div>
<div class="modal__container">
    <div class="modal__box">
    <h2 class="modal__title">Finding match in database</h2>
    <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
    <div class="modal__button modal__button--center"><img class="modal__loader" src="src/img/loader.gif" alt="Loader animated" /></div>
    </div>
</div>
</div>
<div class="modal js-modal">
<div class="modal__background js-modal-background"></div>
<div class="modal__container">
    <div class="modal__box">
    <h2 class="modal__title">We did not find a match</h2>
    <p class="modal__text">Please make sure First name, Last name, Middle name, Birthday, and Gender are correct.</p>
    <div class="modal__button"><button class="button button--transparent js-modal-close">Cancel</button><input class="button" type="submit" value="Proceed manually" /></div>
    </div>
</div>
</div>
<div class="form__tab step-3">
    <div class="form__container form-step-3">
    <h2 class="section__heading">Treatment information</h2>
    <div class="grid grid--two form-group">
        <div class="form__content">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="number" name="current_weight" value="{{ $tbMacForm->caseManagementForm->current_weight }}" placeholder="Current weight (kg)" required /><label class="form__label" for="">Current weight (kg)</label></div>
    </div>
    <div class="form__content form-group">
    <input class="form__input" type="text" value="{{ empty($tbMacForm->caseManagementForm->current_regiment) ? '' : $tbMacForm->caseManagementForm->current_regiment }}" required name="current_regimen" placeholder="Current Regiment" />
        <label class="form__label" for="">Current regimen</label>
    </div>
    <!-- <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea class="form__input form__input--message" name="reason_case_management_presentation"> 
    </textarea>
    <label class="form__label" for="">Reason for case management presentation</label>
        </div> -->
        <div class="form-group">
            <label class="form__label" for="">Reason for case management presentation</label>
            <textarea name="reason_case_management_presentation" class="form-control form__input" id="inputEmail" placeholder="" required>{{ $tbMacForm->caseManagementForm->reason_case_management_presentation }}</textarea>
            <div class="invalid-feedback">This field is required.</div>
        </div>
    </div>
    <div class="form__container form-step-3">
    <h2 class="section__heading"></h2>
    <div class="form__content">
        <select class="form__input form__input--select" name="suggested_regimen">
        @foreach(suggested_regimen() as $sr)
        <option value="{{ $sr }}" {{$tbMacForm->caseManagementForm->suggested_regimen === $sr ? 'selected' : ''}}>{{ $sr }}</option>
        @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Suggested regiment</label>
    </div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" name="itr_drugs" value="{{$tbMacForm->caseManagementForm->itr_drugs}}" required type="text" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div>
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea required class="form__input form__input--message" name="suggested_regimen_notes">{{ $tbMacForm->caseManagementForm->suggested_regimen_notes }}</textarea>
    <label class="form__label" for="">Suggested regiment notes</label>
    </div>
    <div class="grid grid--two">
        <div class="form__content">
        <select class="form__input form__input--select" name="updated_type_of_case">
            @foreach(updated_type_of_case() as $case)
            <option value="{{ $case }}" {{$tbMacForm->caseManagementForm->updated_type_of_case === $case ? 'selected' : ''}}>{{ $case }}</option>
            @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Updated type of case (optional)</label>
        </div>
    </div>
    </div>
</div>

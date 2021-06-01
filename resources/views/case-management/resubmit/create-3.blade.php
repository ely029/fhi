<div class="form__tab step-3">
    <div class="form__container form-step-3">
    <h2 class="section__heading">Treatment information</h2>
    <div class="grid">
        <div class="form__content form-group">
       
        <input class="form__input" type="number" name="current_weight" value="{{ $tbMacForm->caseManagementForm->current_weight }}" placeholder="Current weight (kg)" required />
        <label class="form__label" for="">Current weight (kg)</label>
        <div class="help-block with-errors"></div>
    </div>
    </div>
    <div class="form__content">
        <select class="form__input form__input--select" id="current_regiment" name="current_regiment">
        @foreach(current_regimen() as $sr)
    <option value="{{ $sr }}" {{ $tbMacForm->caseManagementForm->current_regiment === $sr ? 'selected' : ''}}>{{ $sr }}</option>
    @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Current Regimen</label>
    </div>
    <div class="form__content" id="others_current_regiment">
        <input class="form__input" name="others_current_regimen" type="text" placeholder="Others (Please specify)" value="{{ $tbMacForm->caseManagementForm->others_current_regimen }}"/><label class="form__label" for="">Others</label>
    </div>
    <div class="form__content" id="itr_drugs_current_regiment">
        <input class="form__input" name="itr_drugs_current_regimen" type="text" value="{{ $tbMacForm->caseManagementForm->itr_drugs_current_regimen }}" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div>
    <!-- <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea class="form__input form__input--message" name="reason_case_management_presentation"> 
    </textarea>
    <label class="form__label" for="">Reason for case management presentation</label>
        </div> -->
        <div class="form__content form-group">
    {{-- @if ($tbMacForm->caseManagementForm->current_regiment == 'Other (Specify)')
    <div class="form__content" id="others_current_regiment">
        <input class="form__input" name="others_current_regimen" type="text" placeholder="Others (Please specify)" value="{{ $tbMacForm->caseManagementForm->others_current_regimen }}"/><label class="form__label" for="">Others</label>
    </div>
    @endif
    @if ($tbMacForm->caseManagementForm->suggested_regimen == 'ITR')
    <div class="form__content" id="itr_drugs_current_regiment">
        <input class="form__input" name="itr_drugs_current_regimen" type="text" value="{{ $tbMacForm->caseManagementForm->itr_drugs_current_regimen }}" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div>
    @endif --}}
            <textarea name="reason_case_management_presentation" class="form-control form__input" id="inputEmail" placeholder="" required>{{ $tbMacForm->caseManagementForm->reason_case_management_presentation }}</textarea>
            
            <div class="help-block with-errors"></div>
            <label class="form__label" for="">Reason for case management presentation</label>
        </div>
    </div>
    <div class="form__container form-step-3">
    <h2 class="section__heading"></h2>
    <div class="form__content">
        <select class="form__input form__input--select" id="suggested_regimen" name="suggested_regimen">
        @foreach(suggested_regimen() as $sr)
        <option value="{{ $sr }}" {{$tbMacForm->caseManagementForm->suggested_regimen === $sr ? 'selected' : ''}}>{{ $sr }}</option>
        @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Suggested regimen</label>
    </div>
    {{-- @if ($tbMacForm->caseManagementForm->suggested_regimen == 'Other (Specify)') --}}
    <div class="form__content" id="others_1">
        <input class="form__input" name="others_case_management" type="text" placeholder="Others (Please specify)" value="{{ $tbMacForm->caseManagementForm->others }}"/><label class="form__label" for="">Others</label>
    </div>
    {{-- @endif --}}
    {{-- @if ($tbMacForm->caseManagementForm->suggested_regimen == 'ITR') --}}
    <div class="form__content" id="itr_drugs_1">
        <input class="form__input" name="itr_drugs" type="text" value="{{ $tbMacForm->caseManagementForm->itr_drugs }}" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div>
    {{-- @endif --}}
    {{-- <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <input class="form__input" name="itr_drugs" value="{{$tbMacForm->caseManagementForm->itr_drugs}}" required type="text" placeholder="Please specify (+ITR is chosen)"/><label class="form__label" for="">ITR drugs</label>
    </div> --}}
    <div class="form__content form-group">
    <div class="help-block with-errors"></div>
    <textarea required class="form__input form__input--message" name="suggested_regimen_notes">{{ $tbMacForm->caseManagementForm->suggested_regimen_notes }}</textarea>
    <label class="form__label" for="">Suggested regimen notes</label>
    </div>
    <div class="grid grid--two">
        <div class="form__content">
        <select class="form__input form__input--select" name="updated_type_of_case">
            @foreach(updated_type_of_case() as $case)
            <option value="{{ $case }}" {{$tbMacForm->caseManagementForm->updated_type_of_case === $case ? 'selected' : ''}}>{{ $case }}</option>
            @endforeach
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Updated drug susceptilibity</label>
        </div>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button></div>
</div>
</div>

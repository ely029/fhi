<div class="form__tab step-4">
    <div class="form__container form-step-4">
    <h2 class="section__heading">Laboratory results and information</h2>
    <div class="form__container">
        <div class="grid">
        <div class="form__content form-group form__content--small form__content--small__right">
        <div class="help-block with-errors"></div>
        <input class="form__input" required name="cxr_date" type="date" value="{{ $tbMacForm->caseManagementLaboratoryResult->cxr_date->format('Y-m-d')}}" placeholder="CXR date" /><label class="form__label" for="">CXR date</label></div>
        <div class="form__content">
            <select class="form__input form__input--select" name="latest_comparative_cxr_reading">
            @foreach(latest_comparative_cxr_reading() as $reading)
            <option value="{{ $reading }}" {{$tbMacForm->caseManagementForm->latest_comparative_cxr_reading === $reading ? 'selected' : ''}}>{{ $reading }}</option>
            @endforeach
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Latest comparative CXR Reading</label>
        </div>
        </div>
    </div>
    <div class="form__container form-step-4">
        <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input name="cxr_result" value="{{ $tbMacForm->caseManagementLaboratoryResult->cxr_result}}" class="form__input" type="text" required placeholder="CXR result" />
        <span class="error"></span>
        <label class="form__label" for="">CXR result</label></div>
    </div>
    <div class="form__container form-step-4">
        <div class="grid">
        <div class="help-block with-errors"></div>
        <div class="form__content form-group form__content--small form__content--small__right">
        <input class="form__input" value="{{ $tbMacForm->caseManagementLaboratoryResult->ct_scan_date->format('Y-m-d')}}" type="date" required name="ct_scan_date" placeholder="CT scan date" /><label class="form__label" for="">CT scan date</label></div>
        <span class="error"></span>
        <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input class="form__input" name="ct_scan_result" required type="text" placeholder="CT scan result" value="{{ $tbMacForm->caseManagementLaboratoryResult->ct_scan_result}}" /><label class="form__label" for="">CT scan result</label></div>
        <span class="error"></span>
        </div>
    </div>
    <div class="form__container form-step-4">
        <div class="grid">
        <div class="form__content form-group form__content--small form__content--small__right">
        <div class="help-block with-errors"></div>
        <input name="ultra_sound_date" required class="form__input" name="ultra_sound_date" type="date" placeholder="Ultrasound date" value="{{ $tbMacForm->caseManagementLaboratoryResult->ultra_sound_date->format('Y-m-d')}}"/><label class="form__label" for="">Ultrasound date</label></div>
        <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input class="form__input" type="text" required name="ultra_sound_result" placeholder="Ultrasound result" value="{{ $tbMacForm->caseManagementLaboratoryResult->ultra_sound_result}}"/><label class="form__label" for="">Ultrasound result</label></div>
        </div>
    </div>
    <div class="form__container form-step-4">
        <div class="grid">
        <div class="form__content form-group form__content--small form__content--small__right">
        <div class="help-block with-errors"></div>
            <input class="form__input" type="date" required name="histhopathological_date" placeholder="Histopathological date" value="{{ $tbMacForm->caseManagementLaboratoryResult->histhopathological_date->format('Y-m-d')}}"/><label class="form__label" for="">Histopathological date</label>
        </div>
        <div class="form__content form-group">
        <div class="help-block with-errors"></div>
        <input name="histhopathological_result" required class="form__input" type="text" placeholder="Histopathological result" value="{{ $tbMacForm->caseManagementLaboratoryResult->histhopathological_result}}"/><label class="form__label" for="">Histopathological result</label></div>
        </div>
    </div>
    </div>
    <div class="form__container">
    <h2 class="section__heading">Related Media (CXR, CTSCAN etc.)</h2>
    <div class="form__warning">
        <img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" />
        <p>Please make sure patient name is NOT included in your photo uploads</p>
    </div>
    <div class="grid grid--two">
        <!-- <div class="dz-default dz-message dropzoneDragArea" id="dropzoneDragArea">
        <div class="gallery">
            <div class="gallery__container">
            <div class="gallery__icon"><img class="image" src="src/img/icon-upload.png" alt="Upload icon" /></div>
            <input class="gallery__trigger" type="file" /><span class="gallery__text"></span>
            <span class="gallery__text gallery__text--gray">
                Recommendation: <br />
                .jpg .png files less than 10mb
            </span>
            </div>
        </div>
        </div> -->
        <div class="dz-default dz-message dropzoneDragArea" id="dropzoneDragArea">
          <div class="gallery">
            <div class="gallery__container">
              <input class="gallery__trigger" type="file">
              <div class="gallery__icon">
                <img class="image" src="{{ asset('assets/app/img/icon-upload.png') }}" alt="Upload icon" /></div>
              <span class="gallery__text">Drag and drop or click to upload</span>
              <span class="gallery__text gallery__text--gray">
                Recommendation: <br />
                .jpg .png files less than 10mb
              </span>
            </div>
          </div>
        </div>
        <input type="file" multiple name="attachments[]" class="attachment-upload" id="attachments">
        <ul class="gallery__list" id="gallery-preview">
        <li class="gallery__item dz-preview dz-file-preview" id="gallery-container"><img class="image image--gallery" data-dz-thumbnail /><img class="image image--close" src="{{ asset('assets/app/img/icon-close.png') }}" data-dz-remove /></li>
        </ul>
    </div>
    </div>
    <div class="form__container form-step-4">
    <div class="help-block with-errors"></div>
    <h2 class="section__heading">Remarks</h2>
    <div class="form__content form-group">
    <textarea class="form__input form__input--message" required name="remarks" placeholder="Remarks">{{ $tbMacForm->caseManagementForm->remarks}}</textarea><label class="form__label" for="">Remarks</label></div>
    </div>
    <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="submit">Submit</button></div>
</div>
</div>
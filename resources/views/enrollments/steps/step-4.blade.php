<div class="form__tab step-4">
    <div class="form__container">
      <h2 class="section__heading">Laboratory results and information</h2>
      <div class="grid">
        <div class="form__content form-groupform__content--small form__content--small__right">
          <input class="form__input" type="date" name="cxr_date" placeholder="CXR date" />
          <label class="form__label" for="">CXR date</label>
        </div>
        <div class="form__content">
          <input class="form__input" name="cxr_result" type="text" placeholder="CXR result" />
          <label class="form__label" for="">CXR result</label>
        </div>
      </div>
      <div class="grid grid--three grid--close">
        <div class="grid__item">
          <label class="form__sublabel">Normal
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Normal" />
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Cavitary
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Cavitary" />
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Infilitrates
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Infilitrates" />
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Nodule
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Nodule" />
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Miliary TB
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Miliary TB"/>
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Intrathoracic Lymphadenopathy
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Intrathoracic Lymphadenopathy" />
            <span class="form__checkmark"> </span>
          </label>
        </div>
        <div class="grid__item form-step-4">
          <label class="form__sublabel">Endobronchial Spread
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Endobronchial Spread"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Fibrosis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Fibrosis"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Bullae
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Bullae" />
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Pleural Effusion
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Pleural Effusion"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Fibrothorax
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Fibrothorax" />
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Pneumothorax
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Pneumothorax"/>
            <span class="form__checkmark"> </span>
          </label>
        </div>
        <div class="grid__item">
          <label class="form__sublabel">Bronchiectasis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Bronchiectasis"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Atelectasis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Atelectasis"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Consolidation
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Consolidation"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Mass
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Mass"/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Other
            <input class="form__trigger other-cxr" type="checkbox" name="cxr_reading[]" value="Other"/>
            <span class="form__checkmark"> </span></label>
            <div class="form__content form-group other-cxr-field">
              <div class="help-block with-errors"></div>
              <input class="form__input" type="text" id="other-cxr" placeholder="Specify" />
              <label class="form__label" for="">Specify Other</label>
              
            </div>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form-groupform__content--small form__content--small__right">
          <input class="form__input" type="date" name="ct_scan_date" placeholder="CT Scan date" />
          <label class="form__label" for="">CT scan date</label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="ct_scan_result" placeholder="CT Scan result" />
          <label class="form__label" for="">CT scan result</label>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form-groupform__content--small form__content--small__right">
          <input class="form__input" type="date" name="ultrasound_date" placeholder="Ultrasound date" />
          <label class="form__label" for="">Ultrasound date</label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="ultrasound_result" placeholder="Ultrasound result" />
          <label class="form__label" for="">Ultrasound result</label>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form-groupform__content--small form__content--small__right">
          <input class="form__input" type="date" name="histopathological_date" placeholder="Histopathological date" />
          <label class="form__label" for="">Histopathological date

          </label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="histopathological_result" placeholder="Histopathological result" />
          <label class="form__label" for="">Histopathological result</label>
        </div>
      </div>
    </div>
    <div class="form__container">
      <h2 class="section__heading">Related media (CXR, CTSCAN etc.)</h2>
      <div class="form__warning">
        <img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" />
        <p>Please make sure patient name is NOT included in your photo uploads. JPG, PNG and PDF files only allowed</p>
      </div>
      <div class="grid grid--two">
        <div class="dz-default dz-message dropzoneDragArea" id="dropzoneDragArea">
          <div class="gallery">
            <div class="gallery__container">
              <input class="gallery__trigger" type="file">
              <div class="gallery__icon">
                <img class="image" src="{{ asset('assets/app/img/icon-upload.png') }}" alt="Upload icon" /></div>
              <span class="gallery__text">Drag and drop or click to upload</span>
              <span class="gallery__text gallery__text--gray">
                Recommendation: <br />
                .jpg .png .pdf files less than 10mb
              </span>
            </div>
          </div>
        </div>
        <ul class="gallery__list" id="gallery-preview">
          <li class="gallery__item dz-preview dz-file-preview" id="gallery-container">
            <img class="image image--gallery" data-dz-thumbnail />
            <span class="gallery__text gallery__text--filename"></span>
            <img class="image image--close" src="{{ asset('assets/app/img/icon-close.png') }}" data-dz-remove /></li>
        </ul>
        {{-- <div id="file-uploads">
        </div>
        <div class="fallback"> <!-- this is the fallback if JS isn't working -->
          <input name="file" type="file" multiple />
      </div> --}}
        <input type="file" multiple name="attachments[]" class="attachment-upload" id="attachments">
      </div>
    </div>
    <div class="form__container form-step-4">
      <h2 class="section__heading">Remarks</h2>
      <div class="form__content form-group">
        <div class="help-block with-errors"></div>
          <textarea class="form__input form__input--message" placeholder="Remarks" name="remarks" required></textarea>
          <label class="form__label" for="">Remarks</label>
          
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-4">
    <a class="button button--back">Back</a>
    <button class="button button--next confirm-button" type="button">Create new enrollment</button>
  </div>
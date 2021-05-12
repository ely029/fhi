<div class="form__tab step-3">
    <div class="form__container">
      <h2 class="section__heading">Laboratory results and information</h2>
      <div class="form__container">
        <div class="grid form-step-3">
          <div class="form__content form__content--small form__content--small__right form-group">
            <input class="form__input" type="date" placeholder="CXR date" required name="cxr_date" />
            <div class="help-block with-errors"></div>
            <label class="form__label" for="">CXR date</label>
          </div>
          <div class="form__content">
            <select class="form__input form__input--select" name="cxr_reading">
              <option>Improved</option>
              <option>Stable/Unchanged</option>
              <option>Worsened</option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Latest comparative CXR Reading</label>
          </div>
        </div>
      </div>
      <div class="form__container form-step-3">
        <div class="form__content form-group">
          <input class="form__input" type="text" placeholder="CXR result" name="cxr_result" required/>
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">CXR result</label>
        </div>
      </div>
      <div class="form__container">
        <div class="grid">
          <div class="form__content form__content--small form__content--small__right">
            <input class="form__input" type="date" placeholder="CT scan date" name="ct_scan_date"/>
            <label class="form__label" for="">CT scan date</label>
          </div>
          <div class="form__content">
            <input class="form__input" type="text" placeholder="CT scan result" name="ct_scan_result"/>
            <label class="form__label" for="">CT scan result</label>
          </div>
        </div>
      </div>
      <div class="form__container">
        <div class="grid">
          <div class="form__content form__content--small form__content--small__right">
            <input class="form__input" type="date" placeholder="Ultrasound date" name="ultrasound_date" />
            <label class="form__label" for="">Ultrasound date</label>
          </div>
          <div class="form__content">
            <input class="form__input" type="text" placeholder="Ultrasound result" name="ultrasound_result"  />
            <label class="form__label" for="">Ultrasound result</label>
          </div>
        </div>
      </div>
      <div class="form__container">
        <div class="grid">
          <div class="form__content form__content--small form__content--small__right">
            <input class="form__input" type="date" placeholder="Histopathological date" name="histopathological_date" />
            <label class="form__label" for="">Histopathological date

            </label>
          </div>
          <div class="form__content"><input class="form__input" type="text" placeholder="Histopathological result" name="histopathological_result" />
            <label class="form__label" for="">Histopathological result</label>
          </div>
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
        <div class="dz-default dz-message dropzoneDragArea" id="dropzoneDragArea">
          <div class="gallery">
            <div class="gallery__container">
              <div class="gallery__icon">
                <img class="image" src="{{ asset('assets/app/img/icon-upload.png') }}" alt="Upload icon" />
              </div>
              <input class="gallery__trigger" type="file" /><span class="gallery__text">Drag and drop or click to upload</span>
              <span class="gallery__text gallery__text--gray">
                Recommendation: <br />
                .jpg .png files less than 10mb
              </span>
            </div>
          </div>
        </div>
        <ul class="gallery__list" id="gallery-preview">
          <li class="gallery__item dz-preview dz-file-preview" id="gallery-container">
            <img class="image image--gallery" data-dz-thumbnail />
            <img class="image image--close" src="{{ asset('assets/app/img/icon-close.png') }}" data-dz-remove />
          </li>
        </ul>
      </div>
    </div>
    <input type="file" multiple name="attachments[]" class="attachment-upload" id="attachments">
    <div class="form__container">
      <div class="grid form-step-3">
        <div class="form__content">
          <select class="form__input form__input--select" name="outcome">
            <option>Cured</option>
            <option>Treatment Completed</option>
            <option>Failed</option>
            <option>Lost to Follow-up</option>
            <option>Died</option>
            <option>Excluded</option>
          </select>
          <div class="triangle triangle--down"></div>
          <label class="form__label" for="">Outcome</label>
        </div>
      </div>
    </div>
    <div class="form__container form-step-3">
      <h2 class="section__heading">Remarks</h2>
      <div class="form__content form-group">
          <textarea class="form__input form__input--message" placeholder="Remarks" name="remarks" required></textarea>
          <label class="form__label" for="">Remarks</label>
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-3">
      <button class="button button--back" type="button">Back</button>
      <input class="button button--next confirm-button" type="button" value="Create new case">
    </div>
</div>
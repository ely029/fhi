<div class="form__tab step-3">
    <div class="form__container">
      <h2 class="section__heading">Laboratory results and information</h2>
      <div class="form__container">
        <div class="grid form-step-3">
          <div class="form__content form__content--small form__content--small__right form-group">
            <input class="form__input" type="date" placeholder="CXR date" required name="cxr_date" value="{{ $tbMacForm->laboratoryResults->cxr_date->format('Y-m-d') }}" />
            <div class="help-block with-errors"></div>
            <label class="form__label" for="">CXR date</label>
          </div>
          <div class="form__content">
            <select class="form__input form__input--select" name="cxr_reading">
                @foreach(treatmentCxrReading() as $cxrReading)
                    <option value="{{ $cxrReading }}"{{ $tbMacForm->laboratoryResults->cxr_reading === $cxrReading ? 'selected' : ''}}>{{ $cxrReading }}</option>
                @endforeach
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Latest comparative CXR Reading</label>
          </div>
        </div>
      </div>
      <div class="form__container form-step-3">
        <div class="form__content form-group">
          <input class="form__input" type="text" placeholder="CXR result" name="cxr_result" required value="{{ $tbMacForm->laboratoryResults->cxr_result }}" />
          <div class="help-block with-errors"></div>
          <label class="form__label" for="">CXR result</label>
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
    <ul class="gallery__list">
        <li class="gallery__item">
          @foreach($tbMacForm->attachments as $key => $attachment)
            <img class="image exist-attach-{{ $key }}" src="{{ url('treatment-outcomes/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}"/>
            <button type="button" class="btn btn-danger remove-attachment exist-attach-{{ $key }}" 
            data-filename="{{ $attachment->file_name }}" data-key="{{ $key }}">Remove</button>
          @endforeach
        </li>
        <input type="hidden"  name="attachments-to-remove" id="attachments-to-remove">
      </ul>
    <div class="form__container">
      <div class="grid form-step-3">
        <div class="form__content">
          <select class="form__input form__input--select" name="outcome">
            @foreach(treatmentOutome() as $outcome)
                <option value="{{ $outcome }}"{{ $tbMacForm->treatmentOutcomeForm->outcome === $outcome ? 'selected' : ''}}>{{ $outcome }}</option>
            @endforeach
          </select>
          <div class="triangle triangle--down"></div>
          <label class="form__label" for="">Outcome</label>
        </div>
      </div>
    </div>
    <div class="form__container form-step-3">
      <h2 class="section__heading">Remarks</h2>
      <div class="form__content form-group">
          <textarea class="form__input form__input--message" placeholder="Remarks" name="remarks" required>{{ $tbMacForm->laboratoryResults->remarks }}</textarea>
          <label class="form__label" for="">Remarks</label>
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-3">
      <button class="button button--back" type="button">Back</button>
      <input class="button button--next" value="Resubmit treatment outcome">
    </div>
</div>
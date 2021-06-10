<div class="form__tab step-4">
    <div class="form__container">
      <h2 class="section__heading">Laboratory results and information</h2>
      <div class="grid">
        <div class="form__content form__content--small form__content--small__right">
          <input class="form__input" type="date" name="cxr_date" placeholder="CXR date" value="{{ $tbMacForm->laboratoryResults->cxr_date ? $tbMacForm->laboratoryResults->cxr_date->format('Y-m-d') : ''   }}" />
          <label class="form__label" for="">CXR date</label>
        </div>
        <div class="form__content">
          <input class="form__input" name="cxr_result" type="text" placeholder="CXR result" value="{{ $tbMacForm->laboratoryResults->cxr_result }}" />
          <label class="form__label" for="">CXR result</label>
        </div>
      </div>
      <div class="grid grid--three grid--close">
        <div class="grid__item">
          <label class="form__sublabel">Normal
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Normal" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Normal', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}} />
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Cavitary
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Cavitary" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Cavitary', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}} />
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Infilitrates
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Infilitrates" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Infilitrates', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}} />
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Nodule
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Nodule" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Nodule', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Miliary TB
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Miliary TB" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Miliary TB', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span></label>
          <label class="form__sublabel">Intrathoracic Lymphadenopathy
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Intrathoracic Lymphadenopathy" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Intrathoracic Lymphadenopathy', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
        </div>
        <div class="grid__item form-step-4">
          <label class="form__sublabel">Endobronchial Spread
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Endobronchial Spread" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Endobronchial Spread', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Fibrosis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Fibrosis" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Fibrosis', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Bullae
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Bullae" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Bullae', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Pleural Effusion
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Pleural Effusion" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Pleural Effusion', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Fibrothorax
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Fibrothorax" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Fibrothorax', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Pneumothorax
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Pneumothorax" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Pneumothorax', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
        </div>
        <div class="grid__item">
          <label class="form__sublabel">Bronchiectasis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Bronchiectasis" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Bronchiectasis', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Atelectasis
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Atelectasis" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Atelectasis', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Consolidation
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Consolidation" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Consolidation', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Mass
            <input class="form__trigger" type="checkbox" name="cxr_reading[]" value="Mass" {{ $tbMacForm->laboratoryResults->cxr_reading ? (in_array('Mass', $tbMacForm->laboratoryResults->cxr_reading) ? 'checked' : '') : ''}}/>
            <span class="form__checkmark"> </span>
          </label>
          <label class="form__sublabel">Other
            @if($tbMacForm->laboratoryResults->cxr_reading)
              @php
                $otherCxr = null;
                foreach($tbMacForm->laboratoryResults->cxr_reading as $cxrReading){
                  if(\Str::startsWith($cxrReading, 'Other')){
                    $otherCxr = \Str::substr($cxrReading, 6);
                  }
                }
              @endphp
 
              <input class="form__trigger other-cxr" type="checkbox" name="{{ $otherCxr ? '' : 'cxr_reading[]' }}" value="Other" {{ $otherCxr ? 'checked' : '' }}/>
            @else

              @php
                 $otherCxr = null;
              @endphp
              <input class="form__trigger other-cxr" type="checkbox" name="cxr_reading[]" value="Other" />
            @endif
            <span class="form__checkmark"> </span></label>
            <input type="hidden" value="{{ $otherCxr }}" id="otherCxrField">
            <div class="form__content form-group other-cxr-field">
              <input class="form__input" type="text" id="other-cxr" placeholder="Specify" {{ $otherCxr ? 'required' : '' }} name="{{ $otherCxr ? 'cxr_reading[]' : '' }}" 
              value="{{ $otherCxr ? $otherCxr : '' }}"  />
              <label class="form__label" for="">Specify Other</label>
              <div class="help-block with-errors"></div>
            </div>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form__content--small form__content--small__right">
          <input class="form__input" type="date" name="ct_scan_date" placeholder="CT Scan date" value="{{ $tbMacForm->laboratoryResults->ct_scan_date ? $tbMacForm->laboratoryResults->ct_scan_date->format('Y-m-d') : '' }}"/>
          <label class="form__label" for="">CT scan date</label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="ct_scan_result" placeholder="CT Scan result" value="{{ $tbMacForm->laboratoryResults->ct_scan_result }}" />
          <label class="form__label" for="">CT scan result</label>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form__content--small form__content--small__right">
          <input class="form__input" type="date" name="ultrasound_date" placeholder="Ultrasound date" value="{{ $tbMacForm->laboratoryResults->ultrasound_date ? $tbMacForm->laboratoryResults->ultrasound_date->format('Y-m-d') : '' }}" />
          <label class="form__label" for="">Ultrasound date</label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="ultrasound_result" placeholder="Ultrasound result" value="{{ $tbMacForm->laboratoryResults->ultrasound_result }}" />
          <label class="form__label" for="">Ultrasound result</label>
        </div>
      </div>
      <div class="grid">
        <div class="form__content form__content--small form__content--small__right">
          <input class="form__input" type="date" name="histopathological_date" placeholder="Histopathological date" value="{{ $tbMacForm->laboratoryResults->histopathological_date ? $tbMacForm->laboratoryResults->histopathological_date->format('Y-m-d') : '' }}" />
          <label class="form__label" for="">Histopathological date

          </label>
        </div>
        <div class="form__content">
          <input class="form__input" type="text" name="histopathological_result" placeholder="Histopathological result" value="{{ $tbMacForm->laboratoryResults->histopathological_result }}" />
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
            <img class="image image--close" src="{{ asset('assets/app/img/icon-close.png') }}" data-dz-remove />
          </li>
          <ul class="gallery__list gallery__list--resubmit">
            @foreach($tbMacForm->attachments as $key => $attachment)
            <li class="gallery__item">
              
                @if(\Str::endsWith($attachment->file_name, '.pdf'))
                  <img class="image image--gallery exist-attach-{{ $key }}" src="{{ asset('assets/app/img/pdf.png') }}"/>
                @else
                  <img class="image image--gallery exist-attach-{{ $key }}" src="{{ url('enrollments/'.$tbMacForm->id.'/'.$attachment->file_name.'/attachment') }}"/>
                @endif
                <span class="gallery__text gallery__text--filename">{{ $attachment->file_name }}</span>
                <button type="button" class="remove-attachment exist-attach-{{ $key }}" 
                data-filename="{{ $attachment->file_name }}" data-key="{{ $key }}">
                  <img class="image image--close" src="{{ asset('assets/app/img/icon-close.png') }}">
                </button>
            </li>
            @endforeach 
            <input type="hidden"  name="attachments-to-remove" id="attachments-to-remove">
          </ul>
        </ul>
        
        <input type="file" multiple name="attachments[]" class="attachment-upload" id="attachments">
      </div>
    </div>
    
    <div class="form__container form-step-4">
      <h2 class="section__heading">Remarks</h2>
      <div class="form__content form-group">
      <div class="help-block with-errors"></div>
          <textarea class="form__input form__input--message" placeholder="Remarks" name="remarks" required>{{ $tbMacForm->laboratoryResults->remarks }}</textarea>
          <label class="form__label" for="">Remarks</label>
          
        </div>
    </div>
  </div>
  <div class="form__button form__button--space form__button--pagination step-4">
    <a class="button button--back">Back</a>
    <button class="button button--next" type="button">Resubmit enrollment</button>
  </div>
<div class="form__tab">
    <div class="form__container">
    <h2 class="section__heading">Treatment information</h2>
    <div class="grid grid--two">
        <div class="form__content"><input class="form__input" type="number" placeholder="Current weight (kg)" /><label class="form__label" for="">Current weight (kg)</label></div>
    </div>
    <div class="form__content">
        <select class="form__input form__input--select">
        <option> </option>
        <option> </option>
        <option> </option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Current regimen</label>
    </div>
    <div class="form__content"><textarea class="form__input form__input--message"> </textarea><label class="form__label" for="">Reason for case management presentation</label></div>
    </div>
    <div class="form__container">
    <h2 class="section__heading">Treatment information</h2>
    <div class="form__content">
        <select class="form__input form__input--select">
        <option> </option>
        <option> </option>
        <option> </option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Suggested regiment</label>
    </div>
    <div class="form__content"><input class="form__input" type="text" placeholder="Please specify (if ITR is chosen)" /><label class="form__label" for="">ITR drugs</label></div>
    <div class="form__content"><textarea class="form__input form__input--message"> </textarea><label class="form__label" for="">Suggested regiment notes</label></div>
    <div class="grid grid--two">
        <div class="form__content">
        <select class="form__input form__input--select">
            <option> </option>
            <option> </option>
            <option> </option>
        </select>
        <div class="triangle triangle--down"></div>
        <label class="form__label" for="">Updated type of case (optional)</label>
        </div>
    </div>
    </div>
</div>
<div class="form__tab">
    <div class="form__container">
    <h2 class="section__heading">Laboratory results and information</h2>
    <div class="form__container">
        <div class="grid">
        <div class="form__content form__content--small form__content--small__right"><input class="form__input" type="date" placeholder="CXR date" /><label class="form__label" for="">CXR date</label></div>
        <div class="form__content">
            <select class="form__input form__input--select">
            <option> </option>
            <option> </option>
            <option> </option>
            </select>
            <div class="triangle triangle--down"></div>
            <label class="form__label" for="">Latest comparative CXR Reading</label>
        </div>
        </div>
    </div>
    <div class="form__container">
        <div class="form__content"><input class="form__input" type="text" placeholder="CXR result" /><label class="form__label" for="">CXR result</label></div>
    </div>
    <div class="form__container">
        <div class="grid">
        <div class="form__content form__content--small form__content--small__right"><input class="form__input" type="date" placeholder="CT scan date" /><label class="form__label" for="">CT scan date</label></div>
        <div class="form__content"><input class="form__input" type="text" placeholder="CT scan result" /><label class="form__label" for="">CT scan result</label></div>
        </div>
    </div>
    <div class="form__container">
        <div class="grid">
        <div class="form__content form__content--small form__content--small__right"><input class="form__input" type="date" placeholder="Ultrasound date" /><label class="form__label" for="">Ultrasound date</label></div>
        <div class="form__content"><input class="form__input" type="text" placeholder="Ultrasound result" /><label class="form__label" for="">Ultrasound result</label></div>
        </div>
    </div>
    <div class="form__container">
        <div class="grid">
        <div class="form__content form__content--small form__content--small__right">
            <input class="form__input" type="date" placeholder="Histopathological date" /><label class="form__label" for="">Histopathological date</label>
        </div>
        <div class="form__content"><input class="form__input" type="text" placeholder="Histopathological result" /><label class="form__label" for="">Histopathological result</label></div>
        </div>
    </div>
    </div>
    <div class="form__container">
    <h2 class="section__heading">Related Media (CXR, CTSCAN etc.)</h2>
    <div class="form__warning">
        <img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" />
        <p>Please make sure patient name is NOT included in your photo uploads</p>
    </div>
    <div class="grid grid--two">
        <div class="dz-default dz-message dropzoneDragArea" id="dropzoneDragArea">
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
        </div>
        <ul class="gallery__list" id="gallery-preview">
        <li class="gallery__item dz-preview dz-file-preview" id="gallery-container"><img class="image image--gallery" data-dz-thumbnail /><img class="image image--close" src="src/img/icon-close.png" data-dz-remove /></li>
        </ul>
    </div>
    </div>
    <div class="form__container">
    <h2 class="section__heading">Remarks</h2>
    <div class="form__content"><textarea class="form__input form__input--message" placeholder="Remarks"></textarea><label class="form__label" for="">Remarks</label></div>
    </div>
</div>
<div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><input class="button button--next" type="submit" value="Submit"></div>
</div>
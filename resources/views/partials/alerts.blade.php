@if(session('alert'))
    <div class="alert">
        <span class="alert__text">{{ session('alert.message') }}</span>
        <button class="button button--transparent js-hide-alert">CLOSE</button>
    </div>
@endif
@if(session('recommendation'))
    <div class="modal" id="recommendation-successful" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal__background js-modal-background"></div>
            <div class="modal__container">
                <div class="modal__box">
                    <p class="modal__text">Recommendation successfully sent.</p>
                        
                        <div class="modal__button modal__button--end">
                        <button class="button js-modal-close" type="button">OK</button>
                        </div>
                    
            </div>
        </div>
    </div>
@endif
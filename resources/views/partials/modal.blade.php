<div class="modal js-modal" id="refer-to-regional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Refer To R-TBMac</h2>
                    <p class="modal__text">You are about to confirm 'Refer To R-TBMac' for this case and patient. If you have additional remarks, enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Refer to Regional"/>
                       <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                       <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

<div class="modal js-modal" id="not-for-referal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not For Referal</h2>
                    <p class="modal__text">You are about to decline and set this case to 'Not for Referal' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Referral"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="not-for-recommended-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not Recommended for Enrolment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Not Recommended for Enrolment' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">For Enrolment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'For Enrolment' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="recommended-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Recommend for Enrolment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Not Recommended for Enrolment' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="not-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not for Enrollment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Not for Enrollment' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="need-further-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Need Further Details</h2>
                    <p class="modal__text">You are about to decline and set this case to 'Need Further Details' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Need Further Details"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="refer-to-ntbmac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Refer to N-TBMac</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Refer to N-TBMac' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Refer to N-TBMac"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal js-modal" id="create-recom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background js-modal-background"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Create Recommendation</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Refer to N-TBMac' If you have additional remarks. enter them below.</p>
                    <form class="form" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="0"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>
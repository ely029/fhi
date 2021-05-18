<div class="modal" id="refer-to-regional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Refer to R-TB MAC</h2>
                    <p class="modal__text">You are about to confirm 'Refer To R-TB MAC' for this case and patient. If you have additional remarks, enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Refer to Regional"/>
                       <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                       <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

<div class="modal" id="not-for-referal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not for referral</h2>
                    <p class="modal__text">You are about to decline and set this case to 'Not for referral' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Referral"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="not-for-recommended-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not recommended for enrolment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Not recommended for enrolment' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">For enrolment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'For enrolment' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="recommended-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Recommend for enrollment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Recommend for enrollment' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="not-for-enrolment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Not for enrollment</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Not for enrollment' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Not For Enrollment"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="need-further-details" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Need further details</h2>
                    <p class="modal__text">You are about to decline and set this case to 'Need further details' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Need Further Details"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="refer-to-ntbmac" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Refer to N-TB MAC</h2>
                    <p class="modal__text">You are about to confirm and set this case to 'Refer to N-TB MAC' If you have additional remarks. enter them below.</p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="Refer to N-TBMac"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

            <div class="modal" id="create-recom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal__background" data-dismiss="modal"></div>
                <div class="modal__container">
                  <div class="modal__box">
                    <h2 class="modal__title">Create recommendation</h2>
                    <p class="modal__text"></p>
                    <form class="form form--full" method="POST" action="{{ route('enrolment.sendRecommendation')}}">
                    @csrf
                       <input type="hidden" value="{{ $tbMacForm->id}}" name="form_id"/>
                       <input type="hidden" name="status" value="0"/>
                      <div class="form__content"><textarea name="recommendation" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label></div>
                      <div class="modal__button"><input class="button" type="submit" value="Submit" /></div>
                    </form>
                  </div>
                </div>
            </div>

<div class="modal" id="resubmit-enrollment-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal__background" data-dismiss="modal"></div>
      <div class="modal__container">
          <div class="modal__box">
            <h2 class="modal__title">Resubmit new enrollment</h2>
              <p class="modal__text"></p>
                  <div class="form__content">
                      You are about to resubmit a new enrollment. Please read and prepare the requested information and documents
                      the remarks and recommendations section.
                  </div> 
                  <div class="modal__button">
                    <a href="{{ url('resubmit/enrollment/'.$tbMacForm->id) }}" class="button">Resubmit</a>
                  </div>
               
      </div>
  </div>
</div>

<div class="modal" id="treatment_outcome_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
      <div class="modal__box">
        <h2 class="modal__title" id="modal-title"></h2>
        <p class="modal__text" id="modal-text"></p>
        <form class="form" id="modal-form" method="POST" action="{{ url('treatment-outcomes/'.$tbMacForm->id.'/recommendation') }}">
            @csrf
            <input type="hidden" name="status"/>
            <div class="form__content">
                <textarea name="recommendation" required class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
                </div>
            <div class="modal__button">
                <button class="button" type="submit">Submit</button>
                <a href="{{ url('/treatment-outcomes/resubmit/'.$tbMacForm->id)}}"class="button hide--button">Submit</a>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal" id="refer-to-regional" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal__background" data-dismiss="modal"></div>
  <div class="modal__container">
    <div class="modal__box">
      <h2 class="modal__title" id="modal-title"></h2>
      <p class="modal__text" id="modal-text"></p>
      <form class="form" id="modal-form" method="POST" action="{{ url('case-management/'.$tbMacForm->id.'/recommendation') }}">
          @csrf
          <input type="hidden" name="status"/>
          <div class="form__content">
              <textarea name="recommendation" required class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
              </div>
          <div class="modal__button">
              <button class="button" type="submit">Submit</button>
              <a href="{{ url('/case-management/resubmit/'.$tbMacForm->id)}}"class="button hide--button">Submit</a>
          </div>
      </form>
    </div>
  </div>
</div>

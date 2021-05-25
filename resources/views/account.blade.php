<div class="section">
        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">John Smith</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link">My Account</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
          </div>
          <div class="section__top-menu">
            <input class="section__top-trigger" type="checkbox" />
            <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
            <span class="section__top-popup"><img class="image image--warning" src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report issue</span></span>
          </div>
        <div class="section__container">
          <div class="alert"><span class="alert__text">Password successfully changed</span><button class="button button--transparent js-hide-alert">CLOSE</button></div>
          <form class="form form--quarter">
            <h3 class="section__heading section__heading--unset">John Smith</h3>
            <p class="form__text">Medical doctor | 5m</p>
            <br />
            <br />
            <div class="grid grid--two grid--start">
              <div class="form__content"><span class="form__text">john</span><label class="form__label">Username</label></div>
              <div class="form__content"><span class="form__text">Healthcare</span><label class="form__label">Role </label></div>
            </div>
            <hr class="line" />
            <br />
            <div class="form__container">
              <h3 class="section__heading">Main Health Facility</h3>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">Region 1</span><label class="form__label">Region</label></div>
                <div class="form__content"><span class="form__text">Smaple</span><label class="form__label">Province </label></div>
              </div>
              <div class="grid grid--two">
                <div class="form__content"><span class="form__text">sample</span><label class="form__label">Municipality</label></div>
                <div class="form__content"><span class="form__text">Smaple</span><label class="form__label">Facility</label></div>
              </div>
            </div>
            <div class="form__button form__button--pagination">
              <a class="button button--back button--transparent" href="password-change.html">Change password</a><button class="button button--next js-trigger" type="button">Logout</button>
            </div>
            <div class="modal js-modal">
              <div class="modal__background js-modal-background"></div>
              <div class="modal__container">
                <div class="modal__box">
                  <h2 class="modal__title">Logout</h2>
                  <p class="modal__text">Are you sure you want to logout?</p>
                  <div class="modal__button"><button class="button button--transparent js-modal-close" type="button">Cancel</button><input class="button" type="submit" value="Logout" /></div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
<div class="section">

        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">Schedule a meeting</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link" href="meetings.html">Meetings</a><a class="breadcrumbs__link">Schedule a meeting</a><a class="breadcrumbs__link"></a></div>
          </div>
          <div class="section__top-menu">
            <input class="section__top-trigger" type="checkbox" />
            <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
            <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
          </div>
        </div>
        <div class="section__container">
          <form class="form" id="js-form" action="">
            <div class="grid grid--two grid--start">
              <div class="grid grid--schedule grid--start">
                <h2 class="section__heading">Schedule a meeting</h2>
                <div class="form__content"><input class="form__input" type="text" /><button class="button button--generate" type="button">Generate</button></div>
                <div class="form__content"><input class="form__input" type="text" placeholder="Add title" /></div>
                <div class="grid grid--two">
                  <div class="form__content"><input class="form__input" type="date" /></div>
                  <div class="form__content"><input class="form__input" type="time" /><input class="form__input" type="time" /></div>
                </div>
                <div class="form__content">
                  <p class="help-block with-errors js-guest-error"></p>
                  <input class="form__input" id="js-guests" type="text" placeholder="Add guests" /><input id="js-guests-array" type="text" name="email" value="[]" hidden />
                </div>
              </div>
              <div class="grid grid--start grid--invite">
                <h2 class="section__heading">Invited members</h2>
                <div class="grid grid--email" id="js-guests-container"></div>
              </div>
            </div>
            <div class="form__button form__button--end"><button class="button" type="button">Save</button></div>
          </form>
        </div>
      </div>
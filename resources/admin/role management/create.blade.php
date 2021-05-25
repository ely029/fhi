<div class="section">

        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">Create admin</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link" href="role-management.html">Role Management</a><a class="breadcrumbs__link">Create admin</a><a class="breadcrumbs__link"></a></div>
          </div>
          <div class="section__top-menu">
            <input class="section__top-trigger" type="checkbox" />
            <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
            <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png" alt="warning icon" /><span>Report issue</span></span>
          </div>
        </div>
        <div class="section__container">
          <form class="form" id="js-form" action="">
            <div class="form__container">
              <h2 class="section__heading">Admin Basic Details</h2>
              <div class="grid grid--three">
                <div class="form__content">
                  <input class="form__input" type="text" placeholder="Admin" />
                  <div class="triangle triangle--down"></div>
                  <label class="form__label" for="">Role</label>
                </div>
                <div class="form__content"><input class="form__input" type="email" placeholder="Email Address" /><label class="form__label" for="">Email Address</label></div>
                <div class="form__content"><input class="form__input" type="text" placeholder="Username" /><label class="form__label" for="">Username</label></div>
              </div>
              <div class="grid grid--three">
                <div class="form__content"><input class="form__input" type="text" placeholder="First Name" /><label class="form__label" for="">First Name</label></div>
                <div class="form__content"><input class="form__input" type="text" placeholder="Middle Name" /><label class="form__label" for="">Middle Name</label></div>
                <div class="form__content"><input class="form__input" type="text" placeholder="Last Name" /><label class="form__label" for="">Last Name</label></div>
              </div>
            </div>
            <div class="form__container">
              <h2 class="section__heading">Admin Password</h2>
              <div class="grid grid--two">
                <div class="form__content">
                  <input class="form__input" id="js-password" type="password" placeholder="Password" /><label class="form__label">Password</label><i class="fa fa-eye-slash" id="js-eye-password"></i>
                </div>
                <div class="form__content">
                  <input class="form__input" id="js-confirm-password" type="password" placeholder="Confirm Password" /><label class="form__label">Confirm Password</label><i class="fa fa-eye-slash" id="js-eye-confirm-password"></i>
                </div>
              </div>
            </div>
            <div class="form__button form__button--end"><input class="button" type="submit" value="Submit" /></div>
          </form>
        </div>
      </div>
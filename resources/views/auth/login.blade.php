@extends('layouts.app')

@section('content')
<form class="login" method="POST" id="login-form">
    <div class="login__container">
    <div class="login__card">
        <div class="login__top">
            <div class="login__wrapper">
                <img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Logo of FHI e-TBMAC">
            </div>
        </div>
                <div class="form__content form-group">
                   
                    <input class="form__input @error('email') is-invalid @enderror" name="username" type="text" placeholder="Email" required autocomplete="email" autofocus/>
                    <label class="form__label">Username</label>
                    
                </div>
                <div class="form__content">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <input class="form__input @error('password') is-invalid @enderror" id="js-password" type="password" name="password"  
                    placeholder="Password" autocomplete="current-password" required/>
                    <label class="form__label">Password</label><i class="fa fa-eye-slash" id="js-eye-password"></i>
                    
                </div>
                <div class="form__button form__button--space"><a class="button button--transparent" href="change-password.html">Forgot password </a>
                    <button type="submit" class="button" id="login-button">Login</button>
                    
                    <input type="hidden" id="system_key" value="{{ config('services.itis.login_key') }}">
                </div>
            
    </div>
    </div>
</form>
<div class="modal" id="loadingModal">
    <div class="modal__background" data-dismiss="modal"></div>
    <div class="modal__container">
      <div class="modal__box">
        <h2 class="modal__title">Logging in</h2>
        <p class="modal__text">Please wait accordingly.</p>
        <div class="modal__button modal__button--center">
          <div class="loader"></div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('additional_scripts')
<script src="{{ asset('assets/app/js/crypto.js') }}"></script>
  <script src="{{ asset('assets/app/js/login.js') }}"></script>

@endsection
@extends('layouts.app')

@section('content')
<form class="login" method="POST" action="{{ route('login') }}">
    <div class="login__container">
    <div class="login__card">
        <div class="login__top">
            <div class="login__wrapper">
                <img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Logo of FHI e-TBMAC">
            </div>
        </div>

                @csrf
                <div class="form__content form-group">
                   
                    <input class="form__input @error('email') is-invalid @enderror" name="email" 
                    type="text" placeholder="Email" required autocomplete="email" autofocus/>
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
                
                </div>
            
    </div>
    </div>
</form>
@endsection
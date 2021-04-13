@extends('layouts.app')

@section('content')
<div class="container">
    <div class="login">
        <div class="login__container">
        <div class="login__card">
            <div class="login__top"></div>
                <form class="form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form__content">
                        <input class="form__input form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" 
                        type="email" placeholder="Email" required autocomplete="email" autofocus/>
                        <label class="form__label">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__content">
                        <input class="form__input form-control @error('password') is-invalid @enderror" id="js-password" type="password" name="password" 
                        placeholder="Password" autocomplete="current-password" required/>
                        <label class="form__label">Password</label><i class="fa fa-eye-slash" id="js-eye-password"></i>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form__button form__button--space"><a class="button button--transparent" href="">Forgot password </a><button type="submit" class="button" >Login</button></div>
                </form>
        </div>
        </div>
    </div>
</div>
@endsection

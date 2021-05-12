{{-- @extends('layouts.admin.dashboard') --}}

@section('content')
<form class="login">
    <div class="login__container">
    <div class="login__card">
        <div class="login__top"><div class="login__wrapper">
                <img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Logo of FHI e-TBMAC">
            </div></div>
        <div class="form__content"><input class="form__input" type="text" placeholder="Email" /><label class="form__label">Email</label></div>
        <div class="form__content"><input class="form__input" id="js-password" type="password" placeholder="Password" /><label class="form__label">Password</label><i class="fa fa-eye-slash" id="js-eye-password"></i></div>
        <div class="form__button form__button--space"><a class="button button--transparent" href="">Forgot password </a><a class="button" href="">Login</a></div>
    </div>
    </div>
</form>
@endsection
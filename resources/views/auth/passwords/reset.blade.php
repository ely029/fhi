@extends('layouts.app')

@section('content')
<div class="login">
    <div class="login__container login__container--big">
      <div class="login__card">
        <div class="login__top">
          <div class="login__wrapper "><img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Logo of FHI e-TBMAC" /></div>
        </div>
        <form class="form form--full" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">
          <h2 class="section__heading section__heading--unset">Personal information</h2>
          <div class="grid grid--two">
            <div class="form__content">
                <span class="form__text">{{ $user ? $user->first_name : '' }}</span>
                <label class="form__label">First Name</label>
            </div>
            <div class="form__content">
                <span class="form__text">{{ $user ? $user->last_name : '' }}</span>
                <label class="form__label">Last Name</label>
            </div>
          </div>
          <div class="grid grid--two">
            <div class="form__content">
                <span class="form__text">Admin</span>
                <label class="form__label">Role</label>
            </div>
            <div class="form__content">
                <span class="form__text">{{ $user ? $user->email : '' }}</span>
                <label class="form__label">Email Address</label>
            </div>
          </div>
          <h2 class="section__heading section__heading--unset">Update your password</h2>
          <div class="form__content">
              <input class="form__input" id="js-password" type="password" placeholder="New Password" name="password" required />
              
              @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              <label class="form__label">New Password</label>
              <i class="fa fa-eye-slash" id="js-eye-password"></i></div>
          <div class="form__content">
            <input class="form__input" id="js-confirm-password" type="password" placeholder="Confirm New Password" name="password_confirmation" required/>
            <label class="form__label">Confirm New Password</label>
            <i class="fa fa-eye-slash" id="js-eye-confirm-password"></i>
          </div>
          <div class="form__button form__button--space">
              <a class="button button--transparent" href="{{ url('admin/login') }}">Back to login</a>
              <button type="submit" class="button">
                Update
              </button>
            </div>
        </form>
      </div>
    </div>
  </div>
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

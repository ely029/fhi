@extends('layouts.app')

@section('content')
<div class="login">
    <div class="login__container">
      <div class="login__card">
        <div class="login__top"></div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="form form--full" method="POST" action="{{ route('password.email') }}">
            @csrf
          <h2 class="section__title section__title--small">Password reset</h2>
          <p class="login__details">Enter your email that you used to register and we will send you a link to reset it.</p>
<<<<<<< HEAD
            <div class="form__content">
                @error('email')
=======
            <div class="form__content form-group @error('email') has-error @enderror">
              <input class="form__input @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus />
              @error('email')
>>>>>>> eeb27f29da9fb8d807597e0c8df38ec1b2ce1ec8
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
              @enderror
              <input class="form__input @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus />
              
              <label class="form__label">Email</label>
            </div>
            <div class="form__button form__button--space">
              <a class="button button--transparent" href="{{ url('admin/login') }}">Back to login</a>
              <button type="submit" class="button">Submit</button>
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
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
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

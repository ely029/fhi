@extends('layouts.app')

@section('content')
<div class="login login--success">
    <div class="login__container login__container--password">
      <div class="login__card">
        <div class="login__top">
          <div class="login__wrapper"><img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Email icon of FHI" /></div>
        </div>
        <h2 class="section__title section__title--small">Success!</h2>
        <p class="login__details">Password reset link has been sent to your email account. Please check your inbox.</p>
      </div>
    </div>
  </div>
@endsection

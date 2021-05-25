@extends('layouts.app')

@section('content')
<div class="login">
    <div class="login__container">
      <div class="login__card">
        <div class="login__top">
          <div class="login__wrapper login__wrapper--email"><img class="image" src="{{ asset('assets/app/img/icon-email.png') }}" alt="Email icon of FHI" /></div>
        </div>
        <h2 class="section__title section__title--small">Success!</h2>
        <p class="login__details">Password reset link has been sent to your email account. Please check your inbox.</p>
      </div>
    </div>
  </div>
@endsection

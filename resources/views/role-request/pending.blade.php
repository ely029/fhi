@extends('layouts.app')

@section('content')
    <div class="login login--success">
        <div class="login__container login__container--password">
            <div class="login__card">
                <div class="login__top">
                    <div class="login__wrapper">
                        <img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Email icon of FHI" />
                    </div>
                </div>
                <h2 class="section__title section__title--small">Request Sent</h2>
                <p class="login__details">An administrator will check your request. You will receive a confirmation email
                    once your account is approved.</p>
            </div>
        </div>
    </div>
@endsection
@section('additional_scripts')


@endsection

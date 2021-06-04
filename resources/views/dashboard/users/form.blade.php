@extends('layouts.app')

@section('title', $method === 'POST' ? 'Create an admin' : 'Update admin details')
@section('description', $method === 'POST' ? 'Create an admin' : 'Update admin details')

@section('content')
    <div class="section">

        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">Create admin</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('dashboard/users') }}">Admin Role
                        Management</a><a class="breadcrumbs__link">Create admin</a><a class="breadcrumbs__link"></a></div>
            </div>
            
        </div>

        @include('partials.alerts')
        
        <div class="section__container">
            <form class="form" id="js-form" method="POST"
                action="{{ url('/dashboard/users', isset($user) ? $user->id : null) }}">
                @csrf
                {{ method_field($method) }}
                <div class="form__container">
                    <h2 class="section__heading">Admin Basic Details</h2>
                    <div class="grid grid--two">
                        <div class="form__content">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input" type="email" placeholder="Email Address"
                                value="{{ old('email', isset($user) ? $user->email : '') }}" name="email" required />
                            <label class="form__label" for="">Email Address</label>
                        </div>
                        <div class="form__content">
                            @error('username')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input" type="text" placeholder="Username"
                                value="{{ old('username', isset($user) ? $user->username : '') }}" name="username"
                                required />

                            <label class="form__label" for="">Username</label>
                        </div>
                    </div>
                    <div class="grid grid--three">
                        <div class="form__content">
                            @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input" type="text" placeholder="First Name" name="first_name"
                                value="{{ old('first_name', isset($user) ? $user->first_name : '') }}" required />

                            <label class="form__label" for="">First Name</label>
                        </div>
                        <div class="form__content">
                            @error('middle_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input" type="text" placeholder="Middle Name" name="middle_name"
                                value="{{ old('middle_name', isset($user) ? $user->middle_name : '') }}" />

                            <label class="form__label" for="">Middle Name</label>
                        </div>
                        <div class="form__content">
                            @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input" type="text" placeholder="Last Name" name="last_name"
                                value="{{ old('last_name', isset($user) ? $user->last_name : '') }}" required />

                            <label class="form__label" for="">Last Name</label>
                        </div>
                    </div>
                </div>
                <div class="form__container">
                    <h2 class="section__heading">Admin Password</h2>
                    <div class="grid grid--two">
                        <div class="form__content">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <input class="form__input @error('password') is-invalid @enderror" id="js-password"
                                type="password" placeholder="Password" name="password" {{ $method == 'POST' ? 'required' : '' }} />

                            <label class="form__label">Password</label><i class="fa fa-eye-slash" id="js-eye-password"></i>
                        </div>
                        <div class="form__content">
                            <input class="form__input" id="js-confirm-password" type="password" name="password_confirmation"
                            {{ $method == 'POST' ? 'required' : '' }} placeholder="Confirm Password" /><label class="form__label">Confirm
                                Password</label><i class="fa fa-eye-slash" id="js-eye-confirm-password"></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="role_id" value="2">
                <div class="form__button form__button--end">
                    <input class="button" type="submit" value="Submit" />
                </div>
            </form>
        </div>
    </div>
@endsection

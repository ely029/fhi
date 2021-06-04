@extends('layouts.app')

@section('title', 'Account')
@section('description', 'Account')

@section('content')
    <div class="wrapper">
        @include('partials.sidebar')

        <div class="section">
            <div class="section__top">
                <div class="section__top-text">
                    <h1 class="section__title">{{ auth()->user()->name }}</h1>
                    <div class="breadcrumbs"><a class="breadcrumbs__link">My Account</a><a class="breadcrumbs__link"></a><a
                            class="breadcrumbs__link"></a></div>
                </div>
                <div class="section__top-menu">
                    <input class="section__top-trigger" type="checkbox" />
                    <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
                    <span class="section__top-popup"><img class="image image--warning"
                            src="{{ asset('assets/app/img/icon-warning.png') }}" alt="warning icon" /><span>Report
                            issue</span></span>
                </div>
            </div>
            <div class="section__container">
                @include('partials.alerts')
                <form class="form form--quarter">
                    <h3 class="section__heading section__heading--unset">{{ auth()->user()->name }}</h3>

                    <br />
                    <div class="grid grid--two grid--start">
                        <div class="form__content"><span class="form__text">{{ auth()->user()->username }}</span><label
                                class="form__label">Username</label></div>
                        <div class="form__content"><span class="form__text">{{ auth()->user()->role->name }}</span><label
                                class="form__label">Role
                            </label></div>
                    </div>
                    <hr class="line" />
                    <br />
                    <div class="form__container">
                        <h3 class="section__heading">Main Health Facility</h3>
                        <div class="grid grid--two">
                            <div class="form__content"><span class="form__text">{{ auth()->user()->region }}</span><label
                                    class="form__label">Region</label></div>
                            <div class="form__content"><span class="form__text"></span><label class="form__label">Province
                                </label></div>
                        </div>
                        <div class="grid grid--two">
                            <div class="form__content"><span class="form__text"></span><label
                                    class="form__label">Municipality</label></div>
                            <div class="form__content"><span class="form__text"></span><label
                                    class="form__label">Facility</label></div>
                        </div>
                    </div>
                    <div class="form__button form__button--pagination">
                        <a class="button button--back button--transparent" href="password-change.html">Change
                            password</a><button class="button button--next" type="button">Logout</button>
                    </div>
                    
                </form>
                <div class="modal">
                    <div class="modal__background" data-dismiss="modal"></div>
                    <div class="modal__container">
                        <div class="modal__box">
                            <h2 class="modal__title">Logout</h2>
                            <p class="modal__text">Are you sure you want to logout?</p>
                            <div class="modal__button">
                                <button class="button button--transparent" type="button"
                                    data-dismiss="modal">Cancel</button>
                                @if (auth()->user()->role_id == 1 || auth()->user()->role_id == 2)
                                    <form action="{{ url('admin/logout') }}" method="POST">
                                        @csrf
                                        <button class="button" type="submit">Logout</button>
                                    </form>
                                @else
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="button" type="submit">Logout</button>
                                    </form>
                                @endif
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/feedbacks.js') }}"></script>
    <script src="{{ asset('assets/app/js/account.js') }}"></script>
@endsection

@extends('layouts.app')

@section('content')
    <form class="login" action="{{ url('role/request') }}" method="POST">
        @csrf
        <div class="login__container">
            <div class="login__card">
                <div class="login__top">
                    <div class="login__wrapper">
                        <img class="image" src="{{ asset('assets/app/img/logo.png') }}" alt="Logo of FHI e-TBMAC">
                    </div>
                </div>
                <h2 class="section__title section__title--small">Welcome {{ auth()->user()->name }}</h2>
                <p class="login__details">
                    Before you can begin, please select your role from the list. <br />
                    <br />
                    <br />
                    <br />
                </p>
                <div class="form__content">
                    <select class="form__input form__input--select" name="role_id">
                        <option value="3">Health Care Worker</option>
                        <option value="4">Regional Secretariat</option>
                        <option value="5">R-TB MAC</option>
                        <option value="6">R-TB MAC Chair</option>
                        <option value="7">N-TB MAC </option>
                        <option value="8">N-TB MAC Chair</option>
                    </select>
                    <div class="triangle triangle--down"></div>
                    <label class="form__label">Role select</label>
                </div>
                <div class="form__button form__button--end">
                    <button type="submit" class="button">Submit</button>
                </div>

            </div>
        </div>
    </form>
@endsection
@section('additional_scripts')


@endsection

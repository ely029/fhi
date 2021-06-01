@extends('layouts.app')

@section('title', 'View Admin')
@section('description', 'View Admin')

@section('content')
    <div class="section">

        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">Create admin</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('dashboard/users') }}">Admin Role
                        Management</a><a class="breadcrumbs__link">Create admin</a><a class="breadcrumbs__link"></a></div>
            </div>
            <div class="section__top-menu">
                <input class="section__top-trigger" type="checkbox" />
                <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
                <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png"
                        alt="warning icon" /><span>Report issue</span></span>
            </div>
        </div>

        @include('partials.alerts')

        <div class="section__container">
            <form class="form form--half" action="">
                <h2 class="section__heading">Admin</h2>
                <div class="grid grid--two">
                    <div class="form__content"><span class="form__text">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</span><label class="form__label" for="">Full
                            name</label></div>
                    <div class="form__content"><span class="form__text">*********</span><label class="form__label"
                            for="">Password</label></div>
                </div>
                <div class="grid grid--two">
                    <div class="form__content"><span class="form__text">{{ $user->username }}</span><label class="form__label"
                            for="">Username</label></div>
                    <div class="form__content"><span class="form__text">{{ $user->created_at->format('M d, Y') }}</span><label class="form__label"
                            for="">Date created</label></div>
                </div>
                <div class="grid grid--two">
                    <div class="form__content"><span class="form__text">{{ $user->email }}</span><label class="form__label"
                            for="">Email address</label></div>
                </div>
                <div class="form__button form__button--pagination">
                    <a href="{{ url('dashboard/users/'.$user->id.'/edit') }}" class="button button--accept button--back">Edit</a>
                        <button class="button button--decline button--next" type="button">Delete</button></div>

            </form>
        </div>
    </div>
@endsection

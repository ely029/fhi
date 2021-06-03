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
                        <button class="button button--decline button--next" id="button--delete" type="button">Delete</button></div>

            </form>
        </div>
        <div class="modal" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal__background" data-dismiss="modal"></div>
            <div class="modal__container">
              <div class="modal__box">
                <h2 class="modal__title">Delete user</h2>
                <p class="modal__text">Are you sure you want to delete this user?</p>
                <form class="form form--full" method="POST" action="{{ url('dashboard/users/'.$user->id) }}">
                @csrf
                {{ method_field('DELETE') }}
                  <div class="modal__button">
                      <button class="button" data-dismiss="modal" type="button">Cancel</button>
                      <input class="button" type="submit" value="Delete" />
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/dashboard/js/users/show.js') }}"></script>
@endsection

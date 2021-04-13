@extends('layouts.app')

@section('title', ($method === 'POST' ? 'Create an admin' : 'Update admin details'))
@section('description', ($method === 'POST' ? 'Create an admin' : 'Update admin details'))

@section('content')
    <div class="section">
        <div class="section__top">
          <h1 class="section__title">{{ $method === 'POST' ? 'Add Admin' : 'Edit Admin' }}</h1>
          <div class="breadcrumbs">
              <a class="breadcrumbs__link" href="{{ url('dashboard/users') }}">Admins</a>
              <a class="breadcrumbs__link">{{ $method === 'POST' ? 'Add Admin' : 'Edit Admin' }}</a><a class="breadcrumbs__link"></a>
            </div>
        </div>

        @include('partials.alerts')

        <div class="section__container">

          <form class="form" role="form" method="POST"
            action="{{ url('/dashboard/users', isset($user) ? $user->id : null) }}" enctype="multipart/form-data">
            @csrf
            {{ method_field($method) }}
            <div class="form__tab">
              <div class="form__container">
                <h2 class="section__heading">Details</h2>
                <div class="grid">
                  <div class="form__content">                    
                      <input id="name" type="text" class="form__input form-control @error('name') is-invalid @enderror" name="name" 
                      value="{{ old('name', isset($user) ? $user->name : '') }}" required autocomplete="name" autofocus placeholder="Name">
                      <label class="form__label" for="name">Name</label>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                  </div>
                </div>
                <div class="grid">
                    <div class="form__content">                    
                        <input id="email" type="email" class="form__input form-control @error('email') is-invalid @enderror" name="email" 
                        value="{{ old('email', isset($user) ? $user->email : '') }}" required placeholder="Email">
                        <label class="form__label" for="email">Email</label>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="grid">
                    <div class="form__content">                    
                        <input id="password" type="password" class="form__input form-control @error('password') is-invalid @enderror" name="password">
                        <label class="form__label" for="password">Password</label>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="grid">
                    <div class="form__content">                    
                        <input id="password_confirmation" type="password" class="form__input form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                        <label class="form__label" for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <input type="hidden" name="role_id" value="2">
              </div>

            </div>
            <div class="form__button form__button--space form__button--pagination">
              <a class="button button--back" href="{{ url('dashboard/users') }}">Back</a>
              <button class="button button--next" type="submit">Save</button>
            </div>
          </form>    
        </div>
      </div>
@endsection

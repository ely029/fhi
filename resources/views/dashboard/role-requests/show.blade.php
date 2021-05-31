@extends('layouts.app')

@section('title', 'View Role Requests')
@section('description', 'View Role Requests')

@section('content')
    <div class="section">
        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">{{ $roleRequest->user->itis_name }}</h1>
                <div class="breadcrumbs">
                    <a class="breadcrumbs__link" href="{{ url('dashboard/role-requests') }}">Role management</a>
                    <a class="breadcrumbs__link">{{ $roleRequest->user->itis_name }}</a><a class="breadcrumbs__link"></a>
                </div>
            </div>
            <div class="section__top-menu">
                <input class="section__top-trigger" type="checkbox" />
                <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
                <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png"
                        alt="warning icon" /><span>Report issue</span></span>
            </div>
        </div>
        <div class="section__container">
            <h2 class="section__heading">{{ $roleRequest->role->name }}</h2>
            <div class="grid grid--two">
                <div class="form__content">
                    <span class="form__text">{{ $roleRequest->user->itis_name }}</span>
                    <label class="form__label" for="">Name</label>
                </div>
                <div class="form__content">
                    <span class="form__text">{{ $roleRequest->user->username }}</span>
                    <label class="form__label" for="">Username</label>
                </div>
            </div>
            <div class="grid grid--two">
                <div class="form__content"><span class="form__text">{{ $roleRequest->user->email }}</span><label
                        class="form__label" for="">Email address</label></div>
                <div class="form__content"><span
                        class="form__text">{{ $roleRequest->created_at->format('Y-m-d') }}</span><label
                        class="form__label" for="">Joining date</label></div>
            </div>
            @if ($roleRequest->status == 'pending')
                <div class="form__button form__button--pagination">
                    <form action="{{ url('dashboard/role-requests/' . $roleRequest->id) }}" method="POST">
                        @csrf
                        {{ method_field('PATCH') }}
                        <button type="submit" class="button button--accept button--back" name="status"
                            value="approved">Approve</button>
                    </form>
                    <button class="button button--decline button--next" type="button">Decline</button>
                </div>
                <div class="modal js-modal">
                    <div class="modal__background js-modal-background"></div>
                    <div class="modal__container">
                        <div class="modal__box">
                            <h2 class="modal__title">Your message</h2>
                            <p class="modal__text">By declining this {{ $roleRequest->role->name }}, you're require to
                                leave a
                                remarks.</p>
                            <form class="form" action="{{ url('dashboard/role-requests/' . $roleRequest->id) }}"
                                method="POST">
                                @csrf
                                {{ method_field('PATCH') }}
                                <div class="form__content">
                                    <textarea class="form__input form__input--message" placeholder="Enter remarks" required
                                        name="remarks"></textarea>
                                    <label class="form__label" for="">Remarks</label>
                                </div>

                                <div class="modal__button">
                                    <button class="button" type="submit" name="status" value="declined">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/dashboard/js/role-requests/show.js') }}"></script>
@endsection

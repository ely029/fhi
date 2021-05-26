@extends('layouts.app')

@section('title', 'View Admins')
@section('description', 'View Admins')

@section('content')
    <div class="section">
        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">Role Management</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link">Role Management</a>
                    <a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a>
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
            <a class="button button--create" href="{{ url('dashboard/users/create') }}">Create admin</a>

            @include('partials.alerts')
            <div class="section__content">
                <table class="table table--filter js-table-unset">
                    <thead>
                        <tr>
                            <th class="table__head">Username</th>
                            <th class="table__head">Name</th>
                            <th class="table__head">Email</th>
                            <th class="table__head">Date Created</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="table__row js-view" data-href="view-feedback.html">
                                <td class="table__details">{{ $user->username }}</td>
                                <td class="table__details">{{ $user->name }}</td>
                                <td class="table__details">{{ $user->email }}</td>
                                <td class="table__details">{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection

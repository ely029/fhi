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
                            <tr class="table__row js-view" data-href="{{ url('dashboard/users/'.$user->id) }}">
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

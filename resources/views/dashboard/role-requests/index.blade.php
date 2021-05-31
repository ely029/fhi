@extends('layouts.app')

@section('title', 'View Role Requests')
@section('description', 'View Role Requests')

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
            @include('partials.alerts')
            <div class="section__content">
                <ul class="tabs__list tabs__list--table">
                    <a href="{{ url('dashboard/role-requests') }}">
                        <li class="tabs__item {{ ! request('role') ? 'tabs__item--current' : '' }}">All roles ({{ $allCount['total'] }})</li>
                    </a>
                    <a href="{{ url('dashboard/role-requests?role=4') }}">
                        <li class="tabs__item {{ request('role') == '4' ? 'tabs__item--current' : '' }}">Regional Secretariat ({{ $allCount[4] }})</li>
                    </a>
                    <a href="{{ url('dashboard/role-requests?role=5') }}">
                        <li class="tabs__item {{ request('role') == '5' ? 'tabs__item--current' : '' }}">R-TB MAC ({{ $allCount[5] }})</li>
                    </a>
                    <a href="{{ url('dashboard/role-requests?role=6') }}">
                        <li class="tabs__item {{ request('role') == '6' ? 'tabs__item--current' : '' }}">R-TB MAC Chair ({{ $allCount[6] }})</li>
                    </a>
                    <a href="{{ url('dashboard/role-requests?role=7') }}">
                        <li class="tabs__item {{ request('role') == '7' ? 'tabs__item--current' : '' }}">N-TB MAC ({{ $allCount[7] }})</li>
                    </a>
                    <a href="{{ url('dashboard/role-requests?role=8') }}">
                        <li class="tabs__item {{ request('role') == '8' ? 'tabs__item--current' : '' }}">N-TB MAC Chair ({{ $allCount[8] }})</li>
                    </a>
                </ul>
                <div class="tabs__details tabs__details--active">
                    <table class="table table--filter js-table">
                        <thead>
                            <tr>
                                <th class="table__head">User ID</th>
                                <th class="table__head">Username</th>
                                <th class="table__head">Name</th>
                                {{-- <th class="table__head">First Name</th> --}}
                                <th class="table__head">Role</th>
                                <th class="table__head">Joining Date</th>
                                <th class="table__head">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roleRequests as $roleRequest)
                                <tr class="table__row js-view" data-href="{{ url('dashboard/role-requests/'.$roleRequest->id) }}">
                                    <td class="table__details">{{ $roleRequest->user->id }}</td>
                                    <td class="table__details">{{ $roleRequest->user->username }}</td>
                                    <td class="table__details">{{ $roleRequest->user->itis_name }}</td>
                                    <td class="table__details">{{ $roleRequest->role->name }}</td>
                                    <td class="table__details">{{ $roleRequest->created_at->format('Y-m-d') }}</td>
                                    <td class="table__details">{{ $roleRequest->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $roleRequests->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

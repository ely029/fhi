@extends('layouts.app')

@section('title', 'Reports')
@section('description', 'Reports')

@section('content')
    <div class="section">
        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">Reports</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link">Reports</a>
                    <a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a>
                </div>
            </div>
        </div>
        <div class="section__container">
            <a class="button button--create" href="{{ url('reports/generate') }}">Generate</a>

            @include('partials.alerts')
            <div class="section__content">
                <table class="table table--filter js-table-unset">
                    <thead>
                        <tr>
                            <th class="table__head">Report no</th>
                            <th class="table__head">Period</th>
                            <th class="table__head">Date</th>
                            <th class="table__head">Region</th>
                            <th class="table__head">Province</th>
                            <th class="table__head">Health facility</th>
                            <th class="table__head">Prepared by</th>
                            <th class="table__head">Date generated</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($users as $user)
                            <tr class="table__row js-view" data-href="{{ url('dashboard/users/'.$user->id) }}">
                                <td class="table__details">{{ $user->username }}</td>
                                <td class="table__details">{{ $user->name }}</td>
                                <td class="table__details">{{ $user->email }}</td>
                                <td class="table__details">{{ $user->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
                {{-- {{ $users->links() }} --}}
            </div>
        </div>
    </div>
@endsection

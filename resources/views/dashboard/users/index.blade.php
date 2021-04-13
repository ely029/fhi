@extends('layouts.app')

@section('title', 'View Admins')
@section('description', 'View Admins')

@section('content')

<div class="section">
    <div class="section__top">
      <h1 class="section__title">Admins</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Admins</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__container">
      <a class="button button--create" href="{{ url('dashboard/users/create') }}">Add admin</a>
    
      @include('partials.alerts')

      <div class="section__content">

          <table class="table table--filter">
            <thead>
              <tr>
                <th class="table__head">Name</th>
                <th class="table__head">Email Address</th>
                <th class="table__head">Date Added</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr class="table__row js-view" data-href="{{ url('dashboard/users/'.$user->id.'/edit') }}">
                        <td class="table__details">
                            {{ $user->name }}
                        </td>
                        <td class="table__details">
                            {{ $user->email }}
                        </td>
                        <td class="table__details">
                            {{ $user->created_at->toCookieString() }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
      

      </div>
    </div>
  </div>
@endsection

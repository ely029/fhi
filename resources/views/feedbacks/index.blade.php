@extends('layouts.app')

@section('title', 'Feedbacks')
@section('description', 'Feedbacks')

@section('content')
<div class="section">

        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">Feedback</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link">Feedback</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
          </div>
          
        </div>
        <div class="section__container section__container--unset">
          <table class="table table--filter js-table-feedback">
            <thead>
              <tr>
                <th class="table__head">Username</th>
                <th class="table__head">Role</th>
                <th class="table__head">Channel</th>
                <th class="table__head">Date</th>
                <th class="table__head">Issue</th>
              </tr>
            </thead>
            <tbody>
            @foreach($feedback as $feedbacks)
            <tr class="table__row js-view" data-href="{{ url('admin/feedbacks/view/'.$feedbacks->id)}}">
                <td class="table__details">{{ empty($feedbacks->submittedBy->email) ? '' : $feedbacks->submittedBy->email}}</td>
                <td class="table__details">{{ empty($feedbacks->roles->name) ? '' : $feedbacks->roles->name }}</td>
                <td class="table__details">{{ empty($feedbacks->channel) ? '' : $feedbacks->channel}}</td>
                <td class="table__details">{{ empty($feedbacks->created_at) ? '' : $feedbacks->created_at}}</td>
                <td class="table__details">{{ empty($feedbacks->issue) ? '' : $feedbacks->issue}}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
@endsection
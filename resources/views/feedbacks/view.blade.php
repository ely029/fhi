@extends('layouts.app')

@section('title', 'Feedbacks')
@section('description', 'Feedbacks')

@section('content')
<div class="section">
        <div class="section__top">
          <div class="section__top-text">
          <h1 class="section__title">Feedback</h1>
          <div class="breadcrumbs"><a class="breadcrumbs__link" href="{{ url('admin/feedbacks') }}">Feedback</a><a class="breadcrumbs__link">Feedback message</a><a class="breadcrumbs__link"></a></div>
          </div>
          
        </div>
        <div class="section__container">
          <form class="form" action="">
            <div class="form__content"><span class="form__text">{{ $feedback->issue }}</span><label class="form__label" for="">Issue </label></div>
          </form>
        </div>
      </div>
@endsection
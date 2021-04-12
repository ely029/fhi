@extends('layouts.admin.dashboard')

@section('content')
<div class="login">
  <div class="login__container">
    <div class="login__card">
      <div class="login__top"></div>
      <form class="form">
        <h2 class="section__title section__title--small">Welcome [name]</h2>
        <p class="login__details">
          Before you can begin, please select your role from the list. <br />
          <br />
          <br />
          <br />
        </p>
        <div class="form__content">
          <select class="form__input form__input--select">
            <option>Healthcare worker </option>
            <option>Regional Secretariat </option>
            <option>Regional TBMAC </option>
            <option>Regional Chair </option>
            <option>National TBMAC </option>
            <option>National Chair</option>
          </select>
          <div class="triangle triangle--down"></div>
          <label class="form__label">Role select</label>
        </div>
        <div class="form__button form__button--end"><a class="button" href="">Submit</a></div>
      </form>
    </div>
  </div>
</div>
@endsection

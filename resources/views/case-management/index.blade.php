@extends('layouts.app')

@section('title', 'Enrollment')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
@include('partials.sidebar')

<div class="section">
  <div class="section__top">
      <h1 class="section__title">Case Management</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Case Management</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
  </div>
  <div class="section__container">
      <a class="button button--create" href="{{url('case-management/create') }}">Create new case</a>
      <div class="alert"><span class="alert__text">New case management created</span><button class="button button--transparent js-hide-alert">CLOSE</button></div>
      <div class="section__content">
      <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">All enrollments</li>
          <li class="tabs__item">For approval (3)</li>
          <li class="tabs__item">For follow up (4)</li>
          <li class="tabs__item">Other suggestion (14)</li>
          <li class="tabs__item">Not for referral (8)</li>
      </ul>
      <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
          <thead>
              <tr>
              <th class="table__head">Case no.</th>
              <th class="table__head">Faculty Code</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr class="table__row js-view" data-href="view-case.html">
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              </tr>
          </tbody>
          </table>
      </div>
      <div class="tabs__details">
          <table class="table table--filter js-table">
          <thead>
              <tr>
              <th class="table__head">Case no.</th>
              <th class="table__head">Faculty Code</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr class="table__row js-view" data-href="view-case.html">
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              </tr>
          </tbody>
          </table>
      </div>
      <div class="tabs__details">
          <table class="table table--filter js-table">
          <thead>
              <tr>
              <th class="table__head">Case no.</th>
              <th class="table__head">Faculty Code</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr class="table__row js-view" data-href="view-case.html">
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              </tr>
          </tbody>
          </table>
      </div>
      <div class="tabs__details">
          <table class="table table--filter js-table">
          <thead>
              <tr>
              <th class="table__head">Case no.</th>
              <th class="table__head">Faculty Code</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr class="table__row js-view" data-href="view-case.html">
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              </tr>
          </tbody>
          </table>
      </div>
      <div class="tabs__details">
          <table class="table table--filter js-table">
          <thead>
              <tr>
              <th class="table__head">Case no.</th>
              <th class="table__head">Faculty Code</th>
              <th class="table__head">Patient</th>
              <th class="table__head">Date</th>
              <th class="table__head">Status</th>
              </tr>
          </thead>
          <tbody>
              <tr class="table__row js-view" data-href="view-case.html">
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              <td class="table__details">sample</td>
              </tr>
          </tbody>
          </table>
      </div>
      </div>
  </div>
  </div>

</div>
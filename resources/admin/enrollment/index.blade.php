@extends('layouts.admin.dashboard')

@section('title', 'Enrollment')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
  @include('includes.sidebar')
  
  <div class="section">
    <div class="section__top">
      <h1 class="section__title">Enrollment</h1>
      <div class="breadcrumbs"><a class="breadcrumbs__link">Enrollment Regimen</a><a class="breadcrumbs__link"></a><a class="breadcrumbs__link"></a></div>
    </div>
    <div class="section__container">
      <a class="button button--create" href="create-enrollment.html">Create new enrollment</a>
      <div class="alert"><span class="alert__text">New case for enrolment created</span><button class="button button--transparent js-hide-alert">CLOSE</button></div>
      <div class="section__content">
        <ul class="tabs__list tabs__list--table">
          <li class="tabs__item tabs__item--current">All enrollments</li>
          <li class="tabs__item">For enrollment (4)</li>
          <li class="tabs__item">Not for enrollment (14)</li>
          <li class="tabs__item">Need further details (8)</li>
          <li class="tabs__item">Not for referral (8)</li>
        </ul>
        <div class="tabs__details tabs__details--active">
          <table class="table table--filter js-table">
            <thead>
              <tr>
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__row js-view" data-href="view-enrollment.html">
                <td class="table__details">sample</td>
                <td class="table__details">sample</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__row js-view" data-href="view-enrollment.html">
                <td class="table__details">sample</td>
                <td class="table__details">sample</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__row js-view" data-href="view-enrollment.html">
                <td class="table__details">sample</td>
                <td class="table__details">sample</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__row js-view" data-href="view-enrollment.html">
                <td class="table__details">sample</td>
                <td class="table__details">sample</td>
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
                <th class="table__head">Presentation No.</th>
                <th class="table__head">Patient Initials</th>
                <th class="table__head">Age</th>
                <th class="table__head">Gender</th>
                <th class="table__head">Drug Susceptibility</th>
                <th class="table__head">Date Submitted to RTB Mac</th>
                <th class="table__head">Status</th>
              </tr>
            </thead>
            <tbody>
              <tr class="table__row js-view" data-href="view-enrollment.html">
                <td class="table__details">sample</td>
                <td class="table__details">sample</td>
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

@extends('layouts.admin.dashboard')

@section('title', 'Treatment outcome')
@section('description', 'Dashboard')

@section('content')
<div class="wrapper">
  @include('includes.sidebar')

<div class="section">
  <div class="section__top">
  <h1 class="section__title">Create new treatment outcome</h1>
  <div class="breadcrumbs"><a class="breadcrumbs__link" href="treatment.html">Treatment outcome</a><a class="breadcrumbs__link">Create new treatment outcome</a><a class="breadcrumbs__link"></a></div>
  </div>
  <div class="section__container">
    <form class="form" id="js-form" action="">
    <div class="form__tab">
      <h2 class="section__heading">Bacteriological results and status</h2>
      <div class="form__container">
        <table class="table table--unset js-table-unset">
          <thead>
            <tr>
              <th class="table__head"></th>
              <th class="table__head">Date collected</th>
              <th class="table__head">Resistance pattern</th>
              <th class="table__head">Method used</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table__row">
              <td class="table__details">Screening 1</td>
              <td class="table__details"><input class="form__input form__input--full" type="date" /></td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__details">Screening 2</td>
              <td class="table__details"><input class="form__input form__input--full" type="date" /></td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form__container">
        <table class="table table--unset js-table-unset">
          <thead>
            <tr>
              <th class="table__head"></th>
              <th class="table__head">Date collected</th>
              <th class="table__head">Resistance pattern</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table__row">
              <td class="table__details">LPA</td>
              <td class="table__details"><input class="form__input form__input--full" type="date" /></td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
            </tr>
            <tr class="table__row">
              <td class="table__details">DST</td>
              <td class="table__details"><input class="form__input form__input--full" type="date" /></td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="form__container">
        <table class="table table--unset js-table-unset js-table-rows">
          <thead>
            <tr>
              <th class="table__head">Month</th>
              <th class="table__head">Date collected</th>
              <th class="table__head">Smear microscopy</th>
              <th class="table__head">TB-LAMP</th>
              <th class="table__head">Culture</th>
            </tr>
          </thead>
          <tbody>
            <tr class="table__row">
              <td class="table__details">1</td>
              <td class="table__details"><input class="form__input form__input--full" type="date" /></td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
              <td class="table__details">
                <div class="form__content">
                  <select class="form__input form__input--select form__input--full">
                    <option> </option>
                    <option> </option>
                  </select>
                  <div class="triangle triangle--down"></div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
        <button class="button button--transparent button--add js-add-row" type="button">Add one more</button>
      </div>
    </div>
      <div class="form__button form__button--space form__button--pagination"><button class="button button--back" type="button">Back</button><button class="button button--next" type="button">Next</button>
    </form>
  </div>
</div>
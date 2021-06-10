@extends('layouts.app')

@section('title', 'Generate Report')
@section('description', 'Generate Report')

@section('additional_styles')
    <link type="text/css" href="{{ asset('assets/app/css/reports.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="section">
        <div class="section__top">
            <div class="section__top-text">
                <h1 class="section__title">Reports</h1>
                <div class="breadcrumbs"><a class="breadcrumbs__link">Reports</a><a class="breadcrumbs__link"></a><a
                        class="breadcrumbs__link"></a></div>
            </div>
            <div class="section__top-menu">
                <input class="section__top-trigger" type="checkbox" />
                <div class="section__top-icon"><span> </span><span> </span><span> </span></div>
                <span class="section__top-popup"><img class="image image--warning" src="src/img/icon-warning.png"
                        alt="warning icon" /><span>Report issue</span></span>
            </div>
        </div>
        <div class="modal" id="reportIssue" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal__background" data-dismiss="modal"></div>
            <div class="modal__container">
                <div class="modal__box">
                    <h2 class="modal__title">Report issue</h2>
                    <p class="modal__text">Please elaborate on the issue encountered,</p>
                    <form class="form form--full">
                        <div class="form__content"><textarea class="form__input form__input--message"
                                placeholder="Enter issue"></textarea><label class="form__label" for="">Report issue</label>
                        </div>
                    </form>
                    <div class="modal__button modal__button--end"><input class="button" type="submit" value="Submit" />
                    </div>
                </div>
            </div>
        </div>
        <div class="section__container">
            <form class="form" action="">
                <ul class="card card--reverse">
                    <li class="card__item">
                        <div class="grid grid--two">
                            <h2 class="section__heading">Period</h2>
                            <h2 class="section__heading">Location</h2>
                        </div>
                        <div class="grid grid--two grid--start">
                            <div class="grid grid--column">
                                <ul class="form__group form__group--reports">
                                    <li class="form__group-item">
                                        <label class="form__sublabel" for="period">Quarterly
                                            <input class="form__trigger" type="radio" name="period" {{ request()->has('period') ? (request('period') == 'quarterly' ? 'checked' : '') : 'checked' }} value="quarterly"/>
                                            <span class="form__radio"></span>
                                        </label>
                                    </li>
                                    <li class="form__group-item">
                                        <label class="form__sublabel" for="period">Monthly
                                            <input class="form__trigger"
                                                type="radio" name="period" {{ request('period') == 'monthly' ? 'checked' : '' }} value="monthly" /><span class="form__radio"></span></label>
                                    </li>
                                    <li class="form__group-item">
                                        <label class="form__sublabel" for="period">Annual
                                            <input class="form__trigger"
                                                type="radio" name="period" value="annual" /><span class="form__radio"></span></label>
                                    </li>
                                </ul>
                                <div class="grid grid--two grid--full grid--start">
                                    <div class="form__content">
                                        <select class="form__input form__input--select js-year" name="year"></select>
                                        <div class="triangle triangle--down"></div>
                                        <label class="form__label" for="">Year</label>
                                    </div>
                                    <input type="hidden" id="selected_period" value="{{ request('period') }}"> 
                                    <div class="form__content" id="year_month_div">
                                        <select class="form__input form__input--select" id="quarterly_dropdown" name="quarter">
                                            <option {{ request('quarter') == '1st Quarter' ? 'selected' : '' }}>1st Quarter</option>
                                            <option {{ request('quarter') == '2nd Quarter' ? 'selected' : '' }}>2nd Quarter</option>
                                            <option {{ request('quarter') == '3rd Quarter' ? 'selected' : '' }}>3rd Quarter</option>
                                            <option {{ request('quarter') == '4th Quarter' ? 'selected' : '' }}>4th Quarter</option>
                                        </select>
                                        <select class="form__input form__input--select period" id="monthly_dropdown">
                                            @foreach(months() as $month)
                                                <option {{ request('month') == $month ? 'selected' : '' }}>{{ $month }}</option>
                                            @endforeach
                                        </select>
                                        <div class="triangle triangle--down"></div>
                                        <label class="form__label" for="" id="year_month_label">Quarter</label>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid--half grid--column">
                                <div class="form__content">
                                    <select class="form__input form__input--select" name="province">
                                        @foreach($provinces as $province)
                                            <option>{{ $province }}</option>
                                        @endforeach
                                    </select>
                                    <div class="triangle triangle--down"></div>
                                    <label class="form__label" for="">Province</label>
                                </div>
                                <div class="form__content">
                                    <select class="form__input form__input--select" name="health_facility">
                                        <option>All</option>
                                    </select>
                                    <div class="triangle triangle--down"></div>
                                    <label class="form__label" for="">Health facility</label>
                                </div>
                            </div>
                        </div>
                        <div class="form__button form__button--end">
                            <input class="button" type="submit" value="Apply" />
                        </div>
                    </li>

                    @if(!is_null($report))
                        @include('reports.summary')
                    @endif

                </ul>
            </form>
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/reports/form.js') }}"></script>
    @if(!is_null($report))
        <script src="{{ asset('assets/app/js/report.js') }}"></script>
    @endif
@endsection
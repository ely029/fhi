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
                                                type="radio" name="period" {{ request('period') == 'annual' ? 'checked' : '' }} value="annual" /><span class="form__radio"></span></label>
                                    </li>
                                </ul>
                                <div class="grid grid--two grid--full grid--start">
                                    <div class="form__content">
                                        <select class="form__input form__input--select js-year" name="year"></select>
                                        <div class="triangle triangle--down"></div>
                                        <label class="form__label" for="">Year</label>
                                    </div>
                                    <input type="hidden" id="selected_year" value="{{ request('year') }}">
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
                                    <select class="form__input form__input--select" id="region" name="region">
                                    @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->name1 }}</option>
                                    @endforeach
                                    </select>
                                    <div class="triangle triangle--down"></div>
                                    <label class="form__label" for="">Region</label>
                                </div>
                                <div class="form__content">
                                    <select class="form__input form__input--select" id="province" name="province">
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
                        @include('reports.ntbmac.summary')
                    @endif

                </ul>
            </form>
            @if(!is_null($report))
                <div class="modal" id="submit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal__background" data-dismiss="modal"></div>
                    <div class="modal__container">
                    <div class="modal__box">
                        <h2 class="modal__title" id="modal-title">Submit report</h2>
                        <p class="modal__text" id="modal-text"></p>
                        <form class="form form--full" id="modal-form" method="POST" action="{{ url('/ntbmac/reports/submit') }}">
                            @csrf
                            <div class="form__content">
                                @foreach(\Request::query() as $key => $value)
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                @endforeach
                                @if(in_array(auth()->user()->role_id,[4,5,6]))
                                    <input type="hidden" name="region" value="{{ auth()->user()->region }}">
                                @endif
                                <input type="hidden" name="report_data" value="{{ json_encode($report) }}">
                                <textarea required name="remarks" class="form__input form__input--message" placeholder="Enter remarks"></textarea><label class="form__label" for="">Remarks</label>
                                </div>
                            <div class="modal__button modal__button--end">
                                <button class="button" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('additional_scripts')
    <script src="{{ asset('assets/app/js/reports/form.js') }}"></script>
    <script src="{{ asset('assets/app/js/ntbmac-report.js') }}"></script>
    @if(!is_null($report))
        <script src="{{ asset('assets/app/js/report.js') }}"></script>
    @endif
@endsection
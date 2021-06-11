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
                        @foreach ($reports as $report)
                            <tr class="table__row js-view" data-href="{{ url('reports/'.$report->id) }}">
                                <td class="table__details">{{ $report->report_number }}</td>
                                <td class="table__details">{{ ucfirst($report->period) }}</td>
                                @if($report->period == 'annual')
                                    <td class="table__details">{{ $report->year }}</td>
                                @elseif($report->period == 'quarterly')
                                    <td class="table__details">{{ $report->quarter }}</td>
                                @else
                                    <td class="table__details">{{ $report->month }}</td>
                                @endif
                                <td class="table__details">{{ $report->region }}</td>
                                <td class="table__details">{{ $report->province }}</td>
                                <td class="table__details">{{ $report->health_facility }}</td>
                                <td class="table__details">{{ $report->preparedBy->itis_name }}</td>
                                <td class="table__details">{{ $report->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $reports->links() }}
            </div>
        </div>
    </div>
@endsection

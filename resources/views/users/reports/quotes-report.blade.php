@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Recent Quote Report</h1>
@stop

@section('content')

    <div class="row my-20">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                {{--<div class="col-md-12">
                                    <h4>Recent Quotes</h4>
                                </div>--}}

                                <div class="col-md-12">
                                    <div class="_fd3-table-responsive">
                                        <table class="table table-striped table-bordered tablesorter">
                                            <thead>
                                            <tr>
                                                {{--<th>Email</th>--}}
                                                <th class="sheader">Age
                                                    <a href="{{ route('user.reports.quote') }}?sortby=age&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=age&order=desc" class="descending" title="Descending"></a>
                                                </th>
                                                <th class="sheader">State
                                                    <a href="{{ route('user.reports.quote') }}?sortby=state&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=state&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                                <th class="sheader">Date
                                                    <a href="{{ route('user.reports.quote') }}?sortby=date&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=date&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                                <th class="sheader">Gender
                                                    <a href="{{ route('user.reports.quote') }}?sortby=gender&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=gender&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                                <th class="sheader">Term
                                                    <a href="{{ route('user.reports.quote') }}?sortby=term&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=term&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                                <th class="sheader">Benefit
                                                    <a href="{{ route('user.reports.quote') }}?sortby=benefit&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=benefit&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                                <th>Period

                                                </th>
                                                <th class="sheader">Category
                                                    <a href="{{ route('user.reports.quote') }}?sortby=category&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('user.reports.quote') }}?sortby=category&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($quotes->getCollection()->all() as $quote)

                                                <tr>

{{--                                                    <td>--}}
{{--                                                        <div>--}}
{{--                                                            <span class="font-medium link">{{ $quote->user->email }}</span>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $quote->age }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $quote->state }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $quote->month . '/' . $quote->day . '/' . $quote->year }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                {{ $quote->gender }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                {{ $quote->term }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                ${{ number_format(floatval($quote->benefit) * 1000,2) }}
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                Annually
                                                            </span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                @switch($quote->category)
                                                                    @case(1)
                                                                        Underwritten Term
                                                                    @break;
                                                                    @case(2)
                                                                        Simplified Issue Term
                                                                    @break;
                                                                    @case(4)
                                                                        Final Expense (SIWL)
                                                                    @break;

                                                                @endswitch
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach


                                            </tbody>
                                        </table>

                                        {{ $quotes->appends(request()->except('page'))->links() }}

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>



        </div>
    </div>

    <style>

        .pagination { justify-content: center!important; }

        .group {
            display: block;
        }
        .group.hide {
            display: none;
        }

        .new-group-window {
            display: none;
        }
        .new-group-window.show {
            display:block;
        }
        .center-text {
            text-align: center;
        }
    </style>
@stop
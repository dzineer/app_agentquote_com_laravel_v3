@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Recent Quotes
@endsection

@section('content_header')
    <h1>Reports</h1>
@stop

@section('run_in_header')
    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let user = {!! $user !!};
        let quotes = {!! $quotes !!};
        let pagination = {!! $pagination !!};
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="quotes-table"></div>
                </div>
            </div>
        </div>
    </div>

    {{--<div class="row my-20">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered tablesorter" id="quotes-table">
                                        <thead>
                                        <tr style="position: relative">
                                            @if($user->type_id !== 5)
                                            <th class="sheader">
                                                Affiliate
                                                <a href="{{ route('recent.quotes') }}?sortby=affiliate&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=affiliate&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            @endif
                                            @if($user->type_id !== 5)
                                            <th class="sheader">Agent

                                            </th>
                                            @endif
                                            <th class="sheader">Age
                                                <a href="{{ route('recent.quotes') }}?sortby=age&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=age&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            <th class="sheader">State
                                                <a href="{{ route('recent.quotes') }}?sortby=state&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=state&order=desc" class="descending" title="Descending"></a>

                                            <th class="sheader">Date
                                                <a href="{{ route('recent.quotes') }}?sortby=date&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=date&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            <th class="sheader">Gender
                                                <a href="{{ route('recent.quotes') }}?sortby=gender&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=gender&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            <th class="sheader">Term
                                                <a href="{{ route('recent.quotes') }}?sortby=term&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=term&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            <th class="sheader">Benefit
                                                <a href="{{ route('recent.quotes') }}?sortby=benefit&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=benefit&order=desc" class="descending" title="Descending"></a>
                                            </th>
                                            <!-- <th>Period</th> -->
                                            <th class="sheader">Category
                                                <a href="{{ route('recent.quotes') }}?sortby=category&order=asc" class="ascending" title="Ascending"></a>
                                                <a href="{{ route('recent.quotes') }}?sortby=category&order=desc" class="descending" title="Descending"></a>

                                            </th>
                                            <th>Actions

                                            </th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($quotes->getCollection()->all() as $quote)

                                            <tr>
                                                @if($user->type_id !== 5)
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ $quote->user->affiliate->name }}</span>
                                                    </div>
                                                </td>
                                                @endif
                                                @if($user->type_id !== 5)
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ $quote->user->email }}</span>
                                                    </div>
                                                </td>
                                                @endif
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
                                                <td>
                                                    <a href="#">Delete</a>
                                                </td>
                                            </tr>

                                        @endforeach


                                        </tbody>
                                    </table>


                                </div>
                                <div class="pagination-container">
                                    {{ $quotes->appends(request()->except('page'))->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>--}}

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

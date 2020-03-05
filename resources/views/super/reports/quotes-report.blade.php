@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Recent Quote Report</h1>
@stop

@section('run_in_header')
    <!-- run in header -->

    <!-- ./run in header -->
@endsection

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
                                    <div class="__fd3-table-responsive">

                                        <!--<div class="row">

                                            <div class="col-md-2 my-10">
                                                <select class="form-control" name="affiliates" id="affiliates">
                                                    <option value="0">Filter by Affiliate</option>
                                                    <optgroup label="Affiliates">
                                                        @foreach($affiliates as $affiliate)
                                                            <option value="{{ $affiliate->id }}">{{ $affiliate->name }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="col-md-2 my-10">
                                                <select class="form-control" name="affiliates" id="affiliates">
                                                    <option value="0">Filter by Category</option>
                                                    <optgroup label="Affiliates">
                                                        <?php $categories = [ "Underwritten Term" => 1, "SI Term" => 2, "FE" => 4]; ?>
                                                        @foreach($categories as $category => $value)
                                                            <option value="{{ $value }}">{{ $category }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>

                                        </div>-->

                                        <!-- <div class="row">

                                            <div class="col-md-2 my-10">
                                                <select class="form-control" name="affiliates" id="affiliates">
                                                    <option value="0">Sort by Agent</option>
                                                    <optgroup label="Alphabetically">
                                                        <?php $sorts = [ "A-Z" => 1, "Z-A" => 2]; ?>
                                                        @foreach($sorts as $sort => $value)
                                                            <option value="{{ $value }}">{{ $sort }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="col-md-2 my-10">
                                                <select class="form-control" name="affiliates" id="affiliates">
                                                    <option value="0">Sort by Date</option>
                                                    <optgroup label="Chronological">
                                                        <?php $sorts = [ "Latest" => 1, "Earliest" => 2]; ?>
                                                        @foreach($sorts as $sort => $value)
                                                            <option value="{{ $value }}">{{ $sort }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="col-md-2 my-10">
                                                <select class="form-control" name="affiliates" id="affiliates">
                                                    <option value="0">Sort by Term</option>
                                                    <optgroup label="Terms">
                                                        <?php $sorts = [ 10, 15, 20, 25, 30, 35, 40, 45, 50, 120, 121]; ?>
                                                        @foreach($sorts as $sort)
                                                            <option value="{{ $sort }}">{{ $sort }}</option>
                                                        @endforeach
                                                    </optgroup>
                                                </select>
                                            </div>

                                        </div>-->



                                        <table class="table table-striped table-bordered tablesorter" id="quotes-table">
                                            <thead>
                                            <tr style="position: relative">
                                                <th class="sheader">
                                                    Affiliate
                                                    <a href="{{ route('recent.quotes') }}?sortby=affiliate&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('recent.quotes') }}?sortby=affiliate&order=desc" class="descending" title="Descending"></a>
                                                </th>
                                                <th class="sheader">Agent

                                                </th>
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
                                                <th>Period</th>
                                                <th class="sheader">Category
                                                    <a href="{{ route('recent.quotes') }}?sortby=category&order=asc" class="ascending" title="Ascending"></a>
                                                    <a href="{{ route('recent.quotes') }}?sortby=category&order=desc" class="descending" title="Descending"></a>

                                                </th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($quotes->getCollection()->all() as $quote)

                                                <tr>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $quote->user->affiliate->name }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $quote->user->email }}</span>
                                                        </div>
                                                    </td>

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
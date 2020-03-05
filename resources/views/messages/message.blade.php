@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Recent Quotes
@endsection

@section('content_header')
    <h1>{{ $message->subject }}</h1>
@stop

@section('run_in_header')

@endsection

@section('content')

    <script>
        function deleteMessage(id) {
            document.location.href = '/messages/delete/' + id;
        }
        function acknowledgeMessage(id) {
            document.location.href = '/messages/acknowledge/' + id;
        }
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <button class="btn btn-primary" onclick="deleteMessage({{ $message->id }})">Delete</button>

                    @if(! $message->acknowledged)
                        <button class="btn btn-success" onclick="acknowledgeMessage({{ $message->id }})">Acknowledge</button>
                    @endif

                    <div class="mt-20 mb-2 pb-6" style="border-bottom: 1px solid #d6d6d6">
                    @if($message->acknowledged)
                            Status: <i class="fa fa-check-circle"></i> <span class="ml-0" style="font-style: italic">Acknowledged</span>
                    @else
                            Status: <span class="ml-0" style="font-style: italic">Not Acknowledged</span>
                    @endif
                    </div>

                    <div class="box box-solid">
                        <div class="box-header with-border">
                            {{--<h3>{{ $message->subject }}</h3>--}}
                            <div class="from-container">
                                <div class="message-from-container">
                                    From: {{ $message->originator->name }}
                                </div>
                                <div class="message-date-container">
                                    {{ $message->created_at }}
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">

                                <div class="message-container">

{{--                                    <div class="message-subject">
                                        {{ $message->subject }}
                                    </div>--}}

                                    <div class="message-body">
                                        {!! $message->email !!}
                                    </div>

                                </div>

                        </div>
                        <!-- /.box-body -->
                    </div>

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
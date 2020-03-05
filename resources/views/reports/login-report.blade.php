@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Recent Logins
@endsection

@section('content_header')
    <h1>Login Report</h1>
@stop

@section('content')

    <div class="row my-20">
        <div class="col-md-12">

            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-12">
                                    <h4 class="heading-info mb-4">Login Report</h4>
                                </div>

                                <div class="col-md-12">
                                    <div class="_fd3-table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Group</th>
                                                {{--<th>Event</th>--}}
                                                <th>Date</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($logs->getCollection()->all() as $log)

                                                <tr>
                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $log->user->name }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $log->user->email }}</span>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $log->user->group()->group }}</span>
                                                        </div>
                                                    </td>

                                                    {{--<td>
                                                        <div>
                                                            <span class="font-medium link">{{ $log->event->description }}</span>
                                                        </div>
                                                    </td>--}}

                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">
                                                                {{ \Carbon\Carbon::createFromTimestamp(strtotime($log->created_at))->isoFormat('LLL') }}
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach


                                            </tbody>
                                        </table>

                                        {{ $logs->appends(request()->except('page'))->links() }}

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
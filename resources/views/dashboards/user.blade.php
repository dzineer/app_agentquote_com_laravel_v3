@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Dashboard
@endsection

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')

    <div class="row my-20">
        <div class="col-md-12">


            {{--<div class="row my-20">

                <div class="col-md-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>100</h3>
                            <p>Quotes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <a href="/affiliate/reports/quotes" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

                <div class="col-md-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>3</h3>
                            <p>Reports</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-user"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>--}}

            <div class="row">

                <div class="col-md-4">

                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $quote_count }}</h3>
                            <p>Quotes</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-clipboard"></i>
                        </div>
                        <a href="{{ route('recent.quotes') }}" class="small-box-footer">View <i class="fa fa-arrow-circle-right"></i></a>
                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-md-12 mb-20">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Last Login</h4>
                                </div>


                                <div class="col-md-12">
                                    <div class="_fd3-table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Name</th>

                                                <th>Time</th>
                                            </tr>
                                            </thead>

                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">Current Login</span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ \Carbon\Carbon::createFromTimestamp(strtotime(auth()->user()->login_at))->isoFormat('LLL') }}</span></span>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td>
                                                    <div>
                                                        <span class="font-medium link">Last login</span>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <span class="font-medium link">{{ \Carbon\Carbon::createFromTimestamp(strtotime(auth()->user()->last_login_at))->isoFormat('LLL') }}</span></span>
                                                    </div>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
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
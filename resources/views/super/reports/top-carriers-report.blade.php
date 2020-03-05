@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Top Carriers Report</h1>
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
                                    <h4>Top Carriers</h4>
                                    <p>Top 5 carriers of quote results</p>
                                </div>

                                <div class="col-md-12">
                                    <div class="__fd3-table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                            <tr>
                                                <th>Carrier</th>
                                            </tr>
                                            </thead>

                                            <tbody>

                                            @foreach($top_carriers as $carrier)

                                                <tr>
                                                    <td>
                                                        <div>
                                                            <span class="font-medium link">{{ $carrier }}</span>
                                                        </div>
                                                    </td>

                                                </tr>

                                            @endforeach


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
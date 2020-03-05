@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Top Carriers
@endsection

@section('content_header')
    <h1>Top Carriers Report</h1>
@stop


@section('run_in_header')
    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let user = {!! $user !!};
        let carriers = {!! $carriers !!};
        let pagination = {!! $pagination !!};
        let use_pagination = 0;
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="top-carriers-table"></div>
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
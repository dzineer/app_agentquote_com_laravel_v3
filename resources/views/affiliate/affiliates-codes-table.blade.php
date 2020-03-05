@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Affiliates Codes</h1>
@stop

@section('run_in_header')

    <script>
        $coupons = {!! $coupons !!};
    </script>

@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="affiliates-codes-table" class="users-table"></div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .center-text {
            text-align: center;
        }
    </style>
@stop

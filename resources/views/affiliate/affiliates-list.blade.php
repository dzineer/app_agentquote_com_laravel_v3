@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Affiliates</h1>
@stop

@section('run_in_header')
    <script>
        let user = {!! $user !!};
        let affiliates = {!! $affiliates !!};
        let pagination = {!! $pagination !!}
    </script>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="affiliates-table" class="users-table"></div>

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
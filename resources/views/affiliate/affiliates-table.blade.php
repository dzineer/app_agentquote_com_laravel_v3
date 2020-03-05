@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Affiliates</h1>
@stop

@section('run_in_header')

    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let type_id = {!! $user_type !!};
        let user = {!! $user !!};
        let users = {!! $affiliates !!};
        let pagination = {!! $pagination !!}
    </script>

@endsection

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <script>
                        $(document).ready(function(){
                            $(".dropdown-toggle").dropdown();
                        });
                    </script>

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

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
@stop
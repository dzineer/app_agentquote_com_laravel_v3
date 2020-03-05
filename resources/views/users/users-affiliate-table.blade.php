@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Agents
@stop

@section('content_header')
    <h1>Agents</h1>
@stop

@section('run_in_header')

    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let type_id = {!! $user_type !!};
        let user = {!! $user !!};
        let users = {!! $users !!};
        let affiliates = {!! $affiliates !!};
        let pagination = {!! $pagination !!}

    </script>

    <script>
        $(document).ready(function(){
            $(".dropdown-toggle").dropdown();
        });
    </script>

@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="users-affiliate-table" class="users-table"></div>

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
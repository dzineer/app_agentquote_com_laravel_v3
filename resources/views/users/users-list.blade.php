@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Agents
@endsection

@section('content_header')
    <h1>Agents</h1>
@stop

@section('content')

    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let type_id = {!! $user_type !!};
        let user = {!! $user !!};
        let users = {!! $users !!};
        let groups = {!! $groups !!};
        let pagination = {!! $pagination !!}
    </script>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div id="agents-table" class="users-table"></div>

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
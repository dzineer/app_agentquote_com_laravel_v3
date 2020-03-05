@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Password Security
@endsection

@section('content_header')
    <h1>Change Password</h1>
@stop

@section('run_in_header')
    <script>
        var user_id = {!! $user->id !!};
        var confirmation_token = "{{ $confirmation_token }}";
        // debugger;
    </script>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="force-password"></div>
        </div>
    </div>
@stop

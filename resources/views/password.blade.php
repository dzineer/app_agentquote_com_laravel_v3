@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Password Security
@endsection

@section('content_header')
    <h1>User Settings</h1>
@stop

@section('content')
    <script>
        let user_id = "{{ $user->id }}";
    </script>
    <div class="card">
        <div class="card-body">
            <h4 class="heading-info">Password Security</h4>
            <div id="password"></div>
        </div>
    </div>
@stop

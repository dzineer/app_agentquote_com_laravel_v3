@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Default State
@endsection

@section('content_header')
    <h1>User Settings</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">Default State</h5>
            <div id="profile"></div>
        </div>
    </div>
@stop

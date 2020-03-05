@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Default State
@endsection

@section('content_header')
    <h1>Default State</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="profile"></div>
        </div>
    </div>
@stop
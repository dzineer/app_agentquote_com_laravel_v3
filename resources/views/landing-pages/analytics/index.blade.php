@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Analytics
@endsection

@section('content_header')
    <h1>Landing Page Analytics</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">Settings</h5>
            <div id="landing-page-analytics"></div>
        </div>
    </div>
@stop

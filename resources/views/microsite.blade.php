@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>Microsite Settings</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <div id="microsite"></div>
        </div>
    </div>
@stop
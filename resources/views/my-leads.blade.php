@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>My Leads</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body __fd3-table-responsive">
            <div id="leads"></div>
        </div>
    </div>
@stop

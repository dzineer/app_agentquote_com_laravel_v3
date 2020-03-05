@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>My Contacts</h1>
@stop

@section('content')

    <div class="card">
        <div class="card-body __fd3-table-responsive">
            <div id="contacts"></div>
        </div>
    </div>
@stop

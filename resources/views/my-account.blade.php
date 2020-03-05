@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Account Settings
@endsection

@section('content_header')
    <h1>User Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="heading-info">Account Settings</h4>
                    <div id="account"></div>
                </div>
            </div>
        </div>
    </div>

@stop

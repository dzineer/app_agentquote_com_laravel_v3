@extends('adminlte::page')

@section('title')
    Custom Modules
@endsection

@section('content_header')
    <h1>Module Config</h1>
@stop

@section('content')

    <script>

        customModule = {!! $customModuleData !!}
        domains = {!! $domains !!}

    </script>

    <div class="card">
        <div class="card-body">
            <h5 class="heading-info">{{ $customModule->module->name }}</h5>

            <div class="row">
                <div class="col-md-12">
                    <div id="termlife-settings-edit" class="p-x-20"></div>
                </div>
            </div>
        </div>
    </div>

@stop




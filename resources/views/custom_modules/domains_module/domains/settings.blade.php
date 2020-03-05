@extends('adminlte::page')

@section('title')
    Domains
@endsection

@section('content_header')
    <h1>Domains</h1>
@stop

@section('run_in_header')
    <script>
        // debugger;
        customModule = {!! $customModuleData !!};
        domains = {!! $domains !!};
        // debugger;
        pagination = {!! $pagination !!}
        url = "{!! $url !!}";
    </script>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">

            <div id="user-domains"></div>

        </div>
    </div>

@stop




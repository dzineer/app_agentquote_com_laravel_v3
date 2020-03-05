@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }}
@endsection

@section('content_header')
    <h1>My Messages</h1>
@stop

@section('local_scripts')
    @if ($messages)
    <script>
        var data = '<?php echo $messages ?>';
        var messages = JSON.parse(data);
        console.log(messages);
    </script>
    @endif
@stop

@section('content')

    <div class="card">
        <div class="card-body __fd3-table-responsive">
            <div id="messages"></div>
        </div>
    </div>
@stop

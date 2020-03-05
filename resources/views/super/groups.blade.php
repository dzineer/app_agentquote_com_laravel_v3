@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Groups
@endsection

@section('content_header')
    <h1>{{ $page['header'] }}</h1>
@stop

@section('content')
    <script>
        let affiliate_id = {!! $affiliate_id !!};
        let groups = {!! $groups !!};
    </script>
    <div class="row">

        <div id="affiliate-groups-panel" class="responsive-table"></div>

    </div>

    <style>
        .responsive-table {
            width: 100%;
        }
        .responsive-input {
            width: 100%;
        }
    </style>



@stop

@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Quoter
@endsection

@section('content_header')
    <h1>Quoter</h1>
@stop

@section('js')
    <script>
    var acct = {!! $acct !!};
    var ads = {!! $ads !!};
    </script>
@stop

@section('content')
    <div id="quoter-container">
        <div id="ad-container"></div>
    </div>
@stop

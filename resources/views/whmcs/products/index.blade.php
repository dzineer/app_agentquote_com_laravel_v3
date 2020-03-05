@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: WHMCS Products
@endsection

@section('content_header')
    <h1>WHMCS Products</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12">

                            <div id="whmcs-products"></div>

                        </div> <!-- ./col-md-12 -->

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>

    </style>

    <script>

    </script>

@stop

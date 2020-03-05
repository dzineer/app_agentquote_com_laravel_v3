@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Dashboard
@endsection


@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>General Setup</h3>
                    <iframe src="https://player.vimeo.com/video/317978590" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <a href="https://store.agentquoter.com/aqmeeting/signup" style="display: inline-block" target="_blank"><img src="https://aqmeeting.com/assets/images/aqmeeting-logo.png" border="0" ></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>Product Input</h3>
                    <iframe src="https://player.vimeo.com/video/317978934" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <br/>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>FE</h3>
                    <iframe src="https://player.vimeo.com/video/317984214" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>SI Term</h3>
                    <iframe src="https://player.vimeo.com/video/317985649" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    {{--<div id="pricing-table"></div>--}}
                    <h3>Term Life</h3>
                    <iframe src="https://player.vimeo.com/video/317986659" width="100%" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- Start of aq2e Zendesk Widget script -->
    {{--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=a5d9b156-cd66-4af4-a435-3bc59e30620e"> </script>--}}
    <!-- End of aq2e Zendesk Widget script -->
@stop
@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Dashboard
@endsection

@section('content_header')
    <h1>Videos</h1>
@stop

@section('content')
    <div id="VideoSearchBar"></div>

    <style>

        .main-section-header {
            position: relative;
            padding: 15px 15px 0px !important;
            color: #3c8dbc!important;
        }

        .main-section-sub-header {
            position: relative;
            padding: 0 15px!important;
            color: #3c8dbc!important;
        }

        .search {
            padding: 6px 15px 6px 12px;
            margin: 3px;
            width: 98%;
        }

        .end-of-input-icon {
            margin: 0 -45px;
        }

        .search:after {
            content: "\f002";
        }

        .lighter {
            width: 95%;
            height: 90px;
            padding: 1px 25px 40px;
            margin: 0 auto;

        }
        .rounded {
            border-radius: 50px !important;
            -moz-border-radius: 50px !important;
            -webkit-border-radius: 50px !important;
        }
        .lighter input[type=text] {
            border: 1px solid #adc5cf;
            background-color: #fcfcfc;
        }

        .lighter input[type=text] {
            color: #bcbcbc;
        }

        .lighter input[type=button], .lighter input[type=button]:hover {
            position: relative;
            left: -6px;
            border: 1px solid #adc5cf;

            background: #e4f1f9;
            background: -moz-linear-gradient(top, #e4f1f9 0%, #d5e7f3 100%);
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #e4f1f9), color-stop(100%, #d5e7f3));
            background: -webkit-linear-gradient(top, #e4f1f9 0%, #d5e7f3 100%);
            background: -o-linear-gradient(top, #e4f1f9 0%, #d5e7f3 100%);
            background: -ms-linear-gradient(top, #e4f1f9 0%, #d5e7f3 100%);
            background: linear-gradient(top, #e4f1f9 0%, #d5e7f3 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#e4f1f9', endColorStr='#d5e7f3', GradientType=0);
            color: #7da2aa;
            cursor: pointer;
        }
    </style>

    <div id="video-search-container"></div>


    <!-- Start of aq2e Zendesk Widget script -->
    {{--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=a5d9b156-cd66-4af4-a435-3bc59e30620e"> </script>--}}
    <!-- End of aq2e Zendesk Widget script -->
@stop
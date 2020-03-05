@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Support
@endsection

@section('content_header')
    <h1>Support</h1>
@stop

@section('content')
    <div class="row">

        <div class="col-md-3">

        </div>

        <div class="col-md-6">

            <div class="" style="text-align: center">
                <h2 class="header main-section-header">Welcome to AgentQuoter Support</h2>
                <p class="header main-section-sub-header">Check out the categories below for answers to some of
                    our most common support questions</p>
            </div>

{{--            <div class="lighter">
                <div style="width: 80%;margin: 10px auto;text-align: center;margin-left: 35px;">
                    <input type="text" class="search rounded" placeholder="Search">
                    <span class="end-of-input-icon"><i class="fa fa-search fa-fw"></i></span>
                </div>
            </div>--}}

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

        </div>

        <div class="col-md-3">

        </div>

        <div class="col-md-3">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>Videos</h3>
                    <a href="/videos" target="_self">
                        <span style="font-size: 6em"><i class="fa fa-video-camera" aria-hidden="true"></i></span>
                    </a>
                </div>
            </div>
        </div>

{{--        <div class="col-md-3">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>Guides</h3>
                    <a href="/guides" target="_self">
                        <span style="font-size: 6em"><i class="fa fa-clipboard" aria-hidden="true"></i></span>
                    </a>
                </div>
            </div>
        </div>--}}

{{--        <div class="col-md-3">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>Knowledge Base</h3>
                    <a href="https://aq2e.zendesk.com/hc/en-us/categories/200083429-AQ2E-SET-UP-and-FAQ-s" target="_blank">
                        <span style="font-size: 6em"><i class="fa fa-book" aria-hidden="true"></i></span>
                    </a>
                </div>
            </div>
        </div>--}}


        {{--<div class="col-md-3">
            <div class="card">
                <div class="card-body" style="text-align: center">
                    <h3>Submit a Ticket</h3>
                    <a href="https://aq2e.zendesk.com/hc/en-us/requests/new" target="_blank">
                        <span style="font-size: 6em"><i class="fa fa-life-ring" aria-hidden="true"></i></span>
                    </a>
                </div>
            </div>
        </div>--}}
    </div>


    <!-- Start of aq2e Zendesk Widget script -->
    {{--<script id="ze-snippet" src="https://static.zdassets.com/ekr/snippet.js?key=a5d9b156-cd66-4af4-a435-3bc59e30620e"> </script>--}}
    <!-- End of aq2e Zendesk Widget script -->
@stop
@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Ad
@endsection

@section('content_header')
    <h1>{{ $page['header'] }}</h1>
@stop

@section('content')
    <script>
        let ad = {!! $adString !!};
        let carriers = {!! $carriersString !!};
        let url = {!! $url !!};
    </script>
    <div class="row">
        <div class="col-md-12">
            <div class="card">\
                <div class="card-body">

                    <div class="content-container">

                        <div id="category-ad"></div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>

    </script>

    <style>
        .text-link {
            font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
            text-decoration: underline;
        }

        .content-container {
            padding: 1.2rem
        }

        .header-sp {
            margin-top: 1em;
            margin-bottom: 1em;
        }

        .form-check {
            background: #f9f9f9;
            margin-bottom: 10px;
        }
        .form-check-label {
            padding: 22px !important;
            width: 100% !important;
            display: inline-block !important;
            max-width: 100% !important;
            margin-bottom: 0 !important;
            font-weight: bold !important;
        }
    </style>



@stop

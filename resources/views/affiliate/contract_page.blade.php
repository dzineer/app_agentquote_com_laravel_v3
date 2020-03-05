@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Ad
@endsection

@section('content_header')
    <h1>{{ $page['header'] }}</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">

                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="ad">{{ $labels['contract_page_label'] }}</label>
                                <textarea class="form-control p-4" rows="1" id="contract_page_link" maxlength="100" required></textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3" value=" {{ $labels['save_button_text'] }} ">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
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

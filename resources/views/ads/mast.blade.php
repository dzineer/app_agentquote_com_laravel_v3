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

                    <div class="content-container">

                        <div class="row">

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3" value=" {{ $labels['save_button_text'] }} ">
                            </div>

                            <div class="col-md-12">
                                <h4 class="header-sp">{{ $labels['preferred_carrier_label'] }}</h4>
                            </div>

                            @foreach($carriers as $carrier)
                                <div class="col-md-6">

                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input carriers" type="radio" id="carrier_{{$carrier->company_id}}" name="carrier_4" value="{{$carrier->company_id}}" data-checked="{{ $carrier->selected }}" checked="{{ $carrier->selected === 1 ? 'checked' : '' }}}}" data-products="carrier_products_{{$carrier->company_id}}">
                                            {{$carrier->name}}
                                        </label>

                                    </div> <!-- ./form-check -->

                                </div> <!-- ./col-md-12 -->
                            @endforeach

                            <div class="col-md-12">
                                <h4 class="header-sp">{{ $labels['running_ad_label'] }}</h4>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ad">{{ $labels['ad_label'] }}</label>
                                    <textarea class="form-control p-4" rows="1" id="ad" maxlength="100" required></textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="ad">URL Link (optional)</label>
                                    <textarea class="form-control p-4" rows="1" id="ad_link" maxlength="100" required></textarea>
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
    </div>

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

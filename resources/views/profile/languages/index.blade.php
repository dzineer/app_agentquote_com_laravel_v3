@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Profile :: Language
@endsection

@section('content_header')
    <h1>Profile Language Settings</h1>
@stop

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="heading-info mb-4">Choose Your Languages</h4>
                    <div class="row">

                        <form role="form" class="display-block" action="/profile/language/usettings" method="POST">

                            <input type="hidden" name="_method" value="PUT" />
                            {{ csrf_field() }}
{{--                            <div class="col-md-12">

                                <div class="form-check">

                                    <label class="form-check-label">
                                        <input class="form-check-input checkall-carriers" type="checkbox" id="carrier-check-all">

                                                                                <span id="select-all-label">Deselect All Carriers</span>

                                    </label>
                                </div> <!-- ./form-check -->

                            </div> <!-- ./col-md-12 -->
--}}

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3" value=" Save ">
                            </div>

                            @foreach($languages as $language)
                                <div class="col-md-12">

                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input languages" type="checkbox" id="language_{{$language->language_id}}" name="languages[]" value="{{$language->language_id}}" {{ $language->selected == 1 ? 'checked="checked"' : '' }} >
                                            @if($language->subtag)
                                                {{ $language->name . ' ' . '(' . strtoupper($language->subtag) . ')' }}
                                            @else
                                                {{ $language->name }}
                                            @endif
                                        </label>

                                    </div> <!-- ./form-check -->

                                </div> <!-- ./col-md-12 -->
                            @endforeach

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3" value=" Save ">
                            </div>

                        </form>

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

    @if (isset($message))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.success( '{{ $message }}' );
            });
        </script>
    @endif

@stop

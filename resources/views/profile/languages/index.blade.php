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

                        <form role="form" class="display-block" action="/carriers/termlife/settings" method="POST">

                            <input type="hidden" name="_method" value="PUT" />
                            {{ csrf_field() }}
                            <div class="col-md-12">

                                <div class="form-check">

                                    <label class="form-check-label">
                                        <input class="form-check-input checkall-carriers" type="checkbox" id="carrier-check-all">
                                        {{--
                                                                                <span id="select-all-label">Deselect All Carriers</span>
                                        --}}
                                    </label>
                                </div> <!-- ./form-check -->

                            </div> <!-- ./col-md-12 -->

                            <div class="col-md-12">
                                <input type="submit" class="btn btn-primary btn-lg btn-block btn-huge control update-btn mt-3 mb-3" value=" Save ">
                            </div>

                            @foreach($languages as $language)
                                <div class="col-md-12">

                                    <div class="form-check">

                                        <label class="form-check-label">
                                            <input class="form-check-input carriers" type="checkbox" id="language_{{$language->language_id}}" name="language_{{$language->language_id}}" value="{{$language->language_id}}" {{ $language->selected == 1 ? 'checked="checked"' : '' }} data-languages="language_{{$language->language_id}}">
                                            <input type="hidden" id="hidden_language__{{$language->language_id}}"  name="hidden_carrier__{{$language->language_id}}" value="{{ $language->selected == 1 ? $language->language_id : '' }}">
                                            {{ $language->name . $language->subtag ? ' (' . strtoupper($language->subtag) . ')': '' }}
                                        </label>

                                        <div class="collapse carrier-products" id="language_{{$language->language_id}}" data-carrier="language_{{$language->language_id}}">

                                        </div>
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

    <script>

        jQuery(function() {

        });

        (function( options ) {
            var $ = {
                libs: typeof options.libs !== 'undefined' ? options.libs : {},
                checkAll: typeof options.checkAll !== 'undefined' ? options.checkAll : '',
                checkboxes: typeof options.checkboxes !== 'undefined' ? options.checkboxes : '',
                labels: typeof options.labels !== 'undefined' ? options.labels : '',
                checkAllLabel: typeof options.checkAllLabel !== 'undefined' ? options.checkAllLabel : '',
                checkAllInst: '',
                checkBoxesInst: '',
                labelInst: '',
                allChecked: true,
                fn: (function() {
                    return {
                        init: function() {
                            $.checkAllInst = $.libs.jq( $.checkAll );
                            $.labelInst = $.libs.jq( $.checkAllLabel );
                            $.checkBoxesInst = $.libs.jq( $.checkboxes );

                            $.libs.jq(document).on('click', options.checkAll, $.fn.onClick);

                            $.checkBoxesInst.each( function( index, obj) {
                                $.libs.jq(this).on("click", function() {
                                    var val = $.libs.jq(this).val();
                                    var hidden_field = $.libs.jq("#hidden_language__" + val);
                                    console.log(val);
                                    if ($.libs.jq(this)[0].checked) {
                                        hidden_field.val(0);
                                        $.libs.jq(this).attr('checked', true);
                                    } else {
                                        hidden_field.val(val);
                                        $.libs.jq(this).attr('checked', false);
                                    }
                                });

                                if (! this.checked ) { // if any of the checkboxes are not checked then we know that checkall should not be checked yet
                                    console.log(obj);
                                    $.allChecked = false;
                                }
                            });

                            if ( $.allChecked ) {
                                $.checkAllInst.attr("checked", "checked");
                                $.labelInst.html( $.labels.on );
                            }
                            else {
                                $.labelInst.html( $.labels.off );
                            }
                        },
                        onClick: function( e ) {
                            if (!this.checked) { // all is selected so if clicked deselect all
                                $.checkBoxesInst.each( function( index, obj ) {
                                    this.removeAttribute("checked");
                                    $.labelInst.html( $.labels.on );
                                });
                            }
                            else {
                                $.checkBoxesInst.each( function( index, obj ) {
                                    this.setAttribute("checked", "checked");
                                    $.labelInst.html( $.labels.off );
                                });
                            }
                        }
                    }
                }())
            };

            $.fn.init();

        }(
            {
                'libs': { jq: jQuery },
                'checkAll': '#language-check-all',
                'checkboxes': '.languages:checkbox',
                'checkAllLabel': '#select-all-label',
                'labels': {
                    'on' : 'Deselect All Languages',
                    'off': 'Select All Languages'
                }
            }
        ))
    </script>

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

@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Carriers
@endsection

@section('content_header')
    <h1>Carriers Settings</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4>Choose Your Carriers</h4>
                    <div class="row">

                        <div class="col-md-12">

                            <div class="form-check">

                                <label class="form-check-label">
                                    <input class="form-check-input checkall-carriers" type="checkbox" id="carrier-check-all">
                                    <span id="select-all-label">Deselect All Carriers</span>                                                                   </label>

                                <div class="collapse carrier-products" id="carrier_products_4" data-carrier="carrier_4">

                                </div>
                            </div> <!-- ./form-check -->

                        </div> <!-- ./col-md-12 -->

                        @foreach($carriers as $carrier)
                            <div class="col-md-12">

                                <div class="form-check">

                                    <label class="form-check-label">
                                        <input class="form-check-input carriers" type="checkbox" id="carrier_4" name="carrier_4" value="{{$carrier->company_id}}" data-checked="{{ $carrier->selected }}" checked="{{ $carrier->selected === 1 ? 'checked' : '' }}}}" data-products="carrier_products_{{$carrier->company_id}}">
                                        <input type="hidden" name="hidden_carrier__4" value="{{$carrier->company_id}}">
                                        {{$carrier->name}}
                                    </label>

                                    <div class="collapse carrier-products" id="carrier_products_{{$carrier->company_id}}" data-carrier="carrier_{{$carrier->company_id}}">

                                    </div>
                                </div> <!-- ./form-check -->

                            </div> <!-- ./col-md-12 -->
                        @endforeach



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
                                if (! this.checked ) { // if any of the checkboxes are not checked then we know that checkall should not be checked yet
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
                'checkAll': '#carrier-check-all',
                'checkboxes': '.carriers:checkbox',
                'checkAllLabel': '#select-all-label',
                'labels': {
                    'on' : 'Deselect All Carriers',
                    'off': 'Select All Carriers'
                }
            }
        ))
    </script>

@stop
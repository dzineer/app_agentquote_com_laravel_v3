<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Landing Page 2 Responsive containers</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('bootstrap-4.3.1/dist/css/bootstrap.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('fontawesome/css/font-awesome.min.css') }}" />

</head>

<!--  live-server -port=3000 -entry-file=’./index.html’ -->

<body>

<div class="background">

    <div class="container-fluid no-gutters">
        <div id="quote-content-page">
            <div id="main-content-container">

                <div class="form" id="term-life-widget"></div>

                <div id="info-container">
                    {{--<div id="support-widget" class="support"></div>--}}
                    {{--<div id="faq-widget" class="faq"></div>--}}
                </div>

            </div>
        </div>

    </div>

    <footer class="footer">
        <div class="footer-container"></div>
    </footer>

</div>

<script>
    FD3EventsRouter = (function() {

        let $ = {
            data: {
                events: [],
            },
            fn: (function() {
                return {

                    init: function() {
                        window.addEventListener("message", $.fn.dispatcher.bind(this), false);
                    },

                    on( event, listener ) {
                        if( ! $.data.events[ event ] ) {
                            if ( typeof $.data.events[event]  === "undefined" ) {
                                $.data.events[ event ] = [];
                            }
                            $.data.events[ event ].push( listener );
                        }
                    },

                    off(event) {
                        if( ! $.data.events[event] ) {
                            delete $.data.events[ event ];
                        }
                    },

                    emit(name, ...payload) {
                        window.postMessage({ event: name, data: payload}, "*");
                    },

                    dispatcher(event) {
                        if (typeof $.data.events[ event.data.event ] !== "undefined") {
                            for ( const listener of $.data.events[ event.data.event ] ) {
                            // debugger;
                                listener.apply(this, event.data.data );
                            }
                        }
                    }
                }
            }())
        };

        $.fn.init();

        return {
            on: $.fn.on,
            off: $.fn.off,
            emit: $.fn.emit
        };

    }());



</script>

<script>
    statesArray = [
        /*{
            "name": "Alabama",
            "abbr": "AL"
        },
        {
            "name": "Alaska",
            "abbr": "AK"
        },
        {
            "name": "Arizona",
            "abbr": "AZ"
        },
        {
            "name": "Arkansas",
            "abbr": "AR"
        },*/
        {
            "name": "California",
            "abbr": "CA"
        }
        /*,
        {
            "name": "Colorado",
            "abbr": "CO"
        },
        {
            "name": "Connecticut",
            "abbr": "CT"
        },
        {
            "name": "Delaware",
            "abbr": "DE"
        },
        {
            "name": "District Of Columbia",
            "abbr": "DC"
        },
        {
            "name": "Federated States Of Micronesia",
            "abbr": "FM"
        },
        {
            "name": "Florida",
            "abbr": "FL"
        },
        {
            "name": "Georgia",
            "abbr": "GA"
        },
        {
            "name": "Guam",
            "abbr": "GU"
        },
        {
            "name": "Hawaii",
            "abbr": "HI"
        },
        {
            "name": "Idaho",
            "abbr": "ID"
        },
        {
            "name": "Illinois",
            "abbr": "IL"
        },
        {
            "name": "Indiana",
            "abbr": "IN"
        },
        {
            "name": "Iowa",
            "abbr": "IA"
        },
        {
            "name": "Kansas",
            "abbr": "KS"
        },
        {
            "name": "Kentucky",
            "abbr": "KY"
        },
        {
            "name": "Louisiana",
            "abbr": "LA"
        },
        {
            "name": "Maine",
            "abbr": "ME"
        },
        {
            "name": "Maryland",
            "abbr": "MD"
        },
        {
            "name": "Massachusetts",
            "abbr": "MA"
        },
        {
            "name": "Michigan",
            "abbr": "MI"
        },
        {
            "name": "Minnesota",
            "abbr": "MN"
        },
        {
            "name": "Mississippi",
            "abbr": "MS"
        },
        {
            "name": "Missouri",
            "abbr": "MO"
        },
        {
            "name": "Montana",
            "abbr": "MT"
        },
        {
            "name": "Nebraska",
            "abbr": "NE"
        },
        {
            "name": "Nevada",
            "abbr": "NV"
        },
        {
            "name": "New Hampshire",
            "abbr": "NH"
        },
        {
            "name": "New Jersey",
            "abbr": "NJ"
        },
        {
            "name": "New Mexico",
            "abbr": "NM"
        },
        {
            "name": "New York",
            "abbr": "NY"
        },
        {
            "name": "North Carolina",
            "abbr": "NC"
        },
        {
            "name": "North Dakota",
            "abbr": "ND"
        },
        {
            "name": "Northern Mariana Islands",
            "abbr": "MP"
        },
        {
            "name": "Ohio",
            "abbr": "OH"
        },
        {
            "name": "Oklahoma",
            "abbr": "OK"
        },
        {
            "name": "Oregon",
            "abbr": "OR"
        },
        {
            "name": "Pennsylvania",
            "abbr": "PA"
        },
        {
            "name": "Puerto Rico",
            "abbr": "PR"
        },
        {
            "name": "Rhode Island",
            "abbr": "RI"
        },
        {
            "name": "South Carolina",
            "abbr": "SC"
        },
        {
            "name": "South Dakota",
            "abbr": "SD"
        },
        {
            "name": "Tennessee",
            "abbr": "TN"
        },
        {
            "name": "Texas",
            "abbr": "TX"
        },
        {
            "name": "Utah",
            "abbr": "UT"
        },
        {
            "name": "Vermont",
            "abbr": "VT"
        },
        {
            "name": "Virgin Islands",
            "abbr": "VI"
        },
        {
            "name": "Virginia",
            "abbr": "VA"
        },
        {
            "name": "Washington",
            "abbr": "WA"
        },
        {
            "name": "West Virginia",
            "abbr": "WV"
        },
        {
            "name": "Wisconsin",
            "abbr": "WI"
        },
        { "name": "Wyoming", "abbr": "WY" }*/
    ];
</script>
<script>
    user_default_state = 'CA';
    UserId = 5;
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>

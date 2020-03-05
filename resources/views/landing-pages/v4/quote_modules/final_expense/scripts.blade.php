
<!-- Java script-->
<script src="{{ asset_prepend('templates/landing-pages/v1/', 'js/core.min.js') }}"></script>
<script src="{{ asset_prepend('templates/landing-pages/v1/', 'js/script.js') }}"></script>

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
        {
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
        },
        {
            "name": "California",
            "abbr": "CA"
        }
        ,
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
        { "name": "Wyoming", "abbr": "WY" }
    ];
</script>
<script>
    user_default_state = "{{ $selected_state }}";
    UserId = {!! $user['id'] !!};
    const user_id = {!! $user['id'] !!};
    const social_media_icons = {!! $social_media !!};
</script>


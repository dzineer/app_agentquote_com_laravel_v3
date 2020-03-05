/**
 * Custom Modules: Communications
 * */

// This is the Sending & Receiving Module (GLOBAL)
(function(args) {
    let $ = {
        fn:
            (function() {
                return {
                    init: function() {
                        $.data.module.run( $.fn.send );
                    },
                    send: function( method, moduleName, fd, cb ) {

                       $.data.callback = cb;
                       const allowedMethod = $.data.module.getMethod();

                       if ( method === allowedMethod ) {

                           switch( method ) {
                               case 'GET':
                                   return $.fn.get( moduleName, fd, cb );
                           }

                       }

                    },
                    arrayToStringValuePair: function( obj ) {
                        var arr = [];
                        var first = true;
                        for (var key in obj) {
                            if (obj.hasOwnProperty(key)) {
                                arr.push(key + '=' + obj[key]);
                            }
                        };
                        var result = "?" + arr.join(',');
                        return result;
                    },
                    get: function ( moduleName, fields, cb ) {

                        let params = $.fn.arrayToStringValuePair( fields );

                        let url = $.data.module_url + moduleName + params;

                        axios.get(url).then( res => {
                            console.log(res);
                            if (res.statusText === "OK") {
                                return $.data.callback( res.data );
                            }
                        });

                    }
                }
            })(),
        data: {
            module_url: '/m/mod/',
            module: args.module
        }
    };

    $.fn.init();

})( { module: {{ $action_module_name }} } );

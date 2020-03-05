/**
 * Custom Module: Test
 * */

// This module will handle itself (Client Module)
let {{ $custom_module }} =
        (function( params ) {
            let $ = {
                fn:
                    (function() {
                        return {
                            run: function( send, fields ) {
                                $.data.callbacks.send = send;
                                $.data.fields = fields;
                                console.log($.data.fields.id);
                                let data = [];

                                data[ 'id' ] = $.data.fields.id;

                                // method, moduleName, fd, cb
                                $.data.callbacks.send( data, $.fn.render );
                            },
                            render: function ( data ) {
                                console.log( data );
                            }

                        }
                    })(),
                data: {
                    moduleName: params.moduleName,
                    callbacks: {},
                    params: params,
                    fields: params.fields,
                }
            };

            return {
                run: $.fn.run,
            }

        })({
            fields: {},
            moduleName: '{{ $module_name }}'
        });

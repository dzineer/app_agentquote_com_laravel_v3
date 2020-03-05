
/**
 * Custom Modules
 * */

// This is the Render Module (GLOBAL MODULE)
let {{ $action_module_name }} =
    (function( params ) {
        let $ = {
            fn:
                (function() {
                    return {
                        run: function( send ) {
                            $.data.callbacks.send = send;
                            $.data.module.run( $.fn.send, $.data.fields );
                        },
                        send: function ( fields, cb ) {
                            $.data.callback = cb;
                            $.data.callbacks.send( $.data.method, $.data.moduleName , fields, $.data.callback );
                        },
                        getMethod: function () {
                            return $.data.method;
                        }

                    }
                })(),
            data: {
                method: 'GET',
                moduleName: params.moduleName,
                module: params.module,
                params: params,
                fields: params.fields,
                callbacks: {}
            }
        };

        return {
            run: $.fn.run,
            getMethod: $.fn.getMethod,
        }

    })({
        fields: {!! $fields !!},
        moduleName: '{{ $module_name }}',
        module: {{ $custom_module }}
    });

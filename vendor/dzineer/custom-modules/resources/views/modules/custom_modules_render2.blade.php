<script>
/**
 * Custom Modules
 * Script: custom_modules_render.js
 *
 * */

// This module will handle itself (Client Module)
render_custom_module =
    (function( params ) {
        let $ = {
            fn:
                (function() {
                    return {
                        run: function( send, fields ) {
                            $.data.callbacks.send = send;
                            $.data.fields = fields;
                            console.log($.data.fields.id);
                            let fd = new FormData();
                            fd.append("id" , $.data.fields.id);
                            $.data.callbacks.send( fd, $.fn.render );
                        },
                        render: function () {
                            console.log('I am now rendering');
                        }

                    }
                })(),
            data: {
                moduleName: params.moduleName,
                callbacks: {},
                params: params,
                fields: params.fields,
                methods: {

                    GET: [
                        'id',
                    ],
                }
            }
        };

        return $.fn;
    })({
        fields: {
            id: 1
        },
        moduleName: 'Test'
    });

// This is the Render Module (GLOBAL MODULE)
render_module =
    (function( params ) {
        let $ = {
            fn:
                (function() {
                    return {
                        run: function( save ) {
                            $.data.callbacks.save = save;
                            $.data.module.run( save, $.data.fields );
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
                fields: params.fields
            }
        };

        return {
            getMethod: $.fn.getMethod
        }

    })({
        fields: {
            fname: 'Frank',
            lname: 'Decker'
        },
        moduleName: 'Test',
        module: render_custom_module
    });

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
                    get: function ( moduleName, fd, cb ) {

                        axios.get(url, fd).then( res => {
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

})( { module: render_module } );
</script>
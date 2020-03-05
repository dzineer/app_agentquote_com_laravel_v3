<script>
/**
 * Custom Modules
 *
 * */

let edit_module =
    (function() {
        let $ = {
            fn:
                (function() {
                    return {
                        run: function() {

                        },

                    }
                })(),
            data: {
                methods: {

                    GET: [
                        'id',
                    ],
                }
            }
        };

        return $;
    })();


(function(args) {
    let $ = {
        fn:
            (function() {
                return {
                    init: function() {
                        alert('loaded');
                    },
                    send: function() {

                    }
                }
            })(),
        data: {
            module: args.module
        }
    };

    $.fn.init();

})( { module: $edit_module } );
</script>
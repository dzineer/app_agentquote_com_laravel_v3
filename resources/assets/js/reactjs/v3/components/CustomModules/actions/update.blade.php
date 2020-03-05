<script>
/**
 * Custom Modules
 *
 * */

$udate_module =
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

})( { module: $udate_module } );
</script>
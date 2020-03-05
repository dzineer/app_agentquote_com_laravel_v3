import axios from 'axios'

(function(window, $) {
    'use strict';
    var _this;

    function ZohoSubscriptionController() {
        _this = this;
        _this.init();
    };

    ZohoSubscriptionController.prototype.init = function() {
        _this.clickOnSubscription();
    };

    // Get Token from Web Proxy
    ZohoSubscriptionController.prototype.getToken = function( userid, password ) {
        let data = new FormData();
        data.append('userid', userid);
        data.append('password', password);
        const headers = {
            'Content-Type': 'multipart/form-data'
        };

        axios.post(
            'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
            data
        ).then(function(response) {
            console.log(response);
        }).catch(function(response) {
            console.log(response);
        });
    };

    // Send Form to Zoho Subscription Endpoint
    ZohoSubscriptionController.prototype.clickOnSubscription = function() {

   //     const $url = 'https://www.subscriptions.zoho.com/api/v1/subscriptions';

        let $button = $('#subscribe-btn');

        $button.submit(function(event) {

            event.preventDefault();

            const userid = 'dzineer-api';
            const password = 'TVn3DSrb7z67rLre6HjDXjam';

            let form_data = new FormData();
            form_data.append('userid', userid);
            form_data.append('password', password);

            let promise = axios.post(
                'https://mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
                form_data
            ).then(function(response) {
                if ( response.data.success === true ) {
                    return response.data.token;
                }
                console.log(response);
            }).catch(function(response) {
                console.log(response);
            });

            promise.then( token => {

                let $data = $(this).serialize();

                console.log($url, $data);

                let headers = {
                    'Content-Type': 'application/json',
                    'token': token,
                    'X-dzineer-api': 'subscriptions',
                    'accountid': '834839489'
                };

                axios({
                    method: 'POST',
                    url: 'https://www.mymobilelifequoter.com/webhooks/zoho/web-proxy.php',
                    headers: headers,
                    data: '{"customer":{"display_name":"Bowman Furniture","salutation":"Mr.","first_name":"Benjamin","last_name":"George","email":"benjamin.george@bowmanfurniture.com"},"plan":{"plan_code":"low_monthly_retainer_plan"},"auto_collect":false}'
                }).then(function(response) {
                    console.log(response);
                    if ( response.data.success == true ) {

                        var ifrm = document.createElement('iframe');
                        const $billing_container = $('#signup-billing-container')
                        ifrm.setAttribute('id', 'mmlq-iframe'); // assign an id
                        ifrm.setAttribute('allowtransparency', true);

                        $('#signup-container').hide();
                        $billing_container.toggleClass('hide');
                        $billing_container.appendChild( ifrm );

                        ifrm.setAttribute('src', response.data.url);
                        // location.href = response.data.url;
                    }
                }).catch(function(response) {
                    console.log(response);
                });

            });
        });
    };

    window.ZohoSubscriptionController = ZohoSubscriptionController;

}(window, jQuery));

document.addEventListener('DOMContentLoaded', function() {
    new ZohoSubscriptionController();
});
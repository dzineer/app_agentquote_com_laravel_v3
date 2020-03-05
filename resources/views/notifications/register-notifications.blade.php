@extends('adminlte::page')

@section('title')
    {{ config('agentquote.company.name') }} :: Register Push Notifications
@stop

@section('content_header')
    <h1>Register Push Notifications</h1>
@stop

@section('content')
    <script>

        function enableNotifications() {

            let notifications = (function (options) {
                let $ = {
                    data: {
                        user_id: 0,
                        registration: null,
                        permissionResult: null,
                        subscribeOptions: {},
                        public_key: ''
                    },
                    fn: (function() {
                        return {
                            init: function() {
                                // debugger;
                                $.data.public_key = options.public_key;
                                $.data.user_id = options.user_id;
                            },
                            registerServiceWorker: function() {
                                return navigator.serviceWorker.register('/js/service-worker.js')
                                    .then( function(registration) {
                                        // debugger;
                                        console.log('Service worker successfully registered.');
                                        $.data.registration = registration;
                                        return registration;
                                    })
                                    .catch( function(err) {
                                        console.log('Unable to register service worker.', err);
                                    });
                            },
                            askPermission: function () {
                                return new Promise( function(resolve, reject) {
                                    $.data.permissionResult = Notification.requestPermission( function(result) {
                                        resolve( result );
                                    });

                                    if ($.data.permissionResult) {
                                        $.data.permissionResult.then(resolve, reject);
                                    }
                                }).then( function(permissionResult) {
                                    if (permissionResult !== 'granted') {
                                        throw new Error('We were not granted permission.');
                                    } else {
                                        $.fn.subscribeUserToPush();
                                    }
                                });
                            },
                            urlBase64TToUint8Array: function( base64String ) {
                                const padding = '='.repeat((4 - base64String % 4) % 4);
                                const base64 = (base64String + padding).replace(/\-/g, '+').replace(/_/g, '/');
                                const rawData = window.atob(base64);
                                const outputArray = new Uint8Array(rawData.length);

                                for (let i=0; i < rawData.length; i++) {
                                    outputArray[i] = rawData.charCodeAt(i);
                                }
                                return outputArray;
                            },
                            subscribeUserToPush: function () {
                                $.fn.getSWRegistration()
                                    .then( function(registration) {
                                        console.log( registration );
                                        $.data.subscribeOptions = {
                                            userVisibleOnly: true,
                                            applicationServerKey: $.fn.urlBase64TToUint8Array(
                                                $.data.public_key
                                            )
                                        };
                                        return registration.pushManager.subscribe( $.data.subscribeOptions );
                                    })
                                    .then( function (pushSubscription) {
                                        console.log('Received PushSubscription: ', JSON.stringify(pushSubscription));
                                        $.fn.sendSubscription(pushSubscription);
                                        return pushSubscription;
                                    });
                            },
                            sendSubscription: function( subscription ) {
                                const token = document.querySelector('meta[name=csrf-token]').getAttribute('content');
                                return fetch('/api/register/push/notifications', {
                                    method: 'POST',
                                    headers: {
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                        'X-CSRF-Token': token
                                    },
                                    body: JSON.stringify( subscription )
                                })
                                    .then( function(response) {
                                        if ( ! response.ok ) {
                                            throw new Error('Bad status code from server.');
                                        }
                                        return response.json();
                                    })
                                    .then( function(response) {
                                        if ( ! response.success /*&& response.data.success*/ ) {
                                            throw new Error('Bad response from server.');
                                        }
                                    });
                            },
                            getSWRegistration: function() {
                                return new Promise( function (resolve, reject) {
                                    // do something, possibly async
                                    if ($.data.registration !== null) {
                                        resolve( $.data.registration );
                                    } else {
                                        reject(Error("It broke"));
                                    }
                                });
                            },
                            enableNotifications: function() {
                                // register service worker
                                // check permission for notification/ask
                                $.fn.askPermission();
                            }

                        }
                    }())
                };

                $.fn.init();
                $.fn.registerServiceWorker();

                return { enableNotifications: $.fn.enableNotifications }

            }({
                "public_key": "{{ $public_key }}",
                "user_id": "{{ $user_id }}"
            }));

            notifications.enableNotifications();
        }

    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="card">
                    <div class="card-heading">Dashboard</div>

                    <div class="card-body">
                        <button class="btn btn-info" id="enable-notifications" onclick="enableNotifications()">
                            Enable Notifications
                        </button>

                        <a href="{{route('push')}}" class="btn btn-outline-primary btn-block">Make a Push Notification!</a>

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

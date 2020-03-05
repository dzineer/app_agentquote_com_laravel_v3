@extends('adminlte::backend')

@section('header_scripts')
    <script>
        var superAd = {!! $superAdString !!};

        /* User Notifications */
        @auth
        var userNotifications = {!! $userNotifications !!}
        @endauth
    </script>
@stop

@section('service_scripts')
    <script src="{{ asset('js/service-worker.js') }}"></script>
@stop

@section('adminlte_css')
    {{--<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">--}}
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')

    @yield('local_scripts')

    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            @if(config('adminlte.layout') == 'top-nav')
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="navbar-brand">
                                {!! config('adminlte.logo', '<b>Admin</b>LTE') !!}
                            </a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    @else
                        <!-- Logo -->
                            <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}" class="logo">
                                <!-- mini logo for sidebar mini 50x50 pixels -->
                                <span class="logo-mini">{!! config('adminlte.mini_backend_logo', '<b>A</b>LT') !!}</span>
                                <!-- logo for regular state and mobile devices -->
                                <span class="logo-lg">{!! config('adminlte.backend_logo', '<b>Admin</b>LTE') !!}</span>
                            </a>

                            <!-- Header Navbar -->
                            <nav class="navbar navbar-static-top" role="navigation">

                                <div>

                                    <!-- Sidebar toggle button-->
                                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                                    </a>

                                    <div id="notifications"></div>
                                </div>

                            @endif



                            <!-- Navbar Right Menu -->
                                <div class="navbar-custom-menu">

                                    <ul class="nav navbar-nav" style="flex-direction: row !important;">

                                        <li>
                                            <div class="dropdown">
                                                <button class="dropbtn" id="profile-dropdown">
                                                    {{--<img src="http://landing-pages.test:8585/storage/landing-pages/portraits/eoNZGqZvXar8eKttZSV0DqYeuG6sRiY8dKGTpgQp.jpeg" width="25" height="25" class="user-profile" alt="Profile Image">--}}
                                                    <img src="/storage/accounts/defaults/profile/default-profle-pic.png" width="25" height="25" class="user-profile" alt="Profile Image">
                                                    @auth
                                                        <span class="hidden-xs">{{ auth()->user()->fname }}<b class="caret"></b></span>
                                                    @endauth
                                                </button>
                                                <div class="dropdown-content">
                                                    {{-- <a href="/account/settings"><i class="fa fa-fw fa-user"></i> My Account</a>--}}
                                                    @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
{{--                                                        <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                        </a>--}}
                                                    @else
{{--                                                        <a href="#"
                                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                            <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                        </a>--}}

                                                        <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                            @if(config('adminlte.logout_method'))
                                                                {{ method_field(config('adminlte.logout_method')) }}
                                                            @endif
                                                            {{ csrf_field() }}
                                                        </form>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<'))
                                                <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                                    <i class="fa fa-fw fa-power-off"></i> {{ trans('adminlte::adminlte.log_out') }}
                                                </a>
                                            @else
                                                <a href="#" class="power-btn" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fa fa-fw fa-power-off"></i>
                                                </a>
                                                <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                                    @if(config('adminlte.logout_method'))
                                                        {{ method_field(config('adminlte.logout_method')) }}
                                                    @endif
                                                    {{ csrf_field() }}
                                                </form>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                            @if(config('adminlte.layout') == 'top-nav')
                    </div>
                    @endif
                </nav>
        </header>



    @if(config('adminlte.layout') != 'top-nav')
        <!-- Left side column. contains the logo and sidebar -->
            <aside class="main-sidebar">

                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">

                    <!-- Sidebar Menu -->
                    <ul class="sidebar-menu" data-widget="tree">
                        @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
                    </ul>
                    <!-- /.sidebar-menu -->
                </section>
                <!-- /.sidebar -->
            </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @if(config('adminlte.layout') == 'top-nav')
                <div class="container">
                @endif

                <!-- Content Header (Page header) -->

                    <section id="information-box"></section>

                    <section class="content-header">
                        @yield('content_header')
                    </section>

                    <!-- Main content -->
                    <section class="content">

                        @yield('content')

                    </section>
                    <!-- /.content -->
                    @if(config('adminlte.layout') == 'top-nav')
                </div>
                <!-- /.container -->
            @endif
        </div>
        <!-- /.content-wrapper -->
    </div>
    <!-- ./wrapper -->


    <script>

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
                                debugger;
                                $.data.public_key = options.public_key;
                                $.data.user_id = options.user_id;
                            },
                            registerServiceWorker: function() {
                                return navigator.serviceWorker.register('/js/service-worker.js')
                                    .then( function(registration) {
                                        debugger;
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

                if (!options.subscription_registered) {
                    $.fn.init();
                    $.fn.registerServiceWorker();
                    $.fn.enableNotifications();
                }

                return { enableNotifications: $.fn.enableNotifications }

            }({
                "public_key": "{{ env('VAPID_PUBLIC_KEY') }}",
                "user_id": "{{ auth()->user()->id }}",
                "subscription_registered": userNotifications.subscription_registered
            }));

    </script>

    <style>
        .notification-icon {
            margin-right: 6.8775px;
        }
        .fa-bell:before {
            content: "\f0f3";
        }

        .notification-bell {
            font-size: 20px;
        }

        .notification-bell-empty {
            font-size: 20px;
            color: #344150;
        }

        .notification {
            display: block;
            padding: 9.6px 12px;
            border-bottom: 1px solid #eee;
            color: #333;
            text-decoration: none;
        }
        .media, .media-body {
            zoom: 1;
            overflow: hidden;
        }

        .media-body, .media-left, .media-right {
            display: table-cell;
            vertical-align: top;
        }

        .media-left, .media>.pull-left {
            padding-right: 10px;
        }

        .dropdown-footer {
            padding: 5px 20px;
            border-top: 1px solid #ccc;
            border-top: 1px solid rgba(0,0,0,.15);
            border-radius: 0 0 4px 4px;
        }

        .media-body {
            width: 10000px;
        }
        .notification-icon:after {
            position: absolute;
            content: attr(data-count);
            margin-left: -6.8775px;
            margin-top: -6.8775px;
            padding: 0 4px;
            min-width: 13.755px;
            height: 13.755px;
            line-height: 13.755px;
            background: red;
            border-radius: 10px;
            color: #fff;
            text-align: center;
            vertical-align: middle;
            font-size: 11.004px;
            font-weight: 600;
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
        }

        .dropdown-container {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 200px;
            max-width: 330px;
            margin: 2px 0 0;
            list-style: none;
            font-size: 14px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: 4px;
            -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
            box-shadow: 0 6px 12px rgba(0,0,0,.175);
            background-clip: padding-box;
        }

        .dropdown-container>.dropdown-menu {
            position: static;
            z-index: 1000;
            float: none!important;
            padding: 10px 0;
            margin: 0;
            border: 0;
            background: transparent;
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            max-height: 330px;
            overflow-y: auto;
        }

        .dropdown-notifications .dropdown-container {
            margin-top: 0;
        }

        .dropdown-notifications .dropdown-toolbar {
            background: #fff;
        }

        .dropdown-notifications .dropdown-toolbar .dropdown-toolbar-actions {
            margin-top: -2px;
            font-size: 13px;
        }

        .dropdown-toolbar .dropdown-toolbar-actions {
            float: right;
        }
        .dropdown-toolbar .dropdown-toolbar-title {
            margin: 0;
            font-size: 14px;
        }

        #notifications {
            float: right;
            margin-left: 40px;
        }
    </style>

@stop

@section('adminlte_js')
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/axios/axios.min.js') }}"></script>
    @stack('js')
    @yield('js')
@stop


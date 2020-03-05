<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
            @yield('title_prefix', config('adminlte.title_prefix', ''))
            @yield('title', config('adminlte.title', 'AgentQuoter'))
            @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Add X-CSRF-TOKEN -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : '' }}" />

    <script src="/js/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/4.1.3/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Toaster -->
    <link rel="stylesheet" href="{{ asset('vendor/toastr/dist/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('js/messaging.js') }}">

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type='image/x-icon' >
    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/vnd.microsoft.icon">


    <!-- Theme style -->
    {{--<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/AdminLTE.css') }}">--}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!--[if lt IE 9]>

    <script src="/js/html5shiv.min.js"></script>

    <![endif]-->

    <script src="/js/socket.io/socket.io.js"></script>

    <!-- Google Font -->

    <!--
     <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
     -->
    <link rel="stylesheet" href="/css/sans_pro.css">


</head>
<body class="hold-transition @yield('body_class')">

@yield('body')

<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

<script type="text/javascript" src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/4.1.3/js/bootstrap.js') }}"></script>
<script src="{{ asset('/vendor/toastr/dist/js/toastr.js') }}"></script>
<script type="text/javascript" src="{{asset('/js/app.js')}}" defer></script>

</body>
</html>

<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>Sign Up - Thank You</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/solid.css">
    <link href="{{ asset('vendor/toastr/dist/css/toastr.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP" rel="stylesheet">

    <script src="{{ asset('vendor/adminlte/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>

<div id="thank-you" ></div>

<!-- Scripts -->
<script src="{{ asset('js/reactjs-app.js') }}" defer></script>
{{--<script id="delano-companies" license="5e0ce-9601c-b1a9b-6f188" src="{{ asset('vendor/delano/dist/js/delano-companies.min.1.0.0.js') }}" defer></script>--}}


<style>
    .fd3-center-block {
        margin: 0 auto;
    }

    .fd3-modal-container {
        position: fixed;
        background-color: #fff;
        top: 1rem;
        left:50%;
        border-radius: 5px;
        padding: 20px;
        width: 70%;
        max-width: 400px;
        box-sizing: border-box;
        /* prevent right side over overlap */
        /* -50% moves to center of screen */
        /* -200% moves above the screen, move out of view. */
        -webkit-transform: translate(-50%, -200%);
        -ms-transform: translate(-50%, -200%);
        transform: translate(-50%, -200%);

        -webkit-transition: -webkit-transform 0.5s ease-out;
        transition: transform 0.5s ease-out;
        z-index: 99999;
    }

    .fd3-content {
        max-width: 1000px;
        margin: 0 auto;
        padding: 26px;
    }

    .fd3-modal-md .fd3-modal-container {
        width: 80%;
        max-width: 800px;
    }

    .fd3-modal-lg .fd3-modal-container {
        width: 80%;
        max-width: 1024px;
    }

    .fd3-modal-fs .fd3-modal-container {
        width: 100%;
        min-width: 100vw;
        min-height: 100vh;
        top: 0 !important;
    }

    .fd3-modal.fd3-modal-bg-white:before {
        background-color: rgba(255,255,255,0.9);
    }

    .fd3-modal.fd3-modal-bg-black:before {
        background-color: rgba(0,0,0,0.8);
    }

    .fd3-modal:before {
        content: "";
        position: fixed;
        display: none;
        background-color: rgba(0,0,0,0.8);
        top: 0;
        left: 0;
        min-width: 100%;
        min-height: 100%;
        z-index: 9999;
    }

    .fd3-modal:target:before {
        display: block;
    }

    .fd3-modal .close-btn {
        right: 13px;
        position: absolute;
        font-size: 1.8em;
        border-radius: 50%;
        border: 1px solid transparent;
        padding: 3px 16px;
        top: 6px;
        box-sizing: border-box;
    }

    .fd3-modal a.close-btn:hover {
        border-radius: 50%;
        border: 1px solid #ccc;
        padding: 3px 16px;
        box-sizing: border-box;
        top: 6px;
    }

    .fd3-modal:target .fd3-modal-container {
        top: 1rem;

        -webkit-transform: translate(-50%, 0);
        -ms-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
    }
    #modal-close {}

    .contents-container {
        max-width: 640px;
        margin: 0 auto;
    }

    .nav-button {
        min-width: 100%;
        background-color: #8d8d8d;
        display: block;
    }

    .fd3-full-width {
        width: 100%;
    }

    .nav-item .nav-button a {
        color: white;
    }

    .nav-button.active {
        background-color: #ffc700;
        max-height: 37px;
    }

    .nav-button.active::after {
        position: relative;
        left: 126px;
        top: -40px;
        content: "";
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 20px 0 20px 28px;
        border-color: transparent transparent transparent #ffc700;
 ;
        line-height: 0;
        display: inline-block;
        _filter: progid:DXImageTransform.Microsoft.Chroma(color='#000000');
    }

</style>

<script>
    // Your application has indicated there's an error
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "https://app.agentquoter.com/dashboard";

    }, 3000);
</script>

</body></html>
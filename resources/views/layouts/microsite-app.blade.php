<!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>Microsite</title>
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
    <script>
        var content = $('<div>').html("{{ $content }}")[0].textContent;
        content = JSON.parse(content);
    </script>
</head>
<body>

<div class="fluid-container">
        <div class="row" id="header">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="hidden-md hidden-sm hidden-xs col-md-3 col-sm-12 col-xs-12">
                            <div id="logo"></div>
                        </div>
                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="top-menu-container" style="height: 100%; padding: 10px; position: relative;">
                                {{--<div id="top-menu"></div>--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="main-menu-container">
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12"></div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div id="main-menu"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="height: auto;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="container">
                    <div class="row">
                        <div class="left-side-container col-lg-3 col-md-12 col-sm-12 col-xs-12">
                            <div id="profile-box"></div>
                        </div>
                        <div class="right-side-container col-lg-9 col-md-12 col-sm-12 col-xs-12">
                            <div class="right-container" style="padding: 10px 42px;height: 100%;height: auto;">
                                <div id="banner" class="loader"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <div class="col-md-12">
                        <div id="signup-button"></div>
                        <div id="signup-button2"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="loader-container"></div>
                            <div id="quote-results"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div id="insurance-details"></div>
                    </div>
                </div>
            </div>
        </div>

{{--
        <div class="row" style=" height: auto;">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div id="logos"></div>
            </div>
        </div>
--}}



</div>
<main class="py-4">
    @yield('content')
</main>

<!-- Scripts -->

<style>

    [lang] body {
        font-family: NotoSansJP, sans-serif;
    }

    .message-point {
        position: absolute;
        margin-left: -382px;
        top: -2px;
        min-width: 180px;
        border: 1px solid #ccc;
        background: #ffffff;
        min-height: 50px;
        width: 370px;
        padding: 12px 16px;
    }

    .message-point:after, .message-point:before {
        left: 100%;
        top: 50%;
        border: solid transparent;
        content: " ";
        height: 0;
        width: 0;
        position: absolute;
        pointer-events: none;
    }

    .message-point:after {
        border-color: rgba(136, 183, 213, 0);
        border-left-color: #fff;
        border-width: 8px;
        margin-top: -8px;
    }
    .message-point:before {
        border-color: rgba(194, 225, 245, 0);
        border-left-color: #ccc;
        border-width: 10px;
        margin-top: -10px;
    }

    .password-field {
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
    }

    .progress-bar-container {
        padding: 0;
        background: #ccc;
    }

    .fd3-progress-bar {
        height: 5px !important;
        margin-top: 0;
        text-align: center;
        font-size: 0.8em;
        line-height: 1.8;
        color: #ffffff;
    }

    .modal-header {
        border: none !important;
        font-size: 0.9rem;
    }

    .modal-title {
        font-size: 1.2em;
    }

    .field {
        margin-bottom: 5px;
        margin-top: 5px;
    }

    .nav-tabs {
    }

    .content-frame {
        padding: 10px;
    }

    .tab-content {
        padding: 28px 44px;
    }

    .cc-icon {
        height:20px;

    }



    .cc-icons {
        margin: 0 auto;
        width: 300px;
    }

    .visa {
        background: url({{ asset('images/cc.png') }}) -5px 0 no-repeat;
        height: 40px;
        display: inline-block;
        width: 59px;
    }

    .mastercard {
        background: url({{ asset('images/cc.png') }}) -68px 0 no-repeat;
        height: 40px;
        display: inline-block;
        width: 59px;
    }

    .american-express {
        background: url({{ asset('images/cc.png') }}) -128px 0 no-repeat;
        height: 40px;
        display: inline-block;
        width: 59px;
    }

    .discover {
        background: url({{ asset('images/cc.png') }}) -189px 0 no-repeat;
        height: 40px;
        display: inline-block;
        width: 59px;
    }

    .paypal {
        background: url({{ asset('images/cc.png') }}) -247px 0 no-repeat;
        height: 40px;
        display: inline-block;
        width: 59px;
    }

    .field input {
        padding-left: 38px;
        padding-top: 12px;
        padding-bottom: 12px;
        color: #5f5f5c;
        background-color: #ffffff !important;
        font-size: 0.9rem;
        display: inline-block;
    }

    .field input:focus {
        background-color: #ffffff !important;
    }

    .nav-link {
        display: block;
        padding: .4rem .9rem;
        color: #8d8d8d;
        font-weight: normal;
        text-transform: capitalize;
        font-size: 1.0em;
    }

    .nav-link.active {
        border-bottom: 2px solid #ff9800;
    }

    a.nav-link:hover {
        border-bottom: 2px solid #357ebd;
    }

    .orange-theme {
        color: #ff9800 !important;
    }

    .field i {
        color: #000000;
        position: absolute;
        left: 0;
        top: 0;
        padding: 45px 25px 0;
        font-size: 1.2em;
        opacity: 0.8;
    }

    .view-password {
        position: relative;
        cursor: pointer;
    }

    .view-password i.pass {
        position: absolute;
        left: -38px;
        top: 0;
        padding: 0;
        display: inline-block;
    }

    .cc-top {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
    }

    .cc-middle {
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
    }

    .cc-bottom {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-top: none;
        display: inline-block;
        box-sizing: border-box;
        width:50%;
    }

    .left.cc-bottom {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
    }
    .right.cc-bottom {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
    }

    .left.cc-bottom + i {
        position: absolute;
        top: 36px;
    }

    .right.cc-bottom + i {
        position: absolute;
        left: 220px;
        top: 36px;
    }

    .half-field {
        position: relative;
        box-sizing: border-box;
    }

    .half-field input {
        padding-left: 42px;
    }

    .half-field i {
        color: #000000;
        position: absolute;
        left: 0;
        top: 0;
        padding: 10px 14px 0;
        font-size: 1.2em;
    }


    #insurance-details {
        display: none;
    }

    #insurance-details.show {
        display: block;
    }

    .rates-container {
        border-top-right-radius: 8px !important;
    }

    .product-name {
        border-bottom-left-radius: 8px !important;
        border-bottom-right-radius: 8px !important;
    }

    .image-container {
        border-left-right-radius: 8px !important;
        background-color: #ffffff !important;
    }

    #quote-results {
        display: none;
    }

    #quote-results.show {
        display: block;
    }

    #loader-container {
        width: 6em;
        height: 6em;
        margin: 0 auto;
        display: none;
    }

    nav ul {
        background-color: <?php echo $profile["colors"]->menu_bar ?>;
        overflow: hidden;
        color: white;
        padding: 0;
        text-align: center;
        margin: 0;
    }

    a {
        text-decoration: none !important;
        color: inherit;
        transition: background-color 0.7s;
    }
    a:hover {
        text-decoration: none !important;
        color: inherit;
    }

    nav ul li {
        display: inline-block;
        padding: 8px 0;
    }

    nav ul li a {
        font-size: 17px;
        padding: 8px 36px;
        border-left: 1px solid #0000002b;
        display: inline-block;
        color: inherit;
    }

    nav ul li:hover {
        color: inherit;
    }

    nav ul li:first-child a {
        border: none;
    }

    .handle {
        width: 100%;
        background: #808080;
        text-align: left;
        box-sizing: border-box;
        padding: 15px 21px;
        cursor: pointer;
        color: white;
        display:none;
    }

    .handle i {
        padding: 6px;
    }

    @media screen and (max-width: 1167px) {
        .message-point {
            position: absolute;
            margin-left: 0;
            top: 82px;
            min-width: 180px;
            border: 1px solid #ccc;
            background: #ffffff;
            min-height: 50px;
            width: 380px;
            padding: 12px 16px;
            z-index: 99999;
        }

        .message-point:after, .message-point:before {
            bottom: 100%;
            left: 50%;
            border: solid transparent;
            content: " ";
            height: 0;
            width: 0;
            position: absolute;
            pointer-events: none;
        }

        .message-point:after {
            border-bottom-color: #fff;
            border-width: 8px;
            margin-top: -76px;
            margin-left: -8px;
        }
        .message-point:before {
            border-bottom-color: #ccc;
            border-width: 10px;
            margin-top: -81px;
            margin-left: -10px;
        }
    }

    @media screen and (max-width: 960px) {

        .image-container {
            background-color: #ffffff !important;
        }

        .profile-container {
            margin-top: 20px !important;
        }

        .handle {
            display: inline-block;
            width: 100%;
        }

        .showing {
            max-height: 20em;
            margin-left: 0;
            width: 100%;
        }

        /*
          <?php echo "menu_bar: " . print_r($profile["colors"]->menu_bar,true) ?>
         */

        nav ul {
            background-color: <?php echo $profile["colors"]->menu_bar ?>;
            margin-left: -400px;
            max-height: 0;
            width: 20px;
        }

        nav ul li {
            box-sizing: border-box;
            width: 100%;
            padding: 10px;
            display: block;
            text-align: left;
        }

        nav ul li:hover {
            color: inherit;
            background-color: #555555;
        }

        nav ul li a {
            border: none;
            padding-left: 8px;
        }
    }

    @media screen and (max-width: 1200px) {
        .quote-container {
            width: 100% !important;
        }

        .hidden-md, .hidden-sm, .hidden-xs {
            display: none;
        }

        #portrait-box-container {
            width: 100% !important;
        }

        .portrait-backdrop {
            background-position: -349px -140px !important;
        }

        .right-container {
            padding: 10px 0 !important;
        }

        .left-side-container, .right-side-container {
            -ms-flex: 0 0 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
    }

    .link {
        font-size: 0.8em;
    }

    /* When the screen is less than 600 pixels wide, hide all links, except for the first one ("Home"). Show the link that contains should open and close the topnav (.icon) */
    @media screen and (max-width: 991px) {
        .container {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .col {
            border: none !important;
        }

        .rates-container {
            padding: 0 !important;
            margin: 0 !important;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .product-name {
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
        }

        .rate-container {
            padding: 10px !important;
            line-height: 1.2 !important;
        }
    }

    /* The "responsive" class is added to the topnav with JavaScript when the user clicks on the icon. This class makes the topnav look good on small screens (display the links vertically instead of horizontally) */
    @media screen and (max-width: 600px) {
        .field i {
            display: none;
        }
        .field input {
            padding: 14px;
        }
    }

     #loader-container.loader {
        display:block;
    }

    .loader:empty {
        display: block;
        margin: 0 auto;
        width: 6em;
        height: 6em;
        border: 1.1em solid rgba(0, 0, 0, 0.2);
        border-left: 1.1em solid #000000;
        border-radius: 50%;
        animation: load8 1.1s infinite linear;
    }

    @keyframes load8 {
        0% {
            transform: rotate(0deg);
        }
        100% {
            transform: rotate(360deg);
        }
    }

    #quote-results {
        display:none;
        padding: 20px;
    }

    #quote-results.show {
        display: block;
    }

    #quote-results .ucrName {
        color: #D87C0B;
        font-size: 1.1em;
    }

    #quote-results .selects {
        font-size: 1.6em;
        padding: 16px;
        height: 54px;
        background-color: #6F6F6F;
        color: #fff;
        font-weight: bold;
        margin: 0px 0px 10px 0px;
        width: 100%;
        border-radius: 6px;
    }

    .suga-container {
        background: #ffffff;
        padding: 0.2em;
        max-width: 100%;
        /*margin: 5em auto; */
        /*box-shadow: 3px 3px 0px #353435;
        border: 2px solid #353435;*/
        overflow: hidden;
        border-radius: 0px;
    }
    .suga-slider-wrap {
        overflow: hidden;
        margin: 1em 0;
        padding: 0;
    }
    .suga-slider-group {
        width: 100%;
    }
    .suga-slider-group:before, .suga-slider-group:after {
        content: " ";
        display: table;
    }
    .suga-slider-group:after {
        clear: both;
    }
    .suga-slide {
        float: left;
        position: relative;
        margin-left: 0;
        padding-left: 16px;
        padding-right: 16px;
        height: 54px;
    }

     /** Extra small devices (portrait phones, less than 576px)
      *  No media query for `xs` since this is the default in Bootstrap */

     /** Small devices (landscape phones, 576px and up) */
    @media (max-width: 576px) {
        #portrait-box-container {
            width: 100% !important;
            border-radius: 0 !important;
        }

        [class*='col-'] {
            margin-left: 0 !important;
            margin-right: 0 !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        [class*='row'] {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }

        .quote-container {
            width: 100% !important;
            border-radius: 0 !important;
        }

        .row {
            padding: 0;
            margin: 0;
            height: auto !important;
            background: none !important;
        }

        .right-container {
            padding: 10px 0 !important;
        }

        .portrait-backdrop {
            border-top-left-radius: 0 !important;;
            border-top-right-radius: 0 !important;;
        }

        .portrait-container-container {
            width: 100% !important;
        }
    }

    /** Medium devices (tablets, 768px and up)  */
    @media (min-width: 768px) {

    }

    /** Large devices (desktops, 992px and up) */
    @media (min-width: 992px) {

    }

    /** Extra large devices (large desktops, 1200px and up) */
    @media (min-width: 1200px) {

    }

    .btn-orange {
        color: #fff;
        background: linear-gradient(#ff9800 0%, #ff9800 100%);
        border-color: #ff9800;
    }
    label.field-label {
        width: 100% !important;
        color: #333 !important;
        text-align: left !important;
    }

    .btn-long {
        width: 100%;
    }

    .btn-primary {
        color: #fff;
        background-color: #428bca;
        border-color: #357ebd;
    }

    .btn-warning {
        color: #fff;
        background-color: #f0ad4e;
        border-color: #eea236;
    }

    .modal-title {
        color: #333 !important;
        text-align: center;
    }

    .black-text {
        padding: 0 14px;
        font-size: 0.8em;
        color: #333 !important;
        text-align: left !important;
    }

    .app-details {
        background-color: #f1f1f1;
        border-radius: 5px;
        padding: 18px;
        text-align: left !important;
        color: #333 !important;
        margin: 14px 0;
        line-height: 1.5em;
    }
    .app-details .app-header {
        font-weight: bold;
    }

</style>

<script src="{{ asset('js/reactjs-app.js') }}" defer></script>
{{--<script id="delano-companies" license="5e0ce-9601c-b1a9b-6f188" src="{{ asset('vendor/delano/dist/js/delano-companies.min.1.0.0.js') }}" defer></script>--}}

<script defer>
    /*

Suga Slider

Usage ---------

$(window).load(function(){
  $('#logos').suga({
    'transitionSpeed': 2000,
    'snap': false
  });
});

The markup should resemble the markup here

*/
    jQuery(function() {

        let $ = jQuery.noConflict();
        $.fn.suga = function( options ) {
            let settings = $.extend( {
                'transitionSpeed': 3000,
                'snap': false
            }, options );

            let $this = $( this );

            // add plugin specific classes
            $this.addClass( 'suga-slider-wrap' );
            $this.children( 'ul' )
                .addClass( 'suga-slider-group' );
            $this.find( 'li' )
                .addClass( 'suga-slide' );

            // caching $$$
            let $slide = $( '.suga-slide' ),
                $firstEl = $( '.suga-slide:first' ),
                $group = $( '.suga-slider-group' ),
                $wrap = $( '.suga-slider-wrap' );

            let slideWidth = $slide.outerWidth(),
                slideHeight = $( '.suga-slide' )
                    .height(),
                slideCount = $slide.length,
                totalWidth = slideWidth * slideCount;

            // override
            totalWidth = "100% !important";

            // set width on group element
            $group.width( totalWidth );
            $wrap.height( slideHeight );
            $wrap.wrap( '<div class="suga-container"></div>' );

            // add first class at start
            if ( !$group.find( $firstEl )
                .hasClass( "suga-first" ) ) {
                $group.find( $firstEl )
                    .addClass( "suga-first" );
            }

            // lets move baby
            let transitionSnap = function() {
                let $firstEl = $group.find( '.suga-first' )
                    .html();

                $group.find( '.suga-first' )
                    .animate( {
                        'margin-left': '-' + slideWidth + 'px'
                    }, function() {
                        $group.append( '<li class="suga-slide">' + $firstEl + '</li>' );
                        $( this )
                            .remove();
                        $group.find( 'li:first' )
                            .addClass( "suga-first" );

                    } );
            };

            let transitionScroll = function() {
                let $firstEl = $group.find( '.suga-first' )
                    .html();

                $group.find( '.suga-first' )
                    .animate( {
                        'margin-left': '-' + slideWidth + 'px'
                    }, settings.transitionSpeed, 'linear', function() {
                        $group.append( '<li class="suga-slide">' + $firstEl + '</li>' );
                        $( this )
                            .remove();
                        $group.find( 'li:first' )
                            .addClass( "suga-first" );
                        transitionScroll();
                    } );
            };

            if ( settings.snap ) {
                window.setInterval( transitionSnap, settings.transitionSpeed );
            } else {
                transitionScroll();
            }
        };

        $( window ).on("load", function() {
                $( '#carrier-logos' )
                    .suga( {
                        'transitionSpeed': 3000,
                        'snap': false
                    } );
            } );
    });
</script>

<script>
    $(function() {
        console.log("[Content]", content);
        if (content) {
            if (content.colors.header_background) {
                $('#header').css('backgroundColor', content.colors.header_background);
            }
            if (content.colors.menu_bar) {
                $('#main-menu-container').css('backgroundColor', content.colors.menu_bar);
            }
        }
    });
</script>

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
        line-height: 0;
        _border-color: #000000 #000000 #000000 #ffc700;
        display: inline-block;
        _filter: progid:DXImageTransform.Microsoft.Chroma(color='#000000');
    }

</style>

</body></html>

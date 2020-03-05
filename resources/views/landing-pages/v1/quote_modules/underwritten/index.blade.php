<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages.v1.quote_modules." . $insure_module['module'] . ".metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/v1/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".styles")

    <!-- Browser Conditionals -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".browser-conditionals")
</head>
<body>

@include("landing-pages.v1.components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.header")

    <!-- Swiper -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section1")

    <!-- About -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section2")

    <!-- Medical Team -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section-life")

    <!-- Why choose the DentalPlus clinic? -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section4")

    <!-- Our services -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section5")

    <!-- What our patients say -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section6")

    <!--What our patients say -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section7")

    <!--Pricing Table -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section-glossary")

    <!-- Recent news-->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section9")

    <!--Contact Form -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section10")

    <!-- Google Maps -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.section11")

    <!-- Footer -->
    @include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".modals.index")

<!-- Scripts -->
@include("landing-pages.v1.quote_modules." . $insure_module['module'] .  ".scripts")

<style>

    #term-life-widget {
        visibility: hidden;
        height: 0;
    }

    #term-life-widget.show {
        visibility: visible;
        height: auto;
    }
</style>

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

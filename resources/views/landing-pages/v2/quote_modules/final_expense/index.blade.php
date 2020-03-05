<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] . ".metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".styles")

    <!-- Browser Conditionals -->
    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".browser-conditionals")
</head>
<body>

@include("landing-pages.v2.components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.header")

    <!-- Quoter -->
    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section1")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

    <!-- Medical Team -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section-life")--}}

    <!-- Why choose the DentalPlus clinic? -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section4")--}}

    <!-- Our services -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section5")--}}

    <!-- What our patients say -->
    {{-- @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section6")--}}

    <!-- How we can help -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section7")--}}

    <!-- Pricing Table -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section-glossary")--}}

    <!-- Recent news-->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section9")--}}

    <!--Contact Form -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section10")--}}

    <!-- Google Maps -->
    {{--@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.section11")--}}

    <!-- Footer -->
    @include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".modals.index")

<!-- Scripts -->
@include("landing-pages." . $version . ".quote_modules." . $insure_module['module'] .  ".scripts")

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

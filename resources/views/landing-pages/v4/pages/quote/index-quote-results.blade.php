<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages.v1.pages.quote.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/v1/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages.v1.pages.quote.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages.v1.pages.quote.browser-conditionals")
</head>
<body>

@include("landing-pages.v1.components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
    @include("landing-pages.v1.pages.quote.sections.header")

    <!-- Quote Form -->
    @include("landing-pages.v1.pages.quote.sections.section-quote-contents")

    <!-- About -->
    @include("landing-pages.v1.pages.home.sections.section2")

    <!-- Medical Team -->
    @include("landing-pages.v1.pages.home.sections.section-life")

    <!-- Why choose the DentalPlus clinic? -->
    @include("landing-pages.v1.pages.home.sections.section4")

    <!-- Our services -->
    @include("landing-pages.v1.pages.home.sections.section5")

    <!-- What our patients say -->
    @include("landing-pages.v1.pages.home.sections.section6")

    <!--What our patients say -->
    @include("landing-pages.v1.pages.home.sections.section7")

    <!--Pricing Table -->
    @include("landing-pages.v1.pages.home.sections.section-glossary")

    <!-- Recent news-->
    @include("landing-pages.v1.pages.home.sections.section9")

    <!--Contact Form -->
    @include("landing-pages.v1.pages.home.sections.section10")

    <!-- Google Maps -->
    @include("landing-pages.v1.pages.home.sections.section11")

    <!-- Footer -->
    @include("landing-pages.v1.pages.home.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages.v1.pages.quote.modals.index")

<!-- Scripts -->
@include("landing-pages.v1.pages.quote.scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

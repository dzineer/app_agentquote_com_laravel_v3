<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages.v2.pages.home.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages.v2.pages.home.styles")

    <!-- Header Scripts -->
    @include("landing-pages.v2.pages.home.header-scripts")

    <!-- Browser Conditionals -->
    @include("landing-pages.v2.pages.home.browser-conditionals")
</head>
<body>

@include("landing-pages.v2.components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include("landing-pages.v2.pages.home.sections.header")

    <!-- Quote Form -->
    @include("landing-pages.v2.pages.home.sections.section-quote-form")

    <!-- Footer -->
    @include("landing-pages.v2.pages.home.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages.v2.pages.home.modals.index")

<!-- Scripts -->
@include("landing-pages.v2.pages.home.scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

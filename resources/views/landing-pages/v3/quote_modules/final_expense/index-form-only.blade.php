<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages." . $version . ".pages.home.metas")

    <link rel="icon" href="{{ asset_prepend($templates_path, 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages." . $version . ".pages.home.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages." . $version . ".pages.home.browser-conditionals")
</head>
<body>

@include("landing-pages." . $version . ".components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include("landing-pages." . $version . ".pages.home.sections.header")

    <!-- Quote Form -->
    @include("landing-pages." . $version . ".pages.home.sections.section-quote-form")

    <!-- Footer -->
    @include("landing-pages." . $version . ".pages.home.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages." . $version . ".pages.home.modals.index")

<!-- Scripts -->
@include("landing-pages." . $version . ".pages.home.scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

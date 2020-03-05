<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages." . $version . ".quote_modules.underwritten.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/'. $version .'/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages." . $version . ".quote_modules.underwritten.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages." . $version . ".quote_modules.underwritten.browser-conditionals")

    <!-- Scripts -->
    @include("landing-pages." . $version . ".quote_modules.underwritten.quote-results-scripts")

</head>
<body>

@include("landing-pages." . $version . ".components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
@include("landing-pages." . $version . ".quote_modules.underwritten.sections.header")

<!-- Quote Form -->
    @include("landing-pages." . $version . ".quote_modules.underwritten.sections.section-quote-contents")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

<!-- Footer -->
    @include($rel_path . ".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

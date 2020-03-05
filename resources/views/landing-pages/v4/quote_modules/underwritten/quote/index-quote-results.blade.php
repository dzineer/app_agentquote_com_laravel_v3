<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages.v4.quote_modules.underwritten.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/v3/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages.v4.quote_modules.underwritten.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages.v4.quote_modules.underwritten.browser-conditionals")
</head>
<body>

@include("landing-pages.v4.quote_modules.underwritten.components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
    @include("landing-pages.v4.quote_modules.underwritten.sections.header")

    <!-- Quote Form -->
    @include("landing-pages.v4.quote_modules.underwritten.sections.section-quote-contents")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

    <!-- Footer -->
    @include("landing-pages.v4.quote_modules.underwritten.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages.v4.quote_modules.underwritten.modals.index")

<!-- Scripts -->
@include("landing-pages.v4.quote_modules.underwritten.quote-scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

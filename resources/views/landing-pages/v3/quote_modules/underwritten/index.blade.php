<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include($rel_path . ".metas")

    <link rel="icon" href="{{ asset_prepend($templates_path, 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->

    @include($rel_path .  ".styles")

    <!-- Browser Conditionals -->
    @include($rel_path .  ".browser-conditionals")
</head>
<body>

@include($rel_path .  ".components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include($rel_path .  ".sections.header")

    <!-- Quoter -->
    @include($rel_path .  ".sections.section1")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

    <!-- Footer -->
    @include($rel_path .  ".sections.footer")

</div>

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include($rel_path .  ".modals.index")

<!-- Scripts -->
@include($rel_path .  ".scripts")

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

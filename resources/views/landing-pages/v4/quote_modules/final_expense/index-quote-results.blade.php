<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include($rel_path.".metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/v3/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include($rel_path.".styles")

    <!-- Browser Conditionals -->
    @include($rel_path.".browser-conditionals")
</head>
<body>

@include($rel_path.".components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
    @include($rel_path.".sections.header")

    <!-- Quote Form -->
    @include($rel_path.".sections.section-quote-contents")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

    <!-- Footer -->
    @include($rel_path.".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include($rel_path.".modals.index")

<!-- Scripts -->
@include($rel_path.".quote-scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

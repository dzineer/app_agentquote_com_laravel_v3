<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include($rel_path.".metas")

    <link rel="icon" href="{{ asset_prepend($templates_path, 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->

    @include($rel_path.".styles")

    <!-- Header Scripts -->

    @include($rel_path.".header-scripts")

    <!-- Browser Conditionals -->
    @include($rel_path.".browser-conditionals")
</head>
<body>

@include($rel_path.".components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include($rel_path.".sections.header")

    <!-- Quote Form -->
    @include($rel_path.".sections.section-quote-form")

    <!-- Footer -->
    @include($rel_path.".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include($rel_path.".modals.index")


<!-- Scripts -->
@include($rel_path.".scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

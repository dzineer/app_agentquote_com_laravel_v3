<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages." . $version . ".quote_modules.final_expense.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/'. $version .'/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages." . $version . ".quote_modules.final_expense.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages." . $version . ".quote_modules.final_expense.browser-conditionals")
</head>
<body>

@include("landing-pages." . $version . "components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
    @include("landing-pages." . $version . ".quote_modules.final_expense.sections.header")

    <!-- Quote Form -->
    @include("landing-pages." . $version . ".quote_modules.final_expense.sections.section-quote-form")

    <!-- Footer -->
    @include("landing-pages." . $version . ".quote_modules.final_expense.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages." . $version . ".quote_modules.final_expense.modals.index")

<!-- Scripts -->
@include("landing-pages." . $version . ".quote_modules.final_expense.scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

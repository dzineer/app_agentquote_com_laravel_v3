<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include("landing-pages.v1.quote_modules.final_expense.quote.metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/v1/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.styles")

    <!-- Browser Conditionals -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.browser-conditionals")
</head>
<body>

@include("landing-pages.v1.components.preloader")

<!-- Page-->
<div class="page text-center">

    <!-- Page Header -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.header")

    <!-- Quote Form -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section-quote-contents")

    @foreach($sections as $section)
        <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
            {!! $section['data'] !!}
        </section>
    @endforeach

    {{--<!-- About -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section2")

    <!-- Medical Team -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section-life")

    <!-- Why choose the DentalPlus clinic? -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section4")

    <!-- Our services -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section5")

    <!-- What our patients say -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section6")

    <!--What our patients say -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section7")

    <!--Pricing Table -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section-glossary")

    <!-- Recent news-->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section9")

    <!--Contact Form -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section10")

    <!-- Google Maps -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.section11")--}}

    <!-- Footer -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include("landing-pages.v1.quote_modules.final_expense.quote.modals.index")

<!-- Scripts -->
@include("landing-pages.v1.quote_modules.final_expense.quote.scripts")

<script src="{{ asset('js/app-landing-page.js') }}"></script>

</body>
</html>

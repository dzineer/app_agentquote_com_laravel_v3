<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <!-- Site Title -->
    <title>{{ $page['title'] }}</title>

    @include($rel_path.".metas")

    <link rel="icon" href="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'images/favicon.ico') }}" type="image/x-icon">

    <!-- Stylesheets -->
    @include($rel_path.".styles")

    <!-- Browser Conditionals -->
    @include($rel_path.".browser-conditionals")

    <!-- Header Scripts -->
    @include($rel_path.".header-scripts")
</head>
<body>

@include("landing-pages.v2.components.preloader")

<!-- Page-->
<div class="page">

    <!-- Page Header -->
    @include($rel_path.".sections.header")

    <!-- Swiper -->
    @include($rel_path.".sections.section1")

{{--    @foreach($sections as $section)
        {{ $section }}
    @endforeach;--}}

    <!-- About -->
    {{--@include($rel_path.".sections.section2")--}}

    <!-- Medical Team -->
    @include($rel_path.".sections.section-life")

    <!-- Why choose the DentalPlus clinic? -->
    @include($rel_path.".sections.section4")

    <!-- Our services -->
    @include($rel_path.".sections.section5")

    <!-- What our patients say -->
    @include($rel_path.".sections.section6")

    <!--What our patients say -->
    @include($rel_path.".sections.section7")

    <!-- Recent news-->
    {{--@include($rel_path.".sections.section9")--}}

     <!-- Google Maps -->
    @include($rel_path.".sections.section11")

    <!-- Footer -->
    @include($rel_path.".sections.footer")

</div>
<!-- Global Mailform Output-->

<div class="snackbars" id="form-output-global"></div>

<!-- Modals -->
@include($rel_path.".modals.index")

<!-- Scripts -->
@include($rel_path.".scripts")

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

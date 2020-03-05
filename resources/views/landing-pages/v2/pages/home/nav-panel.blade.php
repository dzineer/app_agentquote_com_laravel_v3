<div class="rd-navbar-panel">
    <!-- RD Navbar Toggle-->
    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
    <div class="reveal-sm-flex range-sm-around range-md-justify range-sm-middle">
        <div>
            <!-- RD Navbar Brand-->
            @include('landing-pages.v2.components.branding_header')

        </div>
        @include("landing-pages." . $version . ".pages.home.veil")
    </div>
</div>

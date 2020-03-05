<nav class="rd-navbar rd-navbar-default" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fullwidth" data-sm-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="229px" data-lg-stick-up-offset="155px">
    <!-- RD Navbar top part-->
    <div class="rd-navbar-top-part bg-primary">
        <div class="shell">
            <div class="reveal-sm-flex range-sm-justify">

                @include("landing-pages.v1.components.social-media")

                @include("landing-pages.v1.quote_modules.final_expense.quote.book-appointment-top")

            </div>
        </div>
    </div>
    <div class="rd-navbar-inner rd-navbar-inner-1">
        <!-- RD Navbar Panel-->
        @include("landing-pages.v1.quote_modules.final_expense.quote.nav-panel")

    </div>
    <hr class="divider offset-top-0 offset-bottom-0">
    <div class="rd-navbar-inner rd-navbar-inner-2 offset-top-0">
        <div class="reveal-sm-flex range-sm-justify range-sm-middle pos-relative">
            <div class="rd-navbar-nav-wrap text-md-left">
                <!-- RD Navbar Nav-->
                @include("landing-pages.v1.components.menus.main")
            </div>
        </div>
    </div>

    <!-- Veil -->
    @include("landing-pages.v1.quote_modules.final_expense.quote.veil")
</nav>

<nav class="rd-navbar rd-navbar-default" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-device-layout="rd-navbar-fullwidth" data-sm-device-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-static" data-sm-stick-up-offset="229px" data-lg-stick-up-offset="155px">
    <!-- RD Navbar top part-->
    <div class="rd-navbar-top-part bg-primary">
        <div class="shell">
            <div class="reveal-sm-flex range-sm-justify">

                @include($rel_path . ".components.social-media")

                @include($rel_path .".top-bar-message")

            </div>
        </div>
    </div>
    <div class="rd-navbar-inner rd-navbar-inner-1">
        <!-- RD Navbar Panel-->
        @include($rel_path .".nav-panel")

    </div>
    <hr class="divider offset-top-0 offset-bottom-0">
    <div class="rd-navbar-inner rd-navbar-inner-2 offset-top-0">
        <div class="reveal-sm-flex range-sm-justify range-sm-middle pos-relative">
            <div class="rd-navbar-nav-wrap text-md-left">
                <!-- RD Navbar Nav-->
                @include($rel_path .".components.menus.main")
            </div>
        </div>
    </div>



</nav>

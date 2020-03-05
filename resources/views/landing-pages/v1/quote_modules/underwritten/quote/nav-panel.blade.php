<div class="rd-navbar-panel">
    <!-- RD Navbar Toggle-->
    <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
    <div class="reveal-sm-flex range-sm-around range-md-justify range-sm-middle">
        <div>
            <!-- RD Navbar Brand-->

            <div class="rd-navbar-brand brand">
                <a class="brand" href="./">
                    @if( $options['use_logo'] )
                    <img class="brand-logo" src="{{ $branding['logo']['light'] }}" alt="Branding Logo" />
                    @else
                    <span class="brand-name light">{{ $branding['company'] }}</span>
                    @endif
                </a>
            </div>
            {{--<div class="rd-navbar-brand brand"><a class="brand" href="./"><img class="brand-logo" src="{{ asset_prepend('templates/landing-pages/v1/', 'images/logo-200x40.png') }}" alt="" width="200" height="40"/></a>
            </div>--}}
        </div>
        <div class="veil reveal-sm-block">
            <ul class="list-inline list-inline-from-md text-left">
                <li>
                    <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-middle">
                        <div class="unit-left">
                            <div class="icon fa-phone icon-circle text-primary"></div>
                        </div>
                        <div class="unit-body">
                            <div class="text-extra-bold text-gray-light">Call Today:</div>
                            <div class="text-italic">
                                <a class="text-gray-lighter" href="tel:#">{{ $company['phone'] }}</a>
                                {{--<span class="text-gray-lighter">; </span>
                                <a class="text-gray-lighter" href="tel:#">{{ $phone[1] }}</a>--}}
                            </div>
                        </div>
                    </div>
                </li>
                <li class="offset-top-15 offset-md-top-0">
                    <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-middle">
                        <div class="unit-left">
                            <div class="icon fa-clock-o icon-circle text-primary"></div>
                        </div>
                        <div class="unit-body">
                            <div class="text-extra-bold text-gray-light">Opening Hours:</div>
                            <div class="text-italic text-gray-lighter">{{ $hours_available }}</div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

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

            {{--<div class="rd-navbar-brand brand"><a class="brand" href="./"><img class="brand-logo" src="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'images/logo-200x40.png') }}" alt="" width="200" height="40"/></a>
            </div>--}}
        </div>
        @include($rel_path .  ".veil")
    </div>
</div>

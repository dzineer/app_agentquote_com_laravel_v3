<div class="footer-offset-none">
    <!-- Page Footer-->
    <footer class="page-footer footer-default text-sm-left">
        <div class="bg-cape-cod section-60 section-md-top-85 section-md-bottom-70">
            <div class="shell">
                <div class="range">
                    <div class="cell-sm-6 cell-md-4">
                        <a class="brand white" href="./">
                            @if( $options['use_logo'] )
                                <img class="brand-logo" src="{{ $branding['logo']['dark'] }}" alt="Branding Logo" width="80%" />
                            @else
                                <span class="brand-name dark">{{ $branding['company'] }}</span>
                            @endif
                        </a>
                        <div class="offset-top-20">
                            <p>{{ $branding['special_text'] }}</p>
                        </div>
                    </div>
                    <div class="cell-sm-6 cell-md-4 offset-top-50 offset-md-top-0">
                        <h6 class="text-white">Opening hours</h6>
                        <div class="offset-top-25">
                            <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal">
                                <div class="unit-left">
                                    <div class="icon fa-clock-o icon-circle text-middle text-primary"></div>
                                </div>
                                <div class="unit-body">
                                    <div class="text-italic">Monday –Friday: 9am–6pm<br>Saturday: 10am–4pm<br>Sunday: 10am–1pm</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="cell-sm-6 cell-md-4 offset-top-50 offset-md-top-0">
                        <h6 class="text-white">Contact info</h6>
                        <div class="offset-sm-top-25"></div>
                        <div class="unit unit-middle unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-xs-vertical">
                            <div class="unit-left">
                                <div class="icon fa-phone icon-circle text-middle text-primary"></div>
                            </div>
                            <div class="unit-body">
                                <div class="text-italic">
                                    <a href="tel:#">{{ $company['phone'] }}</a>
                                    @if(! empty( $company['phone'][1]) )
                                    <span>; </span>
                                    <br class="veil-lg"><a href="tel:#">{{ $company['phone'][1] }}</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="offset-top-25 offset-sm-top-10 unit unit-middle unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-xs-vertical">
                            <div class="unit-left">
                                <div class="icon fa-envelope icon-circle text-middle text-primary"></div>
                            </div>
                            <div class="unit-body">
                                <div class="text-italic"><a href="mailto:{{ $company['email'] }}">{{ $company['email'] }}</a></div>
                            </div>
                        </div>
                        <div class="offset-top-25 offset-sm-top-10 unit unit-middle unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-xs-vertical">
                            <div class="unit-left">
                                <div class="icon fa-map-marker icon-circle text-middle text-primary"></div>
                            </div>
                            <div class="unit-body">
                                <div class="text-italic"><a href="#">{{ $company['address'] }}</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="shell footer-container footer-copyright">
            <div class="reveal-sm-flex range-sm-justify range-sm-reverse range-sm-middle">
                <div>
                    @include("landing-pages.v2.components.social-media")
                </div>
                <div class="offset-top-15 offset-sm-top-0">
                    <p>&#169; <span class="copyright-year"></span> <a href="index.html"><span class="text-primary">{{ $branding['copyright'] }}</span></a> <a href="#">Privacy Policy</a>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</div>

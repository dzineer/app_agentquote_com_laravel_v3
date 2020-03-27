        <div class="tw-bg-darkGray tw-w-full tw-text-lightGray">

                <div class="tw-w-9/12 tw-p-8 tw-mx-auto">
                    <div class="sm:tw-flex tw-justify-between tw-mb-4">

                        <div class="sm:tw-w-1/2 tw-mr-0 sm:tw-mr-8 tw-h-auto">

                            <div class="sm:tw-w-full">
                                <ul class="tw-list-reset tw-leading-normal">
                                    <li class="tw-mb-4">
                                        <a class="white tw-text-2xl" href="/">
                                            {!! $branding['company']['name'] !!}
                                        </a>
                                    </li>
                                    <li class="">
                                        We provide a full spectrum of mobile quoters and web applications for insurance agents. Focusing on Life insurance, Health, Financial Advisors, and P&C. Our quoters and website applications cover all stages of the program development life cycle and keep you one step ahead of the competition.
                                    </li>
                                </ul>
                            </div>

                        </div>
                        <div class="sm:tw-w-1/2 h-auto sm:tw-mt-0">

                            <div class="sm:tw-w-full">
                                <div class="tw-text-primary tw-text-xl tw-mt-4 sm:tw-mt-0 tw-mb-4">
                                    Contact
                                </div>

                                <ul class="tw-list-reset tw-leading-normal">
                                    <li class="hover:tw-text-blue tw-text-grey-darker">
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="phone" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>{{ $company['name'] }}</p>
                                    </li>
                                    <li class="hover:tw-text-blue tw-text-grey-darker">
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="envelope" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>{{ $company['email'] }}</p>
                                    </li>
                                    <li class="hover:tw-text-blue tw-text-grey-darker">
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="map-marker" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>{{ $company['address'] }}</p>
                                    </li>
                                </ul>

                            </div>

                        </div>

                </div>

            </div>

        </div>

        @if($book_appointment->hasLink)
        <!-- Calendly inline widget begin -->
        <div class="calendly-inline-widget" id="calendly-inline-widget" style="min-width:320px;height:580px;" data-auto-load="false">
        </div>
        <!-- Calendly inline widget end -->
        @endif

        <page-section frame-classes="tw-justify-around tw-borderr tw-roundedr tw-py-2 tw-px-2 tw-flex-wrapr" classes="tw-w-full tw-py-1" container="container-mark tw-py-1 tw-bg-black tw-text-lightGray tw-my-0" section-classes="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
            <div class="tw-flex tw-w-full tw-justify-start tw-items-center">
                <div class="tw-flex tw-flex-row tw-w-full tw-justify-center tw-items-center tw-px-20">
                    <div class="tw-flex tw-w-full tw-justify-start tw-items-center">
                        <p class="tw-text-base tw-my-1">
                            © <span class="copyright-year">2020</span> <a href="/" role="link" aria-label="Go to home page"><span class="tw-text-primary">Agent Quote Inc.</span></a> <a href="/privacy" aria-label="View our privacy & policy details">Privacy Policy</a>
                        </p>
                    </div>
                </div>
            </div>
        </page-section>
        @if( strlen($ga_code) )
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_code ?>"></script>
            <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '<?php echo $ga_code ?>');
            </script>
        @endif

        @if($book_appointment->hasLink)
        <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
        <script>
            Calendly.initInlineWidget({
                url: '{!! $book_appointment->link !!}',
                parentElement: document.getElementById('calendly-inline-widget'),
                prefill: {},
                utm: {}
            });
        </script>
        @endif



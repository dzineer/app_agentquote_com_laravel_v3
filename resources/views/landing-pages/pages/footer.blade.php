        <div class="tw-bg-darkGray tw-w-full tw-text-lightGray">

                <div class="tw-w-9/12 tw-p-8 tw-mx-auto xs:tw-w-full">
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
                                       As your insurance advisor, we help you make smart decisions—protecting you from the unexpected &amp; planning for the predictable by offering high quality insurance products &amp; services to meet your goals and budget. We&#39;ll help you understand every step in the process, so you realize your dreams while safeguarding your finances.
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
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="phone" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>
                                            <display-phone-number phone="{{ $company['phone'] }}"></display-phone-number>
                                        </p>
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

        <page-section frame-classes="tw-justify-around tw-borderr tw-roundedr tw-py-2 tw-px-2 tw-flex-wrapr" classes="tw-flex xs:tw-w-full tw-py-1" container="container-mark tw-py-1 tw-bg-black tw-text-lightGray tw-my-0" section-classes="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
            <div class="tw-flex tw-w-full tw-justify-start tw-items-center">
                <div class="tw-flex tw-flex-row tw-w-full tw-justify-center tw-items-center tw-px-20 xs:tw-px-0">
                    <div class="tw-flex tw-w-full tw-justify-start tw-items-center">
                        <p class="xs:tw-flex xs:tw-justify-between tw-text-base tw-my-1 xs:tw-w-full">
                            <span>© <span class="copyright-year">2020</span> <a href="/" role="link" aria-label="Go to home page"><span class="tw-text-primary">Agent Quote Inc.</span></a></span>
                            <span><a href="/privacy" aria-label="View our privacy & policy details">Privacy Policy</a></span>
                        </p>
                    </div>
                </div>
            </div>
        </page-section>

        <?php if( isset($ga_code) && strlen($ga_code) ) : ?>
        <!-- Global site tag (gtag.js) - Google Analytics -->
            <script type="application/javascript" async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_code ?>"></script>
            <script type="application/javascript">
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', '<?php echo $ga_code ?>');
            </script>
        <?php endif; ?>

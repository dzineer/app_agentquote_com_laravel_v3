<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   {{--  <meta name="csrf-token" content="0a8dsf09asd809f8asd0f8asd9fads"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Termlife Landing Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/landing.css">

    <style>
        .tw-box {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <div id="app">

        @include('landing-pages.pages.topbar')

        <div class="tw-w-full tw-py-8 question-3">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-8/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-justify-center tw-items-center tw-flex-col sm:tw-flex-row tw-leading-normal">
                    <div class="tw-text-2xl lg:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight tw-px-2 md:tw-px-16 tw-flex-1">

                        <a href="/#featured-tips" class="tw-flex tw-justify-start tw-items-center tw-text-2xl tw-mt-2"><i class="tw-flex tw-justify-center tw-items-center fa fa-icon icon-default fa-angle-left fa-fw tw-text-primary tw-rounded-full tw-border tw-border-primary tw-w-8 tw-h-8 tw-leading-tight tw-text-center"></i> <span class="tw-ml-2">Back</span></a>

                        <h2 class="tw-text-2xl lg:tw-text-4xl tw-my-6 tw-font-light">I already have life insurance...</h2>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            You may already have life insurance for your mortgage or line of credit, but it may not be enough to help ensure the long-term financial well-being of your loved ones. And while your employer may offer group life insurance as part of their employee benefit program, the coverage could be limited.
                        </p>

                        <p class="tw-text-2xl tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            Credit protection life insurance
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            Credit protection life insurance, such as mortgage or line of credit life insurance, is designed to pay off the full balance or a portion of the balance you owe in the event of your death. This is very valuable protection, paid directly to the financial institution you borrowed from. Your family may still need funds to cover expenses such as funeral costs, medical bills, property taxes, home improvements and maintenance and the ongoing expenses of daily living.
                        </p>

                        <p class="tw-text-2xl tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            Employee group life insurance
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            This can be an affordable way to get a modest amount of coverage – usually a small multiple of your annual salary. However, depending on your personal circumstances, it might not be enough. And, if you change employers, this insurance doesn’t automatically go with you.
                        </p>

                        <p class="tw-text-2xl tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            The advantages of having your own Life Insurance policy
                        </p>

                        <ul class="tw-my-6 tw-leading-normal tw-list-disc tw-ml-5">
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-my-4">
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">You can ensure you have the amount of insurance coverage that meets your personal circumstances</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-my-4">
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">The policy is yours and, as long as you pay the premiums, can only be cancelled or changed at your request</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-my-4">
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">You don’t have to worry about losing your coverage if you change financial institutions or jobs</p>
                            </li>
                        </ul>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            Term life insurance can be an affordable way to get the additional protection you need.
                        </p>

                    </div>

                    <div class="tw-flex tw-justify-center tw-items-center tw-flex-col tw-w-full tw-text-center tw-px-3 tw-self-start tw-flex-1">
                        <img src="/images/mixed-race-couple-looking-over-map-outside-together-happy-sites-33378252-square.jpg" class="tw-rounded-full tw-w-8/12" >
                        <p class="tw-w-full w-flex tw-justify-center tw-items-center tw-text-2xl md:tw-text-3xl tw-tracking-tight tw-w-full tw-font-light tw-my-4">Related articles</p>
                        <ul class="tw-flex tw-justify-center tw-flex-col tw-items-center tw-mx-auto">
                            <li class="tw-text-sm tw-tracking-tight tw-w-full tw-font-light tw-my-1 tw-text-left">
                                <a class="tw-text-primary tw-text-xl md:tw-text-md" href="/featured-tips/why-life-insurance-makes-sense#featured-tips" target="_self">Why life insurance makes sense</a>
                            </li>
                            <li class="tw-text-sm tw-tracking-tight tw-w-full tw-font-light tw-my-1 tw-text-left">
                                <a class="tw-text-primary tw-text-xl md:tw-text-md" href="/featured-tips/how-much-life-insurance-do-i-need#featured-tips" target="_self">How much life insurance do I need?</a>
                            </li>
                            <li class="tw-text-sm tw-tracking-tight tw-w-full tw-font-light tw-my-1 tw-text-left">
                                <a class="tw-text-primary tw-text-xl md:tw-text-md" href="/featured-tips/but-i-already-have-insurance#featured-tips" target="_self">But I already have insurance...</a>
                            </li>
                            <li class="tw-text-sm tw-tracking-tight tw-w-full tw-font-light tw-my-1 tw-text-left">
                                <a class="tw-text-primary tw-text-xl md:tw-text-md" href="/featured-tips/your-family-trusts-you-consider-burial-or-final-expense-insurance#featured-tips" target="_self">Your Family Trusts You, Consider Burial or Final Expense Insurance</a>

                            </li>
                            <li class="tw-text-sm tw-tracking-tight tw-w-full tw-font-light tw-my-1 tw-text-left">
                                <a class="tw-text-primary tw-text-xl md:tw-text-md" href="/featured-tips/what-happens-to-my-policy-if-i-change-my-mortgage#featured-tips" target="_self">What happens to my policy if I change my mortgage?</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <contact-banner phone="{{ $user->profile->contact_phone }}" offeredby="{{ $company['name'] }}"></contact-banner>

        @include('landing-pages.pages.footer')

    </div>





    <script src="/js/landing.js"></script>
    <style>
        .dz-product-box:hover .product-cover {
            opacity: 0.9;
            transition: all 0.3s;
        }

        .dz-product-box:hover .product-title {
            opacity: 0;
        }

        .bg-top {
            /*
            Original image has size of 2676 x 446
            Aspect rates as a percentage = %;
            446 (height) / 2676 (width) =  0.1666 = 16.67%
            */
            width: 100%;
            background-image: url('/images/background-1.jpg');
            background-repeat: no-repeat;
            background-size: 2676px 446px;
            background-position: 50% -46px;
            background-size: cover;
            padding-top: 16.67%;
        }
    </style>
</body>
</html>

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

        <div class="tw-w-full tw-py-8 question-1">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-8/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-justify-center tw-items-center tw-flex-col sm:tw-flex-row tw-leading-normal">
                    <div class="tw-text-2xl lg:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight tw-px-2 md:tw-px-16 tw-flex-1">

                        <a href="/#featured-tips" class="tw-flex tw-justify-start tw-items-center tw-text-2xl tw-mt-2"><i class="tw-flex tw-justify-center tw-items-center fa fa-icon icon-default fa-angle-left fa-fw tw-text-primary tw-rounded-full tw-border tw-border-primary tw-w-8 tw-h-8 tw-leading-tight tw-text-center"></i> <span class="tw-ml-2">Back</span></a>

                        <h2 class="tw-text-2xl lg:tw-text-4xl tw-my-6 tw-font-light">Why term life insurance makes sense</h2>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            Developing a financial plan is a good step towards achieving your financial goals. Life insurance can strengthen your financial plan by helping to ensure that, in case you pass away unexpectedly,
                            your loved ones will be able to maintain the lifestyle you’ve earned so they are free to pursue their dreams.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            Here are a few other benefits of TD Term Life Insurance:
                        </p>

                        <ol class="tw-my-6 tw-leading-normal">
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">It’s simple
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Term life insurance is one of the simplest forms of life insurance. You’ll always know what you’re paying for, and what your beneficiaries can expect.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">It’s more affordable
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Generally, term life insurance offers the most coverage at the lowest initial premium for a set period of time.<sup>1</sup> Plus, you can <a href="https://www.tdinsurance.com/term-life-quote">get up to 10% off</a><sup>2</sup> your term life insurance policy premium if you bundle with select TD Insurance products or you meet other eligibility criteria.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Predictable premiums
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Your premiums are fixed and guaranteed not to change for the length of the term.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">It’s flexible
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">You can also convert your TD Term 10 or TD Term 20 to permanent life insurance coverage before you turn 69 with no questions asked.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">It’s a good way to top-up existing group plans
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Your life insurance coverage through a group plan may not be enough. And if you change employers, you may lose your coverage. Having your own term life insurance policy ensures you are financially covered in the event of death despite any changes in employment or employer.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Tax-free, cash benefit
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">If you pass away during the term of your policy, your designated beneficiaries will receive a tax-free, lump-sum death benefit.</p>
                            </li>
                        </ol>
                    </div>

                    <div class="tw-flex tw-justify-center tw-items-center tw-flex-col tw-w-full tw-text-center tw-px-3 tw-self-start tw-flex-1">
                        <img src="/images/portrait-young-woman-coffee-cup-against-black-wall-casual-style-clothes-112588260-square.jpg" class="tw-rounded-full tw-w-8/12" >
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

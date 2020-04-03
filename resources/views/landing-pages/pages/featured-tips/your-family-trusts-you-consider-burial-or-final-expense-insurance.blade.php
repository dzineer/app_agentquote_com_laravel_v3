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

                        <h2 class="tw-text-2xl lg:tw-text-4xl tw-my-6 tw-font-light">Your Family Trusts You, Consider Burial or Final Expense Insurance</h2>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            With the average cost of a funeral service in the United States exceeding $12,000, loved one’s are responsible to pay that or more if you don’t have a plan in place.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            There may be no savings to cover this, or if there is, should you force your loved to use that money to pay for your burial? They could use that money for something else. It leaves your loved ones with a financial burden during such a difficult time.  It’s no wonder you’ve likely seen GoFundMe campaigns pop up all over social media.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            Truth is, buying burial insurance is a cost-effective way to make sure your funeral service and any outstanding debts are taken care of and not passed on to you loved ones. However, not all burial insurance plans are created equal.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            Here are the 5 examples to consider when looking into burial insurance coverage:
                        </p>

                        <ol class="tw-my-6 tw-leading-normal">
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Avoid “TV Ads” burial insurance
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Most companies with TV ads offering burial insurance, do not cover natural deaths for the first two years of their life insurance policy. They tell you can have coverage for the same price at any age…sound too good to be true? That’s because it is. While the price is the same coverage could be $500 or $2000 depending on your age for the same price.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Always ask for first day coverage
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">If it’s one thing we can count on…at some point our turn will come, we just don’t know when our time will be up. There are several burial insurance plans that will offer you day-one coverage regardless of how pass away for people with several medical conditions.</p>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Most “too good to be true” advertisements the coverage is delayed by two or sometimes three years before the full coverage kicks in. During those first few years your family will only receive a portion of the benefit or if you pass away due to an accident the full amount. Most people these days rarely die from an accident. You may be hurt pretty bad or even disabled but still very much alive.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Be skeptical of “Junk Mail” burial insurance
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    If you’re over 50 years old, then you receive mail from reputable burial insurance companies offering too good to be true coverage for very low prices. Most of these are usually term life insurance that cancel at age 80. Some of these start out at a low cost but when look closer, the cost goes up every 5 years until you reach a certain age and then the coverage ends. If you’re lucky enough to still be with your family, you will not get your money back nor will have any more coverage when you need it most.
                                </p>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    With the new treatments, medications, and access to quality health care we are living much longer. It’s not unusual to live well into your 80’s these days. You could easily outlive your term burial insurance plan. Always insist on whole life for your final needs plan where the cost never goes up, the benefit never goes down, nor will the policy cancel because your health changes of the years.
                                </p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">No Exams Necessary
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Unlike most other forms of life insurance, burial insurance does not require a physical to qualify for a competitively priced plan. Most of these policies are issued to people age 50 to 85 years old specifically designed to be simple for people to understand and easy to qualify.
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    Some burial insurance plans have only a few questions while others have no questions all to qualify. Regardless of which one you qualify for insist on a whole life burial plan and worries will be over protecting your family.</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">Work with a burial insurance broker
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Unlike someone who represents only one burial insurance company, a broker represents several companies. A broker can do all the shopping around for able to quote from different burial insurance companies. Presenting you with a burial plan you’ll qualify for with the best price.</p>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">Representing several burial insurance companies means the Broker works for you meeting your goals and budget. Those that only represent one company work for that company and push people into their plan regardless if that plan is in your best interest.</p>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">In the end, getting a whole life burial insurance plan gives your loved ones the coverage they’ll need and will last your entire lifetime. The policies are flexible to fit any budget tailoring the benefit to your individual needs.</p>
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

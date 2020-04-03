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

                        <h2 class="tw-text-2xl lg:tw-text-4xl tw-my-6 tw-font-light">What happens to my policy if I change my mortgage?</h2>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            If you are changing your mortgage there are a number of things to consider, depending on whether you are accessing equity or extending your mortgage term, refinancing or paying your mortgage off early.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">
                            Accessing Home Equity
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            If you are accessing equity from your home, you will need to make sure that your policy meets the new value of your mortgage.
                        </p>

                        <ol class="tw-my-6 tw-leading-normal">
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    You could get a new mortgage protection policy for the total amount of your new mortgage, or just for the home equity amount.
                                </p>
                            </li>
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    Compare the costs and benefits of both options. It may be cheaper to keep your original mortgage protection policy and then buy a second policy for the equity amount. Check the cost of cancelling the original policy and replacing it with a policy for the full amount of your new mortgage.
                                </p>
                            </li>
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    Whether you are accessing home equity or extending the term and need to get a new policy, you may find that your premium is higher than the last time you took out coverage. This is because you are older, and your age affects your premium and the benefit may be higher or the term longer.
                                </p>
                            </li>
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    Be cautious of your health. If your health hasn’t changed for the better, you may no longer qualify for a new policy. However, if you have given up smoking, or if rates have come down since the last time you applied for coverage, you may be able to get cheaper coverage.
                                </p>
                            </li>
                        </ol>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">
                            Switching your mortgage lender (refinancing)
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            Your options depend on whether you have your own policy or a group policy through your lender.
                        </p>

                        <ol class="tw-my-6 tw-leading-normal tw-list-disc tw-list-inside">
                            <li><p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                                    If you have your own policy, then nothing really needs to be done. You and your family simply discuss the goals of your policy and the new lender. It is a good time to review your coverage to see if the policy is still meeting your goals.
                                </p>
                            </li>
                            <li><p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                                    If you have a policy through your lender’s group arrangement, your lender will cancel the policy when you switch your mortgage lender.
                                </p>
                            </li>
                            <li><p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                                    If you must get a new policy it may cost you more, as you will be older than when you first took out the policy. If you are not in good health, you will have to pay a higher premium, or you may not be able to get coverage at all to pay off your mortgage.
                                </p>
                            </li>
                            <li><p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                                    You may, however, be able to qualify for a policy to pay down your mortgage or protect your monthly payments for a given period of time. Protecting your mortgage payments will give your family time to figure out their next steps without the worry of how they’ll pay the monthly mortgage premium.
                                </p>
                            </li>
                        </ol>


                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">
                            Paying off your mortgage early
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            You generally have a couple of options if you are in a position to pay off your mortgage early. If your mortgage protection policy has cash value, you could borrow that cash to pay off the mortgage balance.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            You can cancel your mortgage protection coverage and pay no more, or, keep the policy and continue paying until the original end date changing the goal of the policy benefit. Perhaps additional retirement income for family, etc.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4 tw-font-semibold">
                            Keeping the policy
                        </p>

                        <ol class="tw-my-6 tw-leading-normal tw-list-disc tw-list-inside">
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    If you decide to keep paying for the policy after paying off the mortgage, you will still be covered by the policy in full up until it expires.
                                </p>
                            </li>
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    As most mortgage protection policies are funded through a term life insurance policy, it could be convertible. Meaning if the policy is “convertible” then you could decide to convert some or all of the benefit to a permanent life insurance policy. The cost for the new converted policy will be higher than the original policy, however, there are no health qualifications for this change. A great feature if your health has changed preventing you from getting a new life insurance policy.
                                </p>
                            </li>
                            <li>
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                                    If you die before the policy expires, the benefit would no longer need to be used to pay off or pay down your mortgage. So, any benefit would be paid to your beneficiaries tax-free.
                                </p>
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

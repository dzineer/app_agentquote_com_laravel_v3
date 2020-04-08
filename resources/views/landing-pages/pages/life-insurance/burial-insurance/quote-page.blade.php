<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   {{--  <meta name="csrf-token" content="0a8dsf09asd809f8asd0f8asd9fads"> --}}
    <meta name="description" content="The benefits of term life insurance can provide the financial security you need to help protect your family’s future. We offer life insurance quotes for coverage that fits your needs. Get a personalized life insurance assessment, using our needs analyser in minutes. Calculate your life insurance coverage today!" />
    <meta name="keywords" content="Life Insurance, Life Insurance USA, Life Insurance Quotes, Term Life Insurance"> <!-- based on insurance type -->
    <link rel="canonical" href="https://DOMAIN/products-services/life-insurance/INSURANCE_TYPE" />

    <meta name="google-site-verification" content="GOOGLE_SITE_VERIFICATION"/>
    <meta name="robots" content="index, follow">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Burial Insurance</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico"
	type="image/vnd.microsoft.icon" />
    <link rel="stylesheet" href="/css/fonts.css">
    <link rel="stylesheet" href="/css/landing.css">

    <script type='application/ld+json'>
    {
        "@context":"https://schema.org",
        "@graph":[{
            "@type":"Organization",
            "@id":"https://www.agentquote.com/#organization",
            "name":"Agent Quote Inc",
            "url":"https://www.agentquote.com/",
            "sameAs":[
                "https://www.facebook.com/AgentQuoteInc/",
                "https://www.linkedin.com/company/agentquote-inc",
                "https://www.youtube.com/channel/AGENTQUOTE-ID",
                "https://twitter.com/AgentQuoteInc"
            ],
            "logo":{
                "@type":"ImageObject","@id":"https://www.agentquote.com/#logo",
                "url":"https://ppegram.quotedirect.org/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png",
                "width":300,
                "height":82,
                "caption":"Agent Quote Inc"
                },
                "image":{
                    "@id":"https://www.agentquote.com/#logo"
                }
            },
            {
                "@type":"WebSite",
                "@id":"https://www.agentquote.com/#website",
                "url":"https://www.agentquote.com/",
                "name":"Agent Quote Inc",
                "publisher":{
                    "@id":"https://www.agentquote.com/#organization"
                },
                "potentialAction":{
                    "@type":"SearchAction",
                    "target":"https://www.agentquote.com/?s={search_term_string}",
                    "query-input":"required name=search_term_string"
                }
            },
            {
                "@type":"WebPage",
                "@id":"https://www.agentquote.com/#webpage",
                "url":"https://www.agentquote.com/",
                "inLanguage":"en-US",
                "name":"Agent Quote Insurance Agency, Website, Agency Marketing &amp; Leads | Agent Quote Inc.",
                "isPartOf":{
                    "@id":"https://www.agentquote.com/#website"
                },
                "about":{
                    "@id":"https://www.agentquote.com/#organization"
                },
                "datePublished":"2020-01-03T20:10:11-04:00",
                "dateModified":"2020-01-03T20:53:07-05:00",
                "description": "The benefits of term life insurance can provide the financial security you need to help protect your family’s future. We offer life insurance quotes for coverage that fits your needs. Get a personalized life insurance assessment, using our needs analyser in minutes. Calculate your life insurance coverage today!"
            }
        ]}

    </script>

    <style>
        .tw-box {
            background-color: #f3f3f3;
        }
    </style>
</head>
<body>
    <div id="app">

        @include('landing-pages.pages.topbar')

        <section-view :view="true">
                <div class="tw-w-full">
                    <div class="tw-w-11/12 tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-8/12 md:tw-w-11/12 lg:tw-w-8/12 xs:tw-w-full tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                        <div class="tw-w-full md:tw-w-1/2 tw-flex tw-flex-col tw-justify-center tw-items-center">
                            <img src="/images/134_1091_hro_3277-3.jpg" alt="Girl playing with her mother" class="tw-self-start">
                        </div>
                        <div class="tw-w-full md:tw-w-1/2 py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center tw-border-b md:tw-border-0">
                            <p class="tw-text-2xl xl:tw-text-3xl tw-tracking-tight">
                                Feel confident knowing you have the coverage you need
                            </p>
                            <p class="tw-text-md tw-tracking-tight tw-my-6">
                                Get a quote and apply online or you can speak to an available Advisor at
                                <span class="tw-text-primary">
                                    <display-phone-number phone="{{ $user->profile->contact_phone }}"></display-phone-number>
                                </span>.
                            </p>
                        </div>
                    </div>
                </div>
        </section-view>

        <signup :benefit-limits="benefitLimits" userid="47" :signing-up="showSignup" insurance-category="fe" ></signup>
        <quote :show="showQuote" :quote-details="quote" :items="quote.items" :can-requote="true" insurance-category="fe"></quote>
        <contact-banner phone="{{ $user->profile->contact_phone }}" offeredby="{{ $company['name'] }}"></contact-banner>

        <a href="#featured-tips"></a>

        <section-view :view="true">
                @include('landing-pages.pages.life-insurance.burial-insurance.featured-tips');
        </section-view>

        <section-view :view="true">
            <div class="tw-w-full tw-py-16 xs:tw-py-0">
                <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-11/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                    <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center tw-leading-normal">
                        <p class="tw-text-3xl xl:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight">What is Burial Insurance?</p>
                        <p class="tw-text-xl tw-tracking-loose tw-w-full tw-font-light tw-text-left sm:tw-text-center">Burial insurance, sometimes referred to as final expense insurance, is a life insurance policy designed to cover funeral costs and other final expenses like medical bills and even lost wages due to time away from work. Burial insurance is a popular option for seniors who no longer have children who are dependent on them financially, but still want some coverage for those final expenses.</p>
                        <p class="tw-text-xl tw-my-4 tw-tracking-loose tw-w-full tw-font-light tw-text-left sm:tw-text-center">Burial Insurance Features you&rsquo;ll enjoy:</p>
                        <ul class="tw-my-8 tw-w-10/12 sm:tw-w-10/12 md:tw-w-9/12 tw-mx-auto tw-list-disc">
                            <li class="tw-mb-4 tw-text-md">Coverage up to $100,000.</li>
                            <li class="tw-mb-4 tw-text-md">A guaranteed monthly or annual cost over the entire life of the policy, which is great when it comes to budgeting your money.</li>
                            <li class="tw-mb-4 tw-text-md">Guaranteed benefit amount that will never change.</li>
                            <li class="tw-mb-4 tw-text-md">Policy will never expire, nor can it ever be canceled unless you decide, as long as premiums are paid.</li>
                            <li class="tw-mb-4 tw-text-md">No Exams are required just a simple application with a few questions.</li>
                            <li class="tw-mb-4 tw-text-md">Some policies are guaranteed acceptance with no questions. Perfect for those people that could not get coverage in the past.</li>
                        </ul>
                        <p class="tw-text-2xl tw-my-8 tw-w-10/12 sm:tw-w-10/12 md:tw-w-9/12 tw-mx-auto tw-text-center">3 options to choose from:</p>
                        <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-w-full">
                            <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-left tw-px-10 xs:tw-px-0 tw-border-0 md:tw-border-r tw-py-5 tw-flex-1">
                                <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Term Life</h3>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">Term insurance provides your family with financial security covering you for a term of one or more years and generally offers the largest insurance protection for your premium dollar.</p>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Term Life could be right for you if:</p>
                                <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-3">
                                    <li class="tw-mb-4 tw-text-md">Provide your family financial independence</li>
                                    <li class="tw-mb-4 tw-text-md">Make sure your kids have college tuition funding</li>
                                    <li class="tw-mb-4 tw-text-md">Pay off credit cards and other debts</li>
                                    <li class="tw-mb-4 tw-text-md">Replace your income for several years</li>
                                    <li class="tw-mb-4 tw-text-md">Make Life More Comfortable for Your Loved Ones</li>
                                </ul><a href="/products-services/life-insurance/term-life" aria-label="Get A Term life quote" class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center">Get A Quote</a>
                            </div>
                            <div class="tw-flex tw-flex-col tw-justify-start tw-items-center tw-text-left tw-px-12 xs:tw-px-0 tw-border-0 md:tw-border-r tw-py-5 tw-flex-1">
                                <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Burial Insurance</h3>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">This is Whole Life Insurance that can cover you for as long as you live. Final Expense or burial insurance ensures our families will not be burned with the cost of our funeral.</p>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Burial Insurance could be right for you if:</p>
                                <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-3">
                                    <li class="tw-mb-4 tw-text-md">You Can Take Control of Planning Your Funeral</li>
                                    <li class="tw-mb-4 tw-text-md">Provide your family with financial aid for medical bills</li>
                                    <li class="tw-mb-4 tw-text-md">To serve as a gift for your loved ones</li>
                                    <li class="tw-mb-4 tw-text-md">To pay off estate taxes</li>
                                    <li class="tw-mb-4 tw-text-md">Allows your family to pay off your personal loans</li>
                                </ul><a href="/products-services/life-insurance/burial-insurance" aria-label="Get A Term life quote" class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center">Get A Quote</a>
                            </div>
                            <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-left tw-mx-10 xs:tw-mx-0 tw-py-5 tw-flex-1">
                                <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Mortgage Protection</h3>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">Protect one of your largest investments, your home. Mortgage protection helps protect you from life's unexpected events i.e. disability, unemployment, critical illness, and premature death.</p>
                                <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Mortgage Protection could be right for you if:</p>
                                <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-2">
                                    <li class="tw-mb-4 tw-text-md">You have an outstanding Mortgage on your house</li>
                                    <li class="tw-mb-4 tw-text-md">You need money for mortgage payments if you become unemployed or disabled</li>
                                    <li class="tw-mb-4 tw-text-md">You want your family to live debt free</li>
                                    <li class="tw-mb-4 tw-text-md">Provide your loved ones with additional tax-free income to create an estate</li>
                                </ul>
                                <a href="/products-services/life-insurance/mortgage-protection" aria-label="Get A Final Expense quote" class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center">Get A Quote</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section-view>

        <section-view :view="true">
            @include('landing-pages.pages.life-insurance.burial-insurance.get-ready-banner')
        </section-view>

        <button id="scrollToTopButton" onclick="scrollToTop()" class="tw-fixed tw-text-2xl tw-mt-2 tw-outline-none" style="bottom: 8px;right: 8px;"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-up fa-fw tw-text-white tw-rounded-full tw-border tw-border-primary tw-bg-blue-500 tw-border-0 hover:tw-bg-blue-400 hover:tw-opacity-100 tw-w-16 tw-h-16 tw-leading-tight tw-text-center" role="button" aria-label="Go back to the top of the page." style="background-color: #3c8dbc;opacity:0.4;"></i></button>

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

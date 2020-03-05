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
    <title>Termlife Landing Page</title>
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

        <top-bar :icons="socialMediaIcons" :items="topMenuItems"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        
        <header-logo path="/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png" target="self" link="/"></header-logo>

        <div class="tw-w-full">
            <div class="tw-w-11/12 tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-8/12 md:tw-w-11/12 lg:tw-w-8/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full md:tw-w-1/2 tw-flex tw-flex-col tw-justify-center tw-items-center">
                    <img src="/images/134_1091_hro_3277-3.jpg" alt="Girl playing with her mother" class="tw-self-start">
                </div>
                <div class="tw-w-full md:tw-w-1/2 py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center tw-border-b md:tw-border-0">
                    <p class="tw-text-2xl xl:tw-text-3xl tw-tracking-tight">
                        Feel confident knowing you have the coverage you need
                    </p>
                    <p class="tw-text-md tw-tracking-tight tw-my-6">
                        Get a quote and apply online or you can speak to an available Advisor at 1-888-223-4773.
                    </p>
                </div>
            </div>
        </div>

        <signup :benefit-limits="benefitLimits" userid="47" :signing-up="showSignup" :insurance-category="category" ></signup>
        <quote :show="showQuote" :quote-details="quote" :items="quote.items" :can-requote="true" :insurance-category="category"></quote>
        <contact-banner phone="1-888-223-4773" offeredby="Agent Quote Inc."></contact-banner>
        
        <a href="#featured-tips"></a>

       {{--  <page-sections sections="" :display="true"></page-sections> --}}

        {{-- <page-section frame-classes="tw-justify-around tw-borderr tw-roundedr tw-py-2 tw-px-2 tw-flex-wrapr" classes="tw-w-full tw-py-2" container="container-mark tw-py-8 tw-bg-alabaster tw-my-0" section-classes="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
            <div class="tw-flex tw-w-1/2 tw-justify-center tw-items-center">
                <img class="img-responsive" src="http://ppegram.staging.agentquoter.com/templates/landing-pages/v2/images/home-01-550x550.jpg" alt="" width="550" height="550">
            </div>
            <div class="tw-flex tw-w-1/2 tw-bg-red-700-off tw-justify-start tw-items-center">
                <div class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center">

                    <h3 class="tw-text-primary tw-text-5xl tw-font-bold tw-self-start">About us</h3>
                    <div class="tw-self-start tw-leading-relaxed">
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3">Our dental clinic has been founded in 2010. The founder is an honorable alumni of NYC's Columbia medical school - Mark Hoffmann, MD.</h4>
                        <p class="tw-text-base tw-mb-3">After 8 previous years of practicing, he and his colleagues collaborated to found their own clinic. Coming from backgrounds of miscellaneous dental institutions of the US, they complement each other. Their common clinic became known as DentalPlus!</p>
                        <p class="tw-text-base tw-mb-3">The state of Pennsylvania highly appreciates our contribution to state's dental healthcare. Just as our local patients in the upstate Potter county of Pennsylvania.</p>
                        <p class="tw-text-base tw-mb-3">We combine extensive record of practical experience with an equal focus on customer service approach. In the last 6 years, our dental clinic grew a list of returning clients!</p>
                        <p class="tw-italic">We look forward to you becoming one of them as well!</p>
                    </div>    

                </div>
           
            </div>
        </page-section> --}}

        {{-- <page-section frame-classes="tw-justify-around tw-borderr tw-roundedr tw-py-2 tw-px-2 tw-flex-wrapr" classes="tw-w-full tw-py-2" container="container-mark tw-py-8 tw-bg-white tw-my-0" section-classes="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
            <div class="tw-flex tw-w-full tw-bg-red-700-off tw-justify-start tw-items-center">
                <div class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center tw-px-20">

                    <h3 class="tw-text-primary tw-text-5xl tw-font-bold tw-text-center">Life Insurance</h3>
                    

                    <div class="tw-self-start tw-leading-relaxed">
                        
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Why do I need Life Insurance?</h4>
                        <p class="tw-text-base tw-mb-3">Life insurance is an essential part of financial planning. One reason most people buy life insurance is to replace income that would be lost with the death of a wage earner. The cash provided by life insurance also can help ensure that your dependents are not burdened with significant debt when you die. Life insurance proceeds could mean your dependents will not have to sell assets to pay outstanding bills or taxes. An important feature of life insurance is that generally no income tax is payable on proceeds paid to beneficiaries. The death benefit of a life policy owned by a C corporation may be included in the calculation of the alternative minimum tax.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">How much Insurance do I need?</h4>
                        <p class="tw-text-base tw-mb-3">Before buying life insurance, you should assemble personal financial information and review your family's needs. There are a number of factors to consider when determining how much protection you should have. These include:</p>
                        <p class="tw-text-base tw-mb-3">Although there is no substitute for a careful evaluation of the amount of coverage needed to meet your needs, one rule of thumb used: five to seven times annual gross income.</p>
                        <p class="tw-text-base tw-mb-3">If you want to be more precise, take the time and complete the Needs Analyzer</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Choosing A Plan</h4>
                        <p class="tw-text-base tw-mb-3">Buying life insurance is not like any other purchase you will make. When you pay your premiums, you're buying the future financial security of your family that only life insurance can provide. Among its many uses, life insurance helps ensure that, when you die, your dependents will have the financial resources needed to protect their home and the income needed to run a household.</p>
                        <p class="tw-text-base tw-mb-3">Choosing a life insurance product is an important decision, but it often can be complicated. As with any other major purchase, it is important that you understand your needs and the options available to you.</p>
                        <p class="tw-text-base tw-mb-3">The main types of life insurance available are term and permanent. Term insurance provides protection for a specified period of time. Permanent insurance provides lifelong protection.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">&nbsp;</h4>
                        <p>&nbsp;</p>
                    


                    </div>    

                </div>
           
            </div>
        </page-section> --}}        

        {{-- <page-section frame-classes="tw-justify-around tw-borderr tw-roundedr tw-py-2 tw-px-2 tw-flex-wrapr" classes="tw-w-full tw-py-2" container="container-mark tw-py-8 tw-bg-alabaster tw-my-0" section-classes="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
            <div class="tw-flex tw-w-full tw-bg-red-700-off tw-justify-start tw-items-center">
                <div class="tw-flex tw-flex-col tw-w-full tw-justify-center tw-items-center tw-px-20">

                    <h3 class="tw-text-primary tw-text-5xl tw-font-bold tw-text-center">Glossary</h3>
                    
                    <div class="tw-self-start tw-leading-relaxed">
                        
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Accidental Death Benefit:</h4>
                        <p class="tw-text-base tw-mb-3">An extra death benefit amount that is paid out in addition to the face amount of the policy if the insured dies as the result of an accident. It cost extra to get this benefit, and usually cannot exceed $250,000 to $300,000, and cannot exceed more than the face amount of the policy.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Accelerated Death Benefit Option:</h4>
                        <p class="tw-text-base tw-mb-3">In the event of terminal illness, usually l year or less, the insured has the option to withdraw some of the death benefit for personal use. Usually no more than 25% and usually not exceeding $250,000. This option is usually free and is offered by some insurance companies.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Age:</h4>
                        <p class="tw-text-base tw-mb-3">Most insurance companies calculate age by using the age you are nearest to. Example: Insured is 45 and it is January, and the insured's birthday is in March. If the insurance company was calculating age nearest, the insured would be considered age 46 for the purpose of calculating rates.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Assignment:</h4>
                        <p class="tw-text-base tw-mb-3">The transfer of the ownership rights of a Life Insurance policy from one person to another.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Aviation Hazard:</h4>
                        <p class="tw-text-base tw-mb-3">The extra hazard of death or injury resulting from participation in aeronautics. It usually does not include fare-paying passengers in licensed aircraft. This generally will require paying extra premium or the waiving of certain benefits of coverage.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Backdating:</h4>
                        <p class="tw-text-base tw-mb-3">A procedure for making the effective date of a policy earlier than the application date. Backdating is often used to make the age at issue lower than it actually was in order to get lower premium. State laws often limit to six months the time to which policies can be backdated .</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Beneficiary:</h4>
                        <p class="tw-text-base tw-mb-3">The person designated to receive the death benefit when the insured dies.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Business Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">Policies written for business purposes, such as key employee, buy-sell, business loan protection, etc.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Buy-Sell Agreement:</h4>
                        <p class="tw-text-base tw-mb-3">An agreement among owners in a business which states the under certain conditions, i.e., disability or death, the person leaving the business or in case of death, his heirs are legally obligated to sell their interest to the remaining owners, and the remaining owners are legally obligated to buy at a price fixed in the Buy-Sell agreement. The funding vehicles are either disability or life insurance or both.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Children's Term Insurance Rider:</h4>
                        <p class="tw-text-base tw-mb-3">Provides term insurance to the insured's dependents. It is a flat premium for all his dependents and the benefit usually is not less than $1,000 or more than $10,000.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Collateral Assignment:</h4>
                        <p class="tw-text-base tw-mb-3">Assign all or part of a life insurance policy as security for a loan. If the insured dies the creditor would receive only the amount due on the loan.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Conditional Binding Receipt:</h4>
                        <p class="tw-text-base tw-mb-3">This is the more exact terminology for what is often called a binding receipt. It provides that if premium accompanies an application, the coverage will be in force from the date of application, or medical examination, if any, whichever is later, provided the insurer would have issued the coverage on the basis of the facts revealed on the application, medical examination and other usual sources of underwriting information. This coverage usually has a limit until the policy is delivered and all delivery requirements are met. A life and health insurance policy without a conditional binding receipt is not effective until it is delivered to the insured and the premium is paid.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Contestable Clause:</h4>
                        <p class="tw-text-base tw-mb-3">A provision in an insurance policy setting forth the conditions under which or the period of time during which the insurer may contest or void the policy. After that time has lapsed, normally two years, the policy cannot be contested. Example: Suicide.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Contingent Beneficiary:</h4>
                        <p class="tw-text-base tw-mb-3">A person or persons named to receive policy benefits if the primary beneficiary is deceased at the time the benefits become payable.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Convertible (conversion):</h4>
                        <p class="tw-text-base tw-mb-3">A policy that may be changed to another form by contractual provision and without evidence of insurability. Most term policies are convertible into permanent insurance.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Credit Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">Insurance on a debtor in favor of a creditor to pay off the balance due on a loan in the event of the death of the debtor.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Cross Purchase:</h4>
                        <p class="tw-text-base tw-mb-3">A form of business life insurance in which each party purchases life insurance on each other.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Decreasing Term:</h4>
                        <p class="tw-text-base tw-mb-3">A form of life insurance that provides a death benefit which declines throughout the term of the contract, reaching zero at the end of the term.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Delivery:</h4>
                        <p class="tw-text-base tw-mb-3">The actual placing of a life insurance policy in the hands of an insured.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Double Indemnity:</h4>
                        <p class="tw-text-base tw-mb-3">Payment of twice the basic benefit in the event of loss resulting from specified causes or under specified circumstances.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Entity Agreement:</h4>
                        <p class="tw-text-base tw-mb-3">A buy-sell agreement in which the company agrees to purchase the interest of a deceased or disabled partner.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Evidence of Insurability:</h4>
                        <p class="tw-text-base tw-mb-3">The statement of information needed for the underwriting of an insurance policy.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Examination:</h4>
                        <p class="tw-text-base tw-mb-3">The medical examination of an applicant for Life Insurance.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Examiner:</h4>
                        <p class="tw-text-base tw-mb-3">A physician, nurse, or para-med appointed by the medical director of a life insurance company to examine applicants.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Expiry:</h4>
                        <p class="tw-text-base tw-mb-3">The termination of a term life insurance policy at the end of its period of coverage.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Face:</h4>
                        <p class="tw-text-base tw-mb-3">The first page of a life insurance policy.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Face Amount:</h4>
                        <p class="tw-text-base tw-mb-3">The amount of insurance provided by the terms of an insurance contract, usually found on the face of the policy. In a life insurance policy, the death benefit.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Fixed Benefit:</h4>
                        <p class="tw-text-base tw-mb-3">A benefit, the dollar amount of which does not vary.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Free Look:</h4>
                        <p class="tw-text-base tw-mb-3">A period of time(usually 10, 20, or 30 days) during which a policyholder may examine a newly issued individual life insurance policy, and surrender it in exchange for a full refund of premium if not satisfied for any reason.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insurability:</h4>
                        <p class="tw-text-base tw-mb-3">Acceptability to the insurer of an application for insurance.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insurable Interest:</h4>
                        <p class="tw-text-base tw-mb-3">You have an insurable interest in the insured if upon the death of the insured you would suffer financial loss.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">A formal social device for reducing risk by transferring the risks of several individual entities to an insurer. The insurer agrees, for a consideration, to pay for the loss in the amount specified in the contract.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insurance Policy:</h4>
                        <p class="tw-text-base tw-mb-3">The printed form which serves as the contract between an insurer and an insured.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insured:</h4>
                        <p class="tw-text-base tw-mb-3">The party, who is being insured. In life insurance, it is the person because of his or her death the insurance company would pay out a death benefit to a designated beneficiary.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Insurer:</h4>
                        <p class="tw-text-base tw-mb-3">The company that pays out the death benefits if the insured dies.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Irrevocable Beneficiary:</h4>
                        <p class="tw-text-base tw-mb-3">A beneficiary that cannot be changed without his or her consent.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Key Person (Key Man) Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">Insurance on the life of a key employee whose death would cause the employer financial loss. The policy is owned and payable to the employer.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Lapsed Policy:</h4>
                        <p class="tw-text-base tw-mb-3">A Insurance policy which has been allowed to expire because of nonpayment of premiums. In a cash value life insurance policy such as Whole Life or Universal Life the policy could expire because the cash value account reached a zero balance and no premium payments are being made to replenish it.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Level Term Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">A type of policy which provides coverage at a fixed rate of payments for a limited period of time. After that period expires, coverage at the previous rate is no longer guaranteed.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Life Expectancy:</h4>
                        <p class="tw-text-base tw-mb-3">The average number of years remaining for a person of a given age to live as shown on the mortality or annuity table used as a reference.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Life Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">An agreement that guarantees the payment of a stated amount of monetary benefits upon the death of the insured.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Medical Information Bureau (MIB):</h4>
                        <p class="tw-text-base tw-mb-3">A data service that stores coded information on the health histories of persons who have applied for insurance from subscribing companies in the past. Most Life insurers subscribe to this bureau to get more complete underwriting information.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Mortality Charge:</h4>
                        <p class="tw-text-base tw-mb-3">The charge for the element of pure insurance protection in a life insurance policy.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Mortality Cost:</h4>
                        <p class="tw-text-base tw-mb-3">The first factor considered in life insurance premium rates. Insurers have an idea of the probability that any person will die at any particular age; this is the information shown on a mortality table.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Mortality Rate:</h4>
                        <p class="tw-text-base tw-mb-3">The number of deaths in a group of people, usually expressed as deaths per thousand.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Mortality Table:</h4>
                        <p class="tw-text-base tw-mb-3">A table showing the incidence of death at specified ages.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Mortgage Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">A life policy covering a mortgagor from which the benefits are intended to pay off the balance due on a mortgage upon the death of the insured.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Nonmedical (Non-Med):</h4>
                        <p class="tw-text-base tw-mb-3">A contract of life insurance underwritten on the basis of an insured's statement of his health with no medical examination required.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Not Taken:</h4>
                        <p class="tw-text-base tw-mb-3">Policies applied for and issued but rejected by the proposed owner and not paid for.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Occupational Hazard:</h4>
                        <p class="tw-text-base tw-mb-3">A condition in an occupation that increases the peril of accident, sickness, or death. It usually will mean higher premiums.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Ownership:</h4>
                        <p class="tw-text-base tw-mb-3">All rights, benefits and privileges under life insurance policies are controlled by their owners. Policy owners may or may not be the insured. Ownership may be assigned or transferred by written request of current owner.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Permanent Life Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">A term loosely applied to Life Insurance policy forms other than Group and Term, usually Cash Value Life Insurance, such as Whole Life Insurance or Universal Life.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Policy Fee:</h4>
                        <p class="tw-text-base tw-mb-3">The policy fee is a flat dollar amount add to each policy.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Preauthorized Check Plan:</h4>
                        <p class="tw-text-base tw-mb-3">A premium-paying arrangement by which the policy owner authorizes the insurer to draft money from his or her bank account for the payments. This is usually done on a monthly basis.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Preferred Risk:</h4>
                        <p class="tw-text-base tw-mb-3">Any risk considered to be better than the standard risk on which the premium rate was calculated.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Premium:</h4>
                        <p class="tw-text-base tw-mb-3">The price of insurance protection for a specified risk for a specified period of time.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Primary Beneficiary:</h4>
                        <p class="tw-text-base tw-mb-3">The beneficiary named as first in line to receive proceeds or benefits from a policy when they become due.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Provisions:</h4>
                        <p class="tw-text-base tw-mb-3">Statements contained in an insurance policy which explain the benefits, conditions and other features of the insurance contract.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Rated:</h4>
                        <p class="tw-text-base tw-mb-3">Coverage's issued at a higher rate than standard.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Renewable Term:</h4>
                        <p class="tw-text-base tw-mb-3">Term insurance that may be renewed for another term without evidence of insurability. Level term usually turns into renewable term with increasing premiums after the level premium period.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Replacement:</h4>
                        <p class="tw-text-base tw-mb-3">A new policy written to take the place of one currently in force.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Revocable Beneficiary:</h4>
                        <p class="tw-text-base tw-mb-3">The beneficiary in a life insurance policy in which the owner reserves the right to revoke or change the beneficiary. Most policies are written with a revocable beneficiary.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Rider:</h4>
                        <p class="tw-text-base tw-mb-3">An attachment to a policy that modifies its conditions by expanding or restricting benefits or excluding certain conditions from coverage.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Standard Risk:</h4>
                        <p class="tw-text-base tw-mb-3">A risk that is on a par with those on which the rate has been based in the areas of health, physical condition, and lifestyle. An average risk, not subject to rate loading or restrictions because of health. At one time the best class of risk was the standard class. As the insurers improved their underwriting skills, they were able to define those in very good health and offer them lower rates with better underwriting classes.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Stock Purchase Agreement:</h4>
                        <p class="tw-text-base tw-mb-3">A formal buy-sell agreement whereby each stockholder is bound by the agreement to purchase the shares of a deceased stockholder and the heirs are obligated to sell. This agreement is usually funded with life insurance.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Stock Redemption Agreement:</h4>
                        <p class="tw-text-base tw-mb-3">A formal buy-sell agreement whereby the corporation is bound by the agreement to purchase the shares of a deceased stockholder and the heirs are obliged to sell. This agreement is usually funded with life insurance.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Underwriter:</h4>
                        <p class="tw-text-base tw-mb-3">A technician trained in evaluating risks and determining rates and coverage for them. When an application is submitted to the insurer, it is the underwriter who gathers all the necessary information to determine whether a person is a preferred risk, a standard risk, or rated.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Underwriting:</h4>
                        <p class="tw-text-base tw-mb-3">It is what the underwriter does to determine the class of risk an applicant will be placed in.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Universal Life:</h4>
                        <p class="tw-text-base tw-mb-3">Universal life insurance (often shortened to UL) is a type of permanent life insurance. Under the terms of the policy, the excess of premium payments above the current cost of insurance is credited to the cash value of the policy. The cash value is credited each month with interest, and the policy is debited each month by a cost of insurance (COI) charge, as well as any other policy charges and fees which are drawn from the cash value, even if no premium payment is made that month. Interest credited to the account is determined by the insurer, but has a contractual minimum rate.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Waiver of Premium:</h4>
                        <p class="tw-text-base tw-mb-3">A provision of a life insurance policy which continues the coverage without further premium payments if the insured becomes totally disabled.</p>
                        <h4 class="tw-text-primary tw-text-2xl tw-mb-3 tw-mt-8 tw-font-semibold">Whole Life Insurance:</h4>
                        <p class="tw-text-base tw-mb-3">Whole life insurance, is a life insurance policy that remains in force for the insured's whole life and requires (in most cases) premiums to be paid every year into the policy.</p>

                    </div>    

                </div>
           
            </div>
        </page-section>  --}}    

        

        <div class="tw-w-full tw-py-8 tw-bg-gray-200">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-11/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center tw-leading-normal">

                    <p id="featured-tips" class="tw-text-2xl xl:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight"  aria-label="Three Features Below">
                        Featured Tips
                    </p>
                    
                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-center tw-items-center tw-w-full">
                        
                        <a href="/featured-tips/why-life-insurance-makes-sense" class="tw-cursor-pointer" aria-labelledby=="why-life-insurance-makes-sense"><div class="tw-relative tw-w-full tw-flex tw-justify-center tw-items-center tw-relative dz-product-box dz-product-box tw-my-2 md:tw-my-0">
                            <img src="/images/portrait-young-woman-coffee-cup-against-black-wall-casual-style-clothes-112588260.jpg">
                            <div class="tw-absolute tw-bg-blue-600 tw-inset-0 tw-opacity-0 product-cover tw-flex tw-flex-col tw-justify-center tw-justify-items">
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-text-xl tw-text-center tw-px-1" id="why-life-insurance-makes-sense">Why life insurance makes sense</p>
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-mt-2 tw-px-6"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-right fa-fw tw-text-white tw-rounded-full tw-border tw-w-12 tw-h-12 tw-leading-tight fa-2x tw-text-center"></i></p>
                            </div>
                            <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-flex tw-justify-center tw-items-center tw-bg-white product-title">
                                <p class="tw-p-4">Why life insurance makes sense</p>
                            </div>
                        </div></a>                    

                        <a href="/featured-tips/how-much-life-insurance-do-i-need" class="tw-cursor-pointer" aria-labelledby="how-much-life-insurance-do-i-need"><div class="tw-relative tw-w-full tw-flex tw-justify-center tw-items-center tw-relative dz-product-box dz-product-box tw-my-2 md:tw-my-0">
                            <img src="/images/couple-using-ipad-love-62740068.jpg">
                            <div class="tw-absolute tw-bg-blue-600 tw-inset-0 tw-opacity-0 product-cover tw-flex tw-flex-col tw-justify-center tw-justify-items">
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-text-xl tw-text-center tw-px-1" id="how-much-life-insurance-do-i-need">How much life insurance do I need?</p>
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-mt-2 tw-px-6"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-right fa-fw tw-text-white tw-rounded-full tw-border tw-w-12 tw-h-12 tw-leading-tight fa-2x tw-text-center"></i></p>
                            </div>
                            <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-flex tw-justify-center tw-items-center tw-bg-white product-title">
                                <p class="tw-p-4">How much life insurance do I need?</p>
                            </div>
                        </div></a>
                        
                        <a href="/featured-tips/but-i-already-have-insurance" class="tw-cursor-pointer" aria-labelledby=="but-i-already-have-insurance"><div class="tw-relative tw-w-full tw-flex tw-justify-center tw-items-center tw-relative dz-product-box dz-product-box tw-my-2 md:tw-my-0">
                            <img src="/images/mixed-race-couple-looking-over-map-outside-together-happy-sites-33378252.jpg">
                            <div class="tw-absolute tw-bg-blue-600 tw-inset-0 tw-opacity-0 product-cover tw-flex tw-flex-col tw-justify-center tw-justify-items">
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-text-xl tw-text-center tw-px-1" id="but-i-already-have-insurance">But I already have insurance...</p>
                                <p class="tw-flex tw-justify-center tw-items-center tw-text-white tw-mt-2 tw-px-6"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-right fa-fw tw-text-white tw-rounded-full tw-border tw-w-12 tw-h-12 tw-leading-tight fa-2x tw-text-center"></i></p>
                            </div>
                            <div class="tw-absolute tw-inset-x-0 tw-bottom-0 tw-flex tw-justify-center tw-items-center tw-bg-white product-title">
                                <p class="tw-p-4">But I already have insurance...</p>
                            </div>
                        </div></a>

                    </div>
                </div>
            </div>
        </div>          

        <div class="tw-w-full tw-py-16">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-11/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center tw-leading-normal">
                    <p class="tw-text-3xl xl:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight">
                        The the Term Life Insurance that's right for you
                    </p>
                    <p class="tw-text-xl tw-tracking-loose tw-w-full tw-font-light tw-text-left sm:tw-text-center">
                        Term Life Insurance provides affordable coverage for 10 years, 20 years or for life depending on your needs. For example, a 35 year-old non-smoking female can get $400,000 of coverage for as low as $20.00 per month1. Whichever Term Life Insurance plan you choose, enjoy features like:
                    </p>
                    <ul class="tw-my-8 tw-w-10/12 sm:tw-w-10/12 md:tw-w-9/12 tw-mx-auto tw-list-disc">
                        <li class="tw-mb-4 tw-text-md">Coverage up to $10 million.</li>
                        <li class="tw-mb-4 tw-text-md">A guaranteed monthly or annual cost over the entire length of the term<sup>2</sup>, which is great when it comes to budgeting your money.                        </li>
                        <li class="tw-mb-4 tw-text-md">Automatic renewal for 10 and 20 year plans at the end of the term without medical questions or exams until you turn 80, at which point your coverage ends<sup>3</sup>.</li>
                        <li class="tw-mb-4 tw-text-md">The option to convert 10 or 20 year plans to permanent coverage any time before age 69.</li>
                        <li class="tw-mb-4 tw-text-md">Preferred rates available for 10 and 20 year plans<sup>4</sup>.</li>
					</ul>
                    <p class="tw-text-2xl tw-my-8 tw-w-10/12 sm:tw-w-10/12 md:tw-w-9/12 tw-mx-auto tw-text-center">
                        3 options to choose from:
                    </p>

                    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-w-full">
                        <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-left tw-px-10 tw-border-0 md:tw-border-r tw-py-5 tw-flex-1">
                            <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Term Life</h3>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">Term insurance provides your family with financial security covering you for a term of one or more years and generally offers the largest insurance protection for your premium dollar.</p>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Term Life could be right for you if:</p>
                            <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-3">
                                <li class="tw-mb-4 tw-text-md">Provide your family financial independence</li>
                                <li class="tw-mb-4 tw-text-md">Make sure your kids have college tuition funding</li>
                                <li class="tw-mb-4 tw-text-md">Pay off credit cards and other debts</li>
                                <li class="tw-mb-4 tw-text-md">Replace your income for several years</li>
                                <li class="tw-mb-4 tw-text-md">Make Life More Comfortable for Your Loved Ones</li>
                            </ul>
                            <button class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center" onclick="window.location.href = '/' + '#termlife';window.location.reload();window.scrollTo(0,0);" role="button" aria-label="Get A Term life quote" >
                                Get A Quote
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col tw-justify-start tw-items-center tw-text-left tw-px-12 tw-border-0 md:tw-border-r tw-py-5 tw-flex-1">
                            <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Burial Insurance</h3>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">This is Whole Life Insurance that can cover you for as long as you live. Final Expense or burial insurance ensures our families will not be burned with the cost of our funeral.</p>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Burial Insurance could be right for you if:</p>
                            <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-3">
                                <li class="tw-mb-4 tw-text-md">You Can Take Control of Planning Your Funeral</li>
                                <li class="tw-mb-4 tw-text-md">Provide your family with financial aid for medical bills</li>
                                <li class="tw-mb-4 tw-text-md">To serve as a gift for your loved ones</li>
                                <li class="tw-mb-4 tw-text-md">To pay off estate taxes</li>
                                <li class="tw-mb-4 tw-text-md">Allows your family to pay off your personal loans</li>
                            </ul>    
                            <button class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center" onclick="window.location.href = '/' + '#sit';window.location.reload();window.scrollTo(0,0);" role="button" aria-label="Get A Term life quote" >
                                Get A Quote
                            </button>                                               
                        </div>
                        <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-text-left tw-mx-10 tw-py-5 tw-flex-1">
                            <h3 class="tw-text-xl tw-my-2 tw-font-semibold tw-tracking-tight">Mortgage Protection</h3>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left">Protect one of your largest investments, your home. Mortgage protection helps protect you from life's unexpected events i.e. disability, unemployment, critical illness, and premature death.</p>
                            <p class="tw-text-md tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-mt-4">Mortgage Protection could be right for you if:</p>
                            <ul class="tw-my-4 tw-w-10/12 sm:tw-w-10/12 md:tw-w-11/12 tw-mx-auto tw-list-disc tw-pl-2">
                                <li class="tw-mb-4 tw-text-md">You have an outstanding Mortgage on your house</li>
                                <li class="tw-mb-4 tw-text-md">You need money for mortgage payments if you become unemployed or disabled</li>
                                <li class="tw-mb-4 tw-text-md">You want your family to live debt free</li>
                                <li class="tw-mb-4 tw-text-md">Provide your loved ones with additional tax-free income to create an estate</li>
                            </ul>          
                            <button class="tw-bg-primary tw-text-white tw-rounded tw-py-2 tw-px-4 tw-w-full tw-text-center" onclick="window.location.href = '/' + '#fe';window.location.reload();window.scrollTo(0,0);" role="button" aria-label="Get A Final Expense quote" >
                                Get A Quote
                            </button>                                         
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-w-full tw-py-16 tw-bg-gray-300">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-11/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-flex-col tw-justify-center tw-items-center">
                    <p class="tw-text-2xl xl:tw-text-2xl tw-mb-8 tw-font-light tw-tracking-tight">
                        Ready to get Term Life Insurance? We can help.
                    </p>

                    <div class="tw-flex md:tw-hidden tw-text-base tw-w-8/12">
                        <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-full">
                            <img alt="" class="" src="/images/step3.png" style="height: 180px; width: 180px;">
                            <p class="tw-text-xl tw-my-8 tw-font-light tw-tracking-tight">Figure out how much coverage you need and get a quote</p>
                            
                            <img alt="" class="" src="/images/step1.png" style="height: 180px; width: 180px;">
                            <p class="tw-text-xl tw-my-8 tw-font-light tw-tracking-tight">Get A Quote in two minutes or less</p>
                            
                            <img alt="" class="" src="/images/step2.png" style="height: 180px; width: 180px;">
                            <p class="tw-text-xl tw-my-8 tw-font-light tw-tracking-tight">Choose the rate that matches you</p>
                        </div>
                    </div>

                    <div class="tw-hidden md:tw-flex tw-text-base tw-w-10/12">
                       
                        <table class="tw-w-full">
                            <tbody>
                                <tr>
                                    <td class="tw-text-center" style="width: 240px;display: flex;justify-content: center;"><img alt="" class="" src="/images/step3.png" style="height: 220px; width: 220px;"></td>
                                    <td><img alt="" class="tw-flex-grow-0" src="/images/left-arrow.svg" style="height: 18px; width: 80px;"></td>
                                    <td class="tw-text-center" style="width: 240px;display: flex;justify-content: center;"><img alt="" class="" src="/images/step1.png" style="height: 220px; width: 220px;"></td>
                                    <td><img alt="" class="tw-flex-grow-0" src="/images/left-arrow.svg" style="height: 18px; width: 80px;"></td>
                                    <td class="tw-text-center" style="width: 240px; display: flex; justify-content: center;"><img alt="" class="" src="/images/step2.png" style="height: 220px; width: 220px;"></td>
                                </tr>
                                <tr>
                                    <td class="tw-text-center tw-text-md" style="width: 240px;">Figure out how much coverage you need and get a quote</td>
                                    <td></td>
                                    <td class="tw-text-center tw-text-md" style="width: 240px;">Get A Quote in two minutes or less</td>
                                    <td></td>
                                    <td class="tw-text-center tw-text-md" style="width: 240px;">Choose the rate that matches you</td>
                                </tr>
                            </tbody>
                        </table>


                    </div>
                </div>
            </div>
        </div>
{{-- 

        <button id="scrollToTopButton" onclick="scrollToTop()" class="tw-fixed tw-text-2xl tw-mt-2 tw-outline-none" style="bottom: 100px;right: 40px;"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-up fa-fw tw-text-white tw-rounded-full tw-border tw-border-primary tw-bg-blue-500 tw-border-0 hover:tw-bg-blue-400 tw-w-16 tw-h-16 tw-leading-tight tw-text-center"></i></button>

 --}}  
{{--         <div id="scrollToTopButton" class="wrapper-top-button" onclick="scrollToTop()" >
            <button class="btn-to-top">
              &nbsp;
            </button>
        </div> --}}

        <button id="scrollToTopButton" onclick="scrollToTop()" class="tw-fixed tw-text-2xl tw-mt-2 tw-outline-none" style="bottom: 100px;right: 40px;"><i class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-angle-up fa-fw tw-text-white tw-rounded-full tw-border tw-border-primary tw-bg-blue-500 tw-border-0 hover:tw-bg-blue-400 tw-w-16 tw-h-16 tw-leading-tight tw-text-center" role="button" aria-label="Go back to the top of the page."></i></button>

        @foreach($sections as $section)
            <section id="{{ $section['section'] }}" class="{{ $section['base_class'] . ' ' . $section['class'] }}">
                {!! $section['data'] !!}
            </section>
        @endforeach        

        <div class="tw-bg-darkGray tw-w-full tw-text-lightGray">

                <div class="tw-w-9/12 tw-p-8 tw-mx-auto">
                    <div class="sm:tw-flex tw-justify-between tw-mb-4">
                        
                        <div class="sm:tw-w-1/2 tw-mr-0 sm:tw-mr-8 tw-h-auto">

                            <div class="sm:tw-w-full">
                                <ul class="tw-list-reset tw-leading-normal">
                                    <li class="tw-mb-4">
                                        <a class="brand white" href="./">
                                            <img class="brand-logo" src="/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png" alt="Branding Logo" width="80%">
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
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="phone" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>888-223-4773</p>
                                    </li>
                                    <li class="hover:tw-text-blue tw-text-grey-darker">
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="envelope" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>support@agentquote.com</p>
                                    </li>
                                    <li class="hover:tw-text-blue tw-text-grey-darker">
                                        <p class="tw-text-base tw-italic tw-mb-3 tw-self-start"><web-icon name="map-marker" classes="tw-inline-block fa-fw tw-mr-2 tw-text-lightGray"></web-icon>123 Gold St. Road, New Jerusalem, Heaven</p>
                                    </li>
                                </ul>

                            </div>

                        </div>

                </div>

            </div>

        </div>            

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

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-40201823-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-40201823-2');
    </script>

</body>
</html>
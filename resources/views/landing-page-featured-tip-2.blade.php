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

        <top-bar :icons="socialMediaIcons" :items="topMenuItems"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>

        <header-logo path="/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png" target="self" link="/"></header-logo>
  
        <div class="tw-w-full tw-py-8 question-2">
            <div class="tw-w-full tw-flex-col md:tw-flex-row tw-px-6 sm:tw-w-11/12 md:tw-w-11/12 lg:tw-w-8/12 tw-flex tw-justify-end tw-items-center tw-mx-auto tw-h-full">
                <div class="tw-w-full py-4 md:tw-px-4 tw-flex tw-justify-center tw-items-center tw-flex-col sm:tw-flex-row tw-leading-normal">
                    <div class="tw-text-2xl lg:tw-text-3xl tw-my-6 tw-font-light tw-tracking-tight tw-px-2 md:tw-px-16 tw-flex-1">

                        <a href="/#featured-tips" class="tw-flex tw-justify-start tw-items-center tw-text-2xl tw-mt-2"><i class="tw-flex tw-justify-center tw-items-center fa fa-icon icon-default fa-angle-left fa-fw tw-text-primary tw-rounded-full tw-border tw-border-primary tw-w-8 tw-h-8 tw-leading-tight tw-text-center"></i> <span class="tw-ml-2">Back</span></a>

                        <h2 class="tw-text-2xl lg:tw-text-4xl tw-my-6 tw-font-light">How much life insurance do I need?</h2>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-my-4">
                            Figuring out the right amount of insurance you need doesn’t have to be a complicated math problem.
                        </p>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left">
                            Think of it in simple terms:
                        </p>

                        <ul class="tw-my-6 tw-leading-normal tw-list-disc tw-ml-5">
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-my-4">
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">What will my loved ones need to meet immediate expenses?</p>
                            </li>
                            <li class="tw-text-base tw-tracking-tight tw-w-full tw-my-4">
                                <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">How much money do I want to provide for the future, and for how long?</p>
                            </li>
                        </ul>

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            Life insurance can provide the valuable support your loved ones would need at a difficult time.
                        </p>                        

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            A major life event such as getting married, having children or buying a home will significantly change your financial responsibilities.
                        </p>                        

                        <p class="tw-text-base tw-tracking-tight tw-w-full tw-font-light tw-text-left tw-my-4">
                            That’s why it is important to take each milestone in your life as an opportunity to review your life insurance and, if necessary, adjust your coverage.
                        </p>                        
                    </div>
                    
                    <div class="tw-flex tw-justify-center tw-items-center tw-flex-col tw-w-full tw-text-center tw-px-3 tw-self-start tw-flex-1">
                        <img src="/images/couple-using-ipad-love-62740068-square.jpg" class="tw-rounded-full tw-w-8/12" >
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
                        </ul>                        
                    </div>
                </div>
            </div>
        </div>  

        <contact-banner phone="1-888-223-4773" offeredby="Agent Quote Inc."></contact-banner>                
        
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
                            © <span class="copyright-year">2020</span> <a href="index.html"><span class="tw-text-primary">Agent Quote Inc.</span></a> <a href="#">Privacy Policy</a>
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
</body>
</html>
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

  {{--   <div class="md:tw-flex  md:tw-flex-wrap">
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">1</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">2</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">3</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">4</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">5</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">6</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">7</div>
        </div>
        
        <div class="tw-flex-1 tw-p-4">
            <div class="tw-box tw-bg-color-gray-400 tw-p-4">8</div>
        </div>
        

    </div> --}}

    <div class="tw-container tw-mx-auto tw-hidden">
        <div class="md:tw-min-h-screen md:tw-flex md:tw-flex-col tw-bg-gray-400">

            <header class="tw-bg-red-600 tw-p-3">
                <h1>My Site</h1>
            </header>
    
            <div class="md:tw-flex md:tw-flex-1">
                <aside class="tw-bg-green-500 tw-p-3">
                    Sidebar
                </aside>
    
                <main class="tw-bg-blue-500 md:tw-flex-1 tw-p-3 md:tw-flex-wrap">
                    <div class="tw-flex tw-flex-wrap">

                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                       <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                       </div>  
                       <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>
                        <div class="tw-w-1/2 md:tw-w-1/4 tw-p-3">
                            <div class="tw-bg-gray-400 tw-p-3 md:tw-mb-0">
                                <p>Product Feature.</p>
                            </div>
                        </div>  
                    </div>
                </main>
            </div>
    
            <footer class="tw-bg-black tw-text-white tw-p-3">
                Copyright 2020
            </footer>

        </div>
    </div>

    <div id="app">

        <top-bar :icons="socialMediaIcons" :items="topMenuItems"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        <header-logo></header-logo>
        <signup placeholder="10,000-5,000,000" userid="47" :show="showSignupBar"></signup>

{{--         <div class="tw-h-screen-off tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-2">
            <needs-analyser :show="showCalculator"></needs-analyser>
        </div> --}}
        
        <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-my-4">
            <div class="tw-w-full">
                    <div class="dz:section tw-flex tw-justify-center tw-items-center tw-w-1/2 tw-mx-auto">
                        <div class="tw-flex tw-w-full tw-justify-around tw-border tw-rounded tw-py-2 tw-px-2 tw-flex-wrap">

                            <div class="tw-flex tw-flex-col sm:tw-flex-row tw-w-full tw-py-2 tw-flex-wrap">
                            
                                <div class="tw-flex tw-w-1/5">
                                    <div class="tw-flex tw-justify-center tw-items-center tw-px-6 tw-flex-shrink-0">
                                        <img class="tw-min-w-full" src="/images/logos/banner-life-insurance.jpg">
                                    </div>
                                </div>

                                <div class="tw-flex tw-w-4/5">
                                
                                    <div class="tw-flex tw-flex-col tw-justify-between tw-text-center tw-w-1/4 tw-px-6">
                                        <h3 class="tw-text-primary tw-font-bold">Perferred Plus</h3>
                                        <p>10.11</p>
                                    </div>

                                    <div class="tw-flex tw-flex-col tw-justify-between tw-text-center tw-w-1/4 tw-px-6">
                                        <h3 class="tw-text-primary tw-font-bold">Perferred Plus</h3>
                                        <p>10.11</p>
                                    </div>

                                    <div class="tw-flex tw-flex-col tw-justify-between tw-text-center tw-w-1/4 tw-px-6">
                                        <h3 class="tw-text-primary tw-font-bold">Perferred Plus</h3>
                                        <p>10.11</p>
                                    </div>

                                    <div class="tw-flex tw-flex-col tw-justify-between tw-text-center tw-w-1/4 tw-px-6">
                                        <h3 class="tw-text-primary tw-font-bold">Perferred Plus</h3>
                                        <p>10.11</p>
                                    </div>

                                </div>
                            </div>

                            <div class="tw-flex tw-w-full tw-border tw-rounded tw-bg-primary tw-text-white tw-py-2 tw-px-2 tw-mt-4 tw-justify-between">
                               <p class="tw-text-sm">SBLI 20 Year Term Guaranteed</p>
                               <div>
                                    <a href="#" class="hover:tw-underline tw-px-2 tw-text-sm">First link</a>
                                    <a href="#" class="hover:tw-underline tw-px-2 tw-text-sm">Here is some awesome link</a>
                               </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>                    

        <contact-banner phone="1-888-223-4773" offeredby="Agent Quote Inc."></contact-banner>

    </div>

    <script src="/js/landing.js"></script>
</body>
</html>
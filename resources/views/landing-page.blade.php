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
        <header-logo path="https://ppegram.agentquote.com/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png"></header-logo>

        <signup :benefit-limits="benefitLimits" userid="47" :signing-up="showSignup" :insurance-category="category" ></signup>
        <quote :show="showQuote" :quote-details="quote" :items="quote.items" :can-requote="true" :insurance-category="category"></quote>
        <contact-banner phone="1-888-223-4773" offeredby="Agent Quote Inc."></contact-banner>

    </div>

    <script src="/js/landing.js"></script>
</body>
</html>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Thank You</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/bootstrap/dist/4.1.3/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/font-awesome/css/font-awesome.min.css') }}">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .thankyou-container {
                width:80%;
            }

            .ap-thankyou-container.show {
                display: block;
            }

            .ap-thankyou-container {
                display: none;
                text-align: center;
                border-radius: 10px;
                margin: 2px auto;
                height: auto;
                margin-bottom: 20px;
                background-color: #fff;
                border: 1px solid transparent;
                padding: 26px;
            }

            .ap-thankyou-container .main-message p {
                padding: 36px 0 0 0;
                margin-bottom: -14px;
                font-size: 1.6em;
                line-height: 1.5;
                color: #777;
            }

            .ap-thankyou-container .main-message h1 {
                font-size: 36px;
                font-weight: 500;
                line-height: 1.2;
                letter-spacing: -.01em;
            }

            .fd3-capture-input-container {
                padding: 40px;
                border: 20px solid rgba(247, 246, 246, 0.94);
                border-radius: 9px;
                max-width: 750px;
                margin: 0 auto;
            }

        </style>
    </head>
    <body>

        <div class="h-100 row align-items-center">
            <div class="col" >
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="fd3-capture-input-container"> <!-- fd3-capture-input-container -->

                                <div class="ap-thankyou-container show">
                                    <div class="main-message">
                                        <h1>{{ $header }}</h1>
                                        <img src="/images/confirmation-email-icon.png">
                                        <p>{{ $footer }}</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script type="text/javascript" src="{{asset('reacreactjs-app.jsp.js')}}" defer></script>
        <script src="{{ asset('vendor/adminlte/vendor/bootstrap/dist/4.1.3/js/bootstrap.js') }}"></script>
    </body>
</html>

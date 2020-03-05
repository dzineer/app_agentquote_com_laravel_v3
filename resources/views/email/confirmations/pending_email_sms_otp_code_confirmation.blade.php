<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Please provide the given OTP code to view your quote</title>
</head>
<body>
<?php
// $domain = config('agentquote.company.domain.urls.secure');
$domain = $data['domain'];
$path = '/quote/verify';
// $path = '/beta/landing-page/quote/verify';
?>
<div style="padding:20px 0;margin:0 auto;max-width:600px">

    <table style="margin:30px auto 0;font-size:18px">
        <tbody><tr>
            <td style="color:#666a7a;line-height:22px">

{{--                <p style="margin-bottom:12px">
                    Hi {{ $data['name'] }},
                </p>--}}

                <p style="margin-bottom:12px">
                    Your 5-digit Code: {{ $data['otp'] }}
                </p>

            </td>
        </tr>
        </tbody></table>


    <table class="" style="width:80%;margin:30px auto;border-top:1px dashed #dadada">
        <tbody><tr>
            <td style="color:#a8a8a8;padding-top:15px">
                <p style="font-size:12px;text-align:left">
                    Sent from <a href="{{ config('agentquote.company.domain.urls.secure') }}">{{ config('agentquote.company.name') }}</a>
                </p>
            </td>
        </tr>
        </tbody></table>
</div>

</body>
</html>

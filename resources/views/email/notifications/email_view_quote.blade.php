<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To view your quote request click below</title>
</head>
<body>
<?php
// $domain = config('agentquote.company.domain.urls.secure');
$domain = 'https://' . $data['domain'];
$path = '/quote/';
// $path = '/beta/landing-page/quote/verify';
?>
<div style="padding:20px 0;margin:0 auto;max-width:600px">

    <table style="margin:0 auto;padding-bottom:20px;border-bottom:1px dashed #dadada">
{{--        <tbody><tr>
            <td style="text-align:center">
                <p>
                    <img alt="AgentQuoter" src="{{ config('agentquote.company.domain.urls.secure') }}/images/aqadmin-login-logo.png" width="347" height="102" style="max-width: 100%">
                </p>
            </td>
        </tr>
        </tbody></table>--}}

    <table style="margin:30px auto 0;font-size:16px">
        <tbody><tr>
            <td style="color:#666a7a;line-height:22px">

                <p style="margin-bottom:12px">
                    You quote request has been successfully verified. Follow the link below to view your requested quote:<br><br>
                    <a href="{{ $domain }}{{ $path }}?token={{ $data['confirmation_token'] }}">
                        {{ $domain }}{{ $path }}?token={{ $data['confirmation_token'] }}
                    </a>
                </p>

                <p style="margin-bottom:12px">
                    Or copy and paste this URL into your browser:
                    <br><br>
                    {{ $domain }}{{ $path }}?token={{ $data['confirmation_token'] }}
                </p>

                <p>
                    Thank You,<br><br>The {{ config('agentquote.company.name') }} Team
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

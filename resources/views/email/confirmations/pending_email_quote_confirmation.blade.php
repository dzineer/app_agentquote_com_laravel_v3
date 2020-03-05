<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Please confirm your email address to view your quote</title>
</head>
<body>
<?php
// $domain = config('agentquote.company.domain.urls.secure');
$domain = $data['domain'];
$path = '/quote/verify';
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

{{--                <p style="margin-bottom:12px">
                    Hi {{ $data['name'] }},
                </p>--}}

                <p style="margin-bottom:12px">
                    You recently requested a quote. Please confirm your email address to view your quote, follow the link below:<br><br>
                    <a href="{{ $domain }}{{ $path }}?confirmation_token={{ $data['confirmation_token'] }}">
                        {{ $domain }}{{ $path }}?confirmation_token={{ $data['confirmation_token'] }}
                    </a>
                </p>

                <p style="margin-bottom:12px">
                    Or copy and paste this URL into your browser:
                    <br><br>
                    {{ $domain }}{{ $path }}?confirmation_token={{ $data['confirmation_token'] }}
                </p>

                <p style="text-align:left;margin-bottom:12px">
                    If you did not reset a quote, please disregard this message.<br>
                    Please contact <a href="mailto:{{ config('agentquote.company.contact.support') }}">{{ config('agentquote.company.contact.support') }}</a> with any questions.
                </p>

                <p>
                    Thanks, <br>The {{ config('agentquote.company.name') }} Team
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

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
                <?php
                $formatter = new \NumberFormatter('en_US',  \NumberFormatter::CURRENCY);
                $symbol = $formatter->getSymbol(\NumberFormatter::INTL_CURRENCY_SYMBOL);
                $benefit = $formatter->formatCurrency(intval($quote["benefit"]), $symbol)
                ?>
                <p style="margin-bottom:12px">
                    You have just received the following quote lead::<br><br>
                    <table>
                        <tr>
                            <td>
                                <label>Email</label>: {{ $quote["email"] }}
                                <label>Name</label>: {{ $quote["name"] }}
                                <label>Phone</label>: {{ $quote["phone"] }}
                                <label>Category</label>: {{ $quote["category"] }}
                                <label>Gender</label>: {{ $quote["gender"] }}
                                <label>Tobacco</label>: {{ $quote["tobacco"] }}
                                <label>Term</label>: {{ $quote["term"] }}
                                <label>DOB</label>: {{ $quote["month"] }} / {{ $quote["day"] }} / {{ $quote["year"] }}
                                <label>Benefit</label>: {{ $benefit }}

                            </td>
                        </tr>
                    </table>
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

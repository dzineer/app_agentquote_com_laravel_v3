@component('mail::message')

# Affiliate code notification

Hi {{ $data['fname'] }},

Your affiliate coupon code is: {{ $data['coupon_code']}}

If you did not expect this, please disregard this message.<br>

Please contact [{{ config('agentquote.company.contact.support') }}](mailto:{{ config('agentquote.company.contact.support') }}) with any questions.

Thanks, <br>
The {{ config('agentquote.company.name') }} Team

@slot('footer')
    [https://agentquoter.com](visit our website)  [https://app.agentquote.com](log in to your account)  [https://www.agentquoter.com/billing/submitticket.php](get support)
    {{ config('agentquote.company.legal.copyright') }}
@endslot

@endcomponent
@component('mail::message')

# Please confirm your {{ config('agentquote.company.name') }} email address

<?php
$url = config('agentquote.company.domain.urls.secure') . "/invite/confirmation?confirmation_token={$data['confirmation_token']}"
?>

Hi {{ $data['fname'] }},

Your affiliate has send you a administrator invite. Accept this invitation click the link below:<br>

@component('mail::button', ['url' => $url])
    Accept Invitation
@endcomponent

Or copy and paste this URL into your browser:
<br>
[{{ config('agentquote.company.domain.urls.secure') }}/invite/confirmation?confirmation_token={{ $data['confirmation_token']}}](<?php echo config('agentquote.company.domain.urls.secure') ?>/invite/confirmation?confirmation_token={{ $data['confirmation_token']}})

If you did not expect this, please disregard this message.<br>

Please contact [{{ config('agentquote.company.contact.support') }}](mailto:{{ config('agentquote.company.contact.support') }}) with any questions.

Thanks, <br>
The {{ config('agentquote.company.name') }} Team

@slot('footer')
    [https://agentquoter.com](visit our website)  [https://app.agentquote.com](log in to your account)  [https://www.agentquoter.com/billing/submitticket.php](get support)
    {{ config('agentquote.company.legal.copyright') }}
@endslot

@endcomponent
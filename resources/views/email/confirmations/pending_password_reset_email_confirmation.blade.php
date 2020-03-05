@component('mail::message')

# Password reset confirmation

<?php
$url = config('agentquote.company.domain.urls.secure') . "/password_change/confirmation?confirmation_token={$data['confirmation_token']}"
?>

Hi {{ $data['fname'] }},

You recently requested a new password. To reset your password, follow the link below:<br>

@component('mail::button', ['url' => $url])
    Reset Password
@endcomponent

Or copy and paste this URL into your browser:
<br>
[{{ config('agentquote.company.domain.urls.secure') }}/password_change/confirmation?confirmation_token={{ $data['confirmation_token']}}]({{ config('agentquote.company.domain.urls.secure') }}/password_change/confirmation?confirmation_token={{ $data['confirmation_token']}})

If you did not reset your password, nor management, please disregard this message.<br>

Please contact [{{ config('agentquote.company.contact.support') }}](mailto:{{ config('agentquote.company.contact.support') }}) with any questions.

Thanks,<br>
The {{ config('agentquote.company.name') }} Team

@slot('footer')

@endslot

@endcomponent
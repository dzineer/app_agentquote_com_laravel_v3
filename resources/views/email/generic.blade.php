@component('mail::message')
# {{ $message->subject }}

{!! $message->body !!}

Thanks,<br>
Agent Quote Support

@endcomponent
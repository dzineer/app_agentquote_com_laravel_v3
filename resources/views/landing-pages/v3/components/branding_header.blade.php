<div class="rd-navbar-brand brand">
    <div id="branding-header">
        @if (! $options['use_logo'])
            {{ $branding['company'] }}
        @endif
    </div>
</div>
@if ($options['use_logo'])
    <div class="rd-navbar-brand brand"><a class="brand" href="./"><img class="brand-logo"
                                                                       src="{{ $branding['logo']['light'] }}"
                                                                       alt="Company's Logo"
                                                                       style="max-width:200px;max-height:200px"/></a>
    </div>
@endif

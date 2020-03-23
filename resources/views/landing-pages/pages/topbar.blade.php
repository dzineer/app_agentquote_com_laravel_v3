        <top-bar :icons="{{ $social_media }}" phone="{{ $user->profile->contact_phone }}"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        @if($branding['user_log'])
        <header-logo path="{!! $user->profile->logo !!}" target="self" link="/"></header-logo>
        @else
            {{ $branding['company']['name'] }}
        @endif

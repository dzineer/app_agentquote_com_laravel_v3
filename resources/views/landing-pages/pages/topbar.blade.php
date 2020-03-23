        <top-bar :icons="{{ $social_media }}" phone="{{ $user->profile->contact_phone }}"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        @if($branding['use_logo'])
        <header-logo path="{!! $user->profile->logo !!}" target="self" link="/"></header-logo>
        @else
            <header-name name="{!! $branding['company']['name'] !!}"></header-name>
        @endif

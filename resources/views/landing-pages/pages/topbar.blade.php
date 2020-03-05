        <top-bar :icons="{{ $social_media }}" phone="{{ $user->profile->contact_phone }}"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        <header-logo path="{!! $user->profile->logo !!}" target="self" link="/"></header-logo>
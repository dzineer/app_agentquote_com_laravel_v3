        <top-bar :icons="{{ $social_media }}" phone="{{ $user->profile->contact_phone }}"></top-bar>
        <responsive-menu :menu="items"></responsive-menu>
        <brand-bar>
            <div slot="left">
                @if($branding['use_logo'])
                    <header-logo path="{!! $user->profile->logo !!}" target="self" link="/"></header-logo>
                @elseif($branding['use_portrait'])
                    <header-logo path="{!! $user->profile->portrait !!}" target="self" link="/"></header-logo>
                @else
                    <header-name name="{!! $branding['company']['name'] !!}"></header-name>
                @endif
            </div>
            <div slot="right">
                Here is the right
            </div>
        </brand-bar>

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
                <div class="tw-flex tw-flex-col">
                    <p class="tw-text-primary tw-text-sm tw-uppercase tw-tracking-widest">by appointment/mon-sat</p>
                    <a class="tw-bg-primary hover:tw-bg-blue-700 tw-text-white tw-py-2 tw-px-8 focus:tw-outline-none focus:tw-shadow-outline tw-uppercase tw-text-xs tw-font-bold">
                        book an appointment
                    </a>
                </div>
            </div>
        </brand-bar>

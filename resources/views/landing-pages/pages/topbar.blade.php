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
                    <p class="tw-text-primary tw-uppercase tw-tracking-widest tw-text-sm">by appointment/mon-sat</p>
                    <a class="tw-bg-primary hover:tw-bg-blue-700 tw-text-white tw-rounded tw-text-center tw-py-3 tw-px-3 focus:tw-outline-none focus:tw-shadow-outline tw-uppercase tw-text-sm tw-font-bold">
                        book an appointment
                    </a>
                </div>
            </div>
        </brand-bar>

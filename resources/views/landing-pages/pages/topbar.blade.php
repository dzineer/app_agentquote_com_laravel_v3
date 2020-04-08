        <top-bar :icons="{{ $social_media }}" phone="{{ $user->profile->contact_phone }}"></top-bar>
        {{--<responsive-menu :menu="items"></responsive-menu>--}}
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
                @if($book_appointment->hasLink)
                <div class="tw-flex tw-flex-col">
                    {{--<p class="tw-text-primary tw-uppercase tw-tracking-widest tw-text-sm">by appointment/mon-sat</p>--}}
                    <a href="{{ $book_appointment->link }}" target="_blank" class="tw-bg-primary hover:tw-bg-blue-700 tw-text-white tw-py-3 tw-px-4 tw-rounded focus:tw-outline-none focus:tw-shadow-outline tw-capitalize tw-text-center">
                        book an appointment
                    </a>
                </div>
                @endif
            </div>
        </brand-bar>

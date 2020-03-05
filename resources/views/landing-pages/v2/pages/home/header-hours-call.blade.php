    <ul class="list-inline list-inline-from-md text-left">
        <li>
            <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-middle">
                <div class="unit-left">
                    <div class="icon fa-phone icon-circle text-primary"></div>
                </div>
                <div class="unit-body">
                    <div class="text-extra-bold text-gray-light">Call Today:</div>
                    <div class="text-italic">
                        <a class="text-gray-lighter" href="tel:#">{{ $company['phone'] }}</a>
                        {{--<span class="text-gray-lighter">; </span>
                        <a class="text-gray-lighter" href="tel:#">{{ $phone[1] }}</a>--}}
                    </div>
                </div>
            </div>
        </li>
        <li class="offset-top-15 offset-md-top-0">
            <div class="unit unit-xl-horizontal unit-lg-horizontal unit-md-horizontal unit-sm-horizontal unit-middle">
                <div class="unit-left">
                    <div class="icon fa-clock-o icon-circle text-primary"></div>
                </div>
                <div class="unit-body">
                    <div class="text-extra-bold text-gray-light">Opening Hours:</div>
                    <div class="text-italic text-gray-lighter">{{ $hours_available }}</div>
                </div>
            </div>
        </li>
    </ul>

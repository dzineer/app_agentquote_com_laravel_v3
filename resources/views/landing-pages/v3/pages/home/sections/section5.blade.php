<section class="section-60 section-md-top-80 section-md-bottom-85" id="process">
    <div class="shell">
        <h3 class="text-center">Process</h3>
        <h5 class="text-center text-gray-light mb-4">Eight Step Process To Obtaining A Life Insurance Policy</h5>
        <img class="center-block responsive-image" src="{{ asset_prepend('templates/landing-pages/' . $version . '/', 'images/Steps-in-Process.jpg') }}" alt="" >
        <div class="range range-xs-center">
            <div class="cell-sm-12 cell-md-12 reveal-md-flex flex-direction-column">
                @foreach($process as $item)
                    <h4 class="text-light">{{ $item['header'] }}</h4>
                    @foreach($item["body"] as $p)
                        <p>{{ $p }}</p>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>

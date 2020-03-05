{{--@if( $menus['show'] )
    <ul class="rd-navbar-nav">
        @foreach($menus['main'] as $menuItem)
            @if( $menuItem['active'] )
                <li class="active"><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a></li>
            @else
                <li><a href="{{ $menuItem['link'] }}">{{ $menuItem['label'] }}</a></li>
            @endif
        @endforeach
    </ul>
@endif--}}

<script>
    let showMenu = {!! $menus['show'] !!};
    let menus = {!! json_encode($menus['main']) !!};
</script>

<div id="menu-module"></div>

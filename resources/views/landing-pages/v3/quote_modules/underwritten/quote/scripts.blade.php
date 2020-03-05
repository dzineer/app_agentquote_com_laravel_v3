
<!-- Java script-->
<script src="{{ asset_prepend('templates/landing-pages/'. $version .'/', 'js/core.min.js') }}"></script>
<script src="{{ asset_prepend('templates/landing-pages/'. $version .'/', 'js/script.js') }}"></script>

<script>
    const quote_results = {!! $quote_results  !!};
    const quote = {!! $verifiedQuote !!};
    UserId = {!! $user_id !!};
    const user_id = "{!! $user_id !!}";
    const quote_id = "{!! $quote_id !!}";
</script>



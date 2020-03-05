<script src="/vendor/axios/axios.min.js"></script>
<script>
    @include($module_script , [ 'timestamp' => $current_timestamp ] )
    @include($action_script , [ 'timestamp' => $current_timestamp, 'fields' => $fields ] )
    @include($communications_script , [ 'timestamp' => $current_timestamp ] )
</script>

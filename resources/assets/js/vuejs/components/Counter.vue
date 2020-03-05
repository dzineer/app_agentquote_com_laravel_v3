<template>
    <div class="tw-flex tw-justify-center">

        <div class="tw-bg-gray-500 tw-rounded-lg tw-p-4 tw-mx-4">
            <count :to="11"></count>
        </div>

        <div class="tw-bg-gray-500 tw-rounded-lg tw-p-4 tw-mx-4">
            <count :to="5"></count>
        </div>

        <div class="tw-bg-gray-500 tw-rounded-lg tw-p-4 tw-mx-4">
            <count :to="1999"></count>
        </div>

    </div>    
</template>

<script>
import Count from './Count';

export default {
    components: {
        Count
    }
}
</script>
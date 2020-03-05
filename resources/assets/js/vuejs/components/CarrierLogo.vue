<template>
    <div class="tw-flex tw-w-full md:tw-w-1/5">
        <div class="tw-flex tw-justify-center tw-items-center tw-px-0 sm:tw-mb-6 tw-mb-4 sm:tw-my-2 tw-flex-shrink-0">
            <img class="tw-min-w-full" :src="path">
        </div>
    </div>
</template>

<script>
    export default {
        props: ['path']       
    }
</script>
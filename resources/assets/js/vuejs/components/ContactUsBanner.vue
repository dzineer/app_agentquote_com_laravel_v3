<template>
    <div class="dz:section tw-py-8 tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-bg-primary tw-text-center tw-text-white" style="min-height: 260px;">
        <h3 class="tw-text-3xl sm:tw-text-4xl tw-my-6">Need to talk to us directly?</h3>
        <p class="tw-text-xl sm:tw-text-2xl tw-mb-6">Call us with questions or to apply by phone. You can also call with questions or to apply by phone in English.</p>
        <div class="tw-text-4xl sm:tw-text-5xl tw-mb-6" v-text="phone"></div>
        <div class="tw-text-2xl tw-mb-6">
            Offered by: <a :href="'tel:'+offeredby">{{ offeredby }}</a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['phone','offeredby']
    }
    
</script>
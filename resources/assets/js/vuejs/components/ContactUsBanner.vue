<template>
    <div class="dz:section tw-py-8 tw-w-full tw-flex tw-flex-col tw-justify-center tw-items-center tw-bg-primary tw-text-center tw-text-white" style="min-height: 260px;">
        <h3 class="tw-text-3xl sm:tw-text-4xl tw-my-6">Need to talk to us directly?</h3>
        <p class="tw-text-xl sm:tw-text-2xl tw-mb-6">Call us with questions or to apply by phone. You can also call with questions or to apply by phone in
            <languages-spoken :languages="languages"></languages-spoken>
        .</p>
        <div class="tw-text-4xl sm:tw-text-5xl tw-mb-6">
            <display-phone-number :phone="phone"></display-phone-number>
        </div>
        <div class="tw-mb-6" style="font-size:1.2rem">
            Offered by: <a :href="'tel:'+offeredby">{{ offeredby }}</a>
        </div>
    </div>
</template>

<script>
    import LanguagesSpoken from "./LanguagesSpoken";
    export default {
        props: ['phone','offeredby', 'languages'],
        components: {
            LanguagesSpoken
        }
    }

</script>

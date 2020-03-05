<template>
    <div class="tw-flex tw-w-full sm:tw-w-4/5">
        <rate-classification-item v-for="(item, index) in items" :key="index" :name="item.name" :premium="item.premium"></rate-classification-item>
    </div>
</template>

<script>
    import RateClassificationItem from './RateClassificationItem';

    export default {
        props: ['items'],
        components: {
            RateClassificationItem
        }
    }
</script>
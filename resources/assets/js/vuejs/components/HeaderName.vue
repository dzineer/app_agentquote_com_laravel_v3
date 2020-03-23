<template>
<div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-12 mark-header-logo">
    <div class="dz:section tw-py-4 tw-border-b tw-flex tw-flex-row tw-items-center tw-justify-start tw-text-white tw-w-full" style="min-height: 45px;">
        <div class="tw-flex tw-items-center tw-justify-start">
            <p class="brand-name" >{{ name }}</p>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: ['name'],
}
</script>

<style scoped>
    .brand-name {
        color: #000000;
    }
</style>

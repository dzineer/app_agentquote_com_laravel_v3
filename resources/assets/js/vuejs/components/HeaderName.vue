<template>
    <div class="tw-flex tw-items-center tw-justify-start">
        <p class="brand-name tw-text-2xl" >{{ name }}</p>
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

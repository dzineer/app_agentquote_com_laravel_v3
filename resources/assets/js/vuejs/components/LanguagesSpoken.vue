<template>
    <p>
        <span v-for="language in languages" v-text="language" class="tw-mr-1"></span>
    </p>
</template>

<script>
    export default {
        props: ['languages']
    }
</script>

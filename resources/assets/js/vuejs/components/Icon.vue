<template>
    <i :class="genIcon()"></i>
</template>

<script>
export default {
    props: ['name', 'classes'],
    methods: {
        genIcon() {
            return "fa-icon icon-default fa-" + this.name + ' ' + this.classes;
        }
    }
}
</script>

<style lang="scss">
    .fa-icon {
        font-style: normal;
    }
</style>
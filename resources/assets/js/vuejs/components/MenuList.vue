<template>
    <div>
        <h1>Menu List</h1>
        <ul v-if="items">
            <li v-for="(item, index) in items" v-bind:key="item">
                <slot name="george" :data="item" :index="index+1">{{ item }}</slot>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    props: ['items']
}
</script>

<style>

</style>
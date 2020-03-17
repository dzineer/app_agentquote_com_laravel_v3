

// main.js or app.js


import Vue from 'vue';

import Ourcoffee from './components/Ourcoffee';
Vue.component('out-coffee', Ourcoffee);

import NavBar from './components/NavBar';
Vue.component('navbar', NavBar);

new Vue({
    el: '#app',
    components: { Ourcoffee, NavBar },
    data() {
        return {

        }
    },
    mounted() {

    },
    methods: {

    }
});


// components/Ourcoffee.vue

<template>
    <div>
        <ul>
            <li>a</li>
            <li>b</li>
            <li>c</li>
        </ul>
    </div>
</template>

<script>

export default {
    props: [
        'show'
    ],
    components: {},
    data() {
        return {

        }
    },
    mounted() {},
    filters: {},
    methods: {}
}
</script>

<style scoped>
</style>


// components/NavBar.vue

<template>
    <div>
        <ul>
            <li>a</li>
            <li>b</li>
            <li>c</li>
        </ul>
    </div>
</template>

<script>

export default {
props: [
'show'
],
components: {},
data() {
return {

}
},
mounted() {},
filters: {},
methods: {}
}
</script>

<style scoped>
</style>


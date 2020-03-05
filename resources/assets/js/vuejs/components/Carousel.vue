<template>
<!--     <div data-flickity='{ "cellAlign": "left", "contain": true, "wrapAround": true }'>
 -->   
    <div>
        <slot></slot>
    </div>    
</template>

<script>
import Flickity from 'flickity';
import 'flickity/dist/flickity.min.css';

export default {
    props: {
        wrapAround: { default: true },
        autoplay: { default: false }
    },
    mounted() {
        new Flickity(this.$el, {
            wrapAround: this.wrapAround,
            autoPlay: this.autoplay,
            cellAlign: 'left',
            contain: true
        })
    }
}
</script>

<style>
    
</style>
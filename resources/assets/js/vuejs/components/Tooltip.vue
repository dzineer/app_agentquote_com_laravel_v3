<template>
    <div v-show="false">
        <slot></slot>
    </div>    
</template>

<script>
import PopperToolTip from 'tooltip.js';

export default {
     props: {
         'name': {},
         'placement': { default: 'top' },
         'offset': { default: '0, 20' }
     },
     mounted() {
            document.querySelectorAll(`[data-tooltip-name=${this.name}]`).forEach(elem => {
                console.log(elem);
                new PopperToolTip(elem, {
                    placement: this.placement,
                    title: this.$el.innerHTML,
                    offset: this.offset,
                    html: true
                }); 
            });
     }
}
</script>

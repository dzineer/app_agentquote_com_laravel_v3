<template>
    <div>
        <h5 class="tw-mt-10 tw-font-bold">Option #1</h5>
            <p>
                Hello <span data-tooltip="I am a tooltip.">hover over me</span> to see a tooltip.
            </p>

            <h5 class="tw-mt-10 tw-font-bold">Option #1</h5>
            <p>
                Hello <span v-tooltip:top="'I am a tooltip.'">hover over me</span> to see a tooltip.
            </p>

            <h5 class="tw-mt-10 tw-font-bold">Option #3</h5>
            <p>
                Hello <span data-tooltip-name="our-products-tooltip">hover over me</span> to see a tooltip.
            </p>

            <tooltip name="our-products-tooltip" placement="right" offset="0,40">
                <div class="tw-p-4 tw-border-radius-5">
                    <h3 class="tw-text-2xl tw-mb-4">Our Products</h3>

                    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. </p>
                </div>
            </tooltip>
    </div>

</template>

<script>
import PopperToolTip from 'tooltip.js';
import Tooltip from './Tooltip.vue';

export default {
    components: {
        Tooltip
    },
    mounted() {
        document.querySelectorAll('[data-tooltip]').forEach(elem => {
            new PopperToolTip(elem, {
                placement: elem.dataset.tooltipPlacement || 'top',
                title: elem.dataset.tooltip
            }); 
        })
    }
}
</script>
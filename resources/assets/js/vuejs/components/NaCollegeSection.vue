<template>
    <div class="na-section-block tw-w-full">

        <div class="section-fields tw-w-full">

            <div @click="toggle" class="tw-cursor-pointer section-heading tw-w-full tw-flex tw-items-center">
                <div class="tw-w-16 tw-h-16 tw-flex tw-justify-center tw-items-center">
                    <icon :name="icon" classes="tw-text-2xl"></icon>
                </div>
                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-ml-4 tw-py-2" v-text="title"></h2>
            </div>

            <div v-show="show" class="fields tw-py-4 tw-px-2">   
                <college-field @fieldChange="onFieldChange" header="Number of children" name="total" classes="" :value="value" :readonly="false"></college-field>
            </div>
            
        </div>

    </div>
</template>

<script>

import CollegeField from './CollegeField';
import Icon from './Icon';

export default {
    props: [
        'title',
        'show',
        'icon',
        'value',
    ],
    components: {
        Icon, CollegeField
    },
    methods: {
        onFieldChange( field ) {
            this.$emit('fieldChange', field);
        },
        toggle() {
            this.$emit('toggle');
        }
    }
}
</script>
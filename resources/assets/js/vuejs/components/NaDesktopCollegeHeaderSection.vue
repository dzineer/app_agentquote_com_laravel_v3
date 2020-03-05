<template>
    <div class="na-section-block tw-w-full">

        <div class="section-fields tw-w-full">

            <div @click="toggle" class="tw-cursor-pointer desktop-view-section-heading tw-w-full tw-flex tw-items-center" :class="selected ? 'na-selected' : ''">
                <div class="tw-w-16 tw-h-16 tw-flex tw-justify-center tw-items-center">
                    <icon :name="icon" classes="tw-text-2xl"></icon>
                </div>
                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-ml-4 tw-py-2" v-text="title"></h2>
            </div>
<!--
            <div v-show="show" class="fields tw-py-4 tw-px-2">   
                <div v-for="(field, index) in fields" :key="index" @fieldChange="onFieldChange" :header="field.text" :name="field.name" :value="field.value" :class="field.classes" :readonly="field.readonly" :is="field.component"></div>
            </div>
-->            
        </div>

    </div>
</template>

<script>

import Fields from './Fields';
import AmountField from './AmountField';
import PercentageField from './PercentageField';
import YearField from './YearField';
import CollegeField from './CollegeField';
import Field from './Field';
import Icon from './Icon';

export default {
    props: [
        'title',
        'show',
        'icon',
        'fields',
        'selected'
    ],
    components: {
        Icon, Fields, AmountField, YearField, PercentageField, CollegeField, Field
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
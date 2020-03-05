<template>
    <div class="fields tw-py-4 tw-px-2">   
        <div v-for="(field, index) in fields" :key="index" @fieldChange="onFieldChange" :header="field.text" :name="field.name" :value="field.value" :class="field.classes" :readonly="field.readonly" :is="field.component"></div>
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
        'fields'
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
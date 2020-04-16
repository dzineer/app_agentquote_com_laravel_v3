<template>
    <div class="na-section-block tw-w-full">

        <div class="section-fields tw-w-full">

            <div class="na-total-heading tw-w-full">
                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-py-2" v-text="title"></h2>
            </div>

            <div class="fields tw-py-4 tw-px-2">
                <amount-field header="Income Replacement Insurance Needed (Part I)" :value="part1 | formatMoney" :readonly="true"></amount-field>
                <amount-field header="Total Additional Expenses (Part II)" :value="part2 | formatAmount" :readonly="true"></amount-field>
                <amount-field header="Insurance Needed" :value="total | formatAmount" :readonly="true"></amount-field>
                <button class="tw-bg-primary tw-w-full hover:tw-bg-blue-700 tw-text-white tw-py-5 tw-px-8 tw-rounded focus:tw-outline-none focus:tw-shadow-outline" @click="onQuoteAmount">Quote Amount</button>
            </div>

        </div>

    </div>
</template>

<script>
import AmountField from './AmountField';

export default {
    props: [
        'title',
        'show',
        'part1',
        'part2',
        'total'
    ],
    components: {
        AmountField
    },
    methods: {
        onQuoteAmount() {
            // debugger;
            this.$emit('quoteFromCalculator');
        }
    }
}
</script>

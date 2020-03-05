<template>
    <div class="na-section-block tw-w-full">

        <div class="section-fields tw-w-full">

            <div class="na-total-heading tw-w-full">
                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-py-2" v-text="title"></h2>
            </div>

            <div class="fields tw-py-4 tw-px-2">   
                <amount-field header="Income Replacement Insurance Needed (Part I)" :value="part1 | formatAmount" :readonly="true"></amount-field>
                <amount-field header="Total Additional Expenses (Part II)" :value="part2 | formatAmount" :readonly="true"></amount-field>
                <amount-field header="Total Insurance Needed" :value="total | formatAmount" :readonly="true"></amount-field>
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
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "$" + n;
        }
    },    
}
</script>
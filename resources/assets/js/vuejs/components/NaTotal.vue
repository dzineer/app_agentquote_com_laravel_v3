<template>
    <div class="na-section-block tw-w-full">

        <div class="section-fields tw-w-full">

            <div class="na-total-heading tw-w-full">
                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-py-2" v-text="title"></h2>
            </div>

            <div class="fields tw-py-4 tw-px-2">
                <amount-field header="Income Replacement Insurance Needed (Part I)" :value="part1 | formatMoney" :readonly="true"></amount-field>
                <amount-field header="Total Additional Expenses (Part II)" :value="part2 | formatMoney" :readonly="true"></amount-field>
                <amount-field header="Insurance Needed" :value="total | formatMoney" :readonly="true"></amount-field>
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
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "$" + n;
        },
        formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",", symbol = "$") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return symbol + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
                console.log(e)
            }
        }
    },
    methods: {
        onQuoteAmount() {
            debugger;
            this.$emit('quoteFromCalculator');
        }
    }
}
</script>

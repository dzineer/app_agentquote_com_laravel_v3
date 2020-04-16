<template>
    <div class="field">

        <h3 class="field-heading" :class="classes" v-text="header"></h3>

        <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-1 tw-relative">
            <div class="tw-flex tw--mr-px">
                <span class="on-left-symbol">$</span>
            </div>
            <input type="text" class="field-between-input tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-flex-1 tw-border tw-px-3" :name="name" :value="value | formatAmount" @keyup="onFieldChange" :disabled="readonly">
            <div class="tw-flex tw--mr-px">
                <span class="on-right-symbol">.00</span>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    props: [
        'header',
        'classes',
        'name',
        'value',
        'readonly'
    ],
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n;
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
        onFieldChange(e) {
            let field = { name: e.currentTarget.name, value: e.currentTarget.value };
            this.$emit('fieldChange', field);
        },
		cleanValuedAmount(a) {
			let n = a + "";
			n = n.replace(/\$/g, "");
			n = n.replace(/,/g, "");
			return n;
		},
    }
}
</script>

<style lang="scss">
  .symbol {
    background-color: #17567F;
    color: white;
  }
</style>

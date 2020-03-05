<template>
    <div class="field">  
        <h3 class="field-heading" :class="classes" v-text="header"></h3>

        <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-4 tw-relative">
            <div class="tw-flex tw--mr-px">
                <span :class="classes" class="field-symbol">$</span>
            </div>				
            <input type="text" class="field-input tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-w-px tw-flex-1 tw-border tw-border-grey-light tw-px-3 tw-rtw-elative" :name="name" :value="value | formatAmount" @keyup="onFieldChange">
            <div class="tw-flex tw--mr-px">
                <span class="field-input cents-symbol">.00</span>
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
        'value'
    ],
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n;
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
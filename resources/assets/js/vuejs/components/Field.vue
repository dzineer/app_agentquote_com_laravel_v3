<template>
    <div class="field">  
        <h3 class="field-heading" :class="classes" v-text="header"></h3>
        <input type="text" class="field-input" :name="name" :value="value | formatAmount" @keyup="onFieldChange">
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
            return "$" + n;
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
<template>
    <div class="tw-w-full">
        <QuoteItemBarTermlife v-if="insuranceCategory === 'termlife'" :policy="policy" :links="links" @togglePolicyDetails="toggle"></QuoteItemBarTermlife>
        <QuoteItemBarSit v-if="insuranceCategory === 'sit'" :policy="policy" :links="links" @togglePolicyDetails="toggle"></QuoteItemBarSit>
        <QuoteItemBarFe v-if="insuranceCategory === 'fe'" :policy="policy" :links="links" @togglePolicyDetails="toggle"></QuoteItemBarFe>
    </div>
</template>

<script>

    import QuoteItemBarTermlife from "./QuoteItemBarTermlife";
    import QuoteItemBarSit from "./QuoteItemBarSit";
    import QuoteItemBarFe from "./QuoteItemBarFe";
        
    export default {
        props: ['policy', 'links', 'insuranceCategory', 'togglePolicyDetails'],
        components: {
            QuoteItemBarTermlife, QuoteItemBarSit, QuoteItemBarFe
        },
        data() {
            return {
                localStyles: { policy: '', links: '' }
            }
        },        
        mounted() {
            this.localStyles = this.styles || this.localStyles;
        },
        methods: {
            toggle() {
                this.$emit('togglePolicyDetails');
            }
        }
          
    }
</script>
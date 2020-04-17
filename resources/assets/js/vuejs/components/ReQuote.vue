<template>

        <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-my-16">
            <div class="tw-w-full">
                <div class="dz:section tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-full sm:tw-w-full md:tw-w-11/12 lg:tw-w-10/12 xl:tw-w-10/12 tw-mx-auto">

                    <div class="tw-flex tw-justify-start tw-items-center tw-w-full">
                        <button class="tw-w-full sm:tw-w-1/4 tw-font-semibold tw-bg-gray-700 tw-text-white tw-py-4 tw-px-2 tw-rounded tw-capitalize" @click="onNewQuote">get a new quote</button>
                    </div>

                    <div class="tw-flex tw-justify-center tw-items-center tw-w-full tw-flex-wrap">

                        <div v-if="insuranceCategory !== 'fe'" :class="insuranceCategory !== 'fe' ? 'tw-w-1/3 sm:tw-w-1/4' : ''" class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-w-1/3 sm:tw-w-1/4 tw-py-4 tw-px-2 tw-self-end">
                            <label for="" class="tw-text-left tw-w-full tw-text-primary tw-font-semibold tw-text-md sm:tw-text-lg">Term</label>
                            <select class="tw-text-md sm:tw-text-lg tw-border-b-3 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-full sm:tw-w-full" name="" id="" @change="onTermChange">
                                <option v-for="(item, index) in terms" :key="index" :value="item.value" :selected="item.value === term">{{ item.text }}</option>
                            </select>
                        </div>

                        <div :class="insuranceCategory !== 'fe' ? 'tw-w-1/3 sm:tw-w-1/4' : 'tw-w-1/3 sm:tw-w-1/3'" class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-py-4 tw-px-2 tw-self-end">
                            <label for="" class="tw-text-left tw-w-full tw-text-primary tw-font-semibold tw-text-md sm:tw-text-lg">Enter Face Amount</label>
                            <input type="text" name="fname" placeholder="Face Amount" required="required" v-model="requestedValue" @keyup="updateKeyUpAmount" class="tw-text-md sm:tw-text-lg tw-w-full focus:tw-outline-none focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mr-2 tw-px-3 tw-py-2 tw-rounded-none tw-shadow tw-text-gray-700 tw-w-2/5" >
                        </div>

                        <div :class="insuranceCategory !== 'fe' ? 'tw-w-1/3 sm:tw-w-1/4' : 'tw-w-1/3 sm:tw-w-1/3'" class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-py-4 tw-px-2 tw-self-end">
                            <label for="" class="tw-text-left tw-w-full tw-text-primary tw-font-semibold tw-text-md sm:tw-text-lg">Choose Face Amount</label>
                            <select class="tw-text-md sm:tw-text-lg tw-border-b-3 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-full sm:tw-w-full" name="" id="" @change="onChooseFaceAmountChange" ref="benefitSelect">
                                <option value="-1">Face Amount</option>
                                <option v-for="(benefit, index) in benefits" :key="index" :value="benefit.value" :selected="benefit.value === faceAmount">{{ benefit.text }}</option>
                            </select>
                        </div>

                        <div :class="insuranceCategory !== 'fe' ? 'tw-w-1/3 sm:tw-w-1/4' : 'tw-w-1/3 sm:tw-w-1/3'" class="tw-flex tw-justify-center tw-items-center tw-w-full tw-py-4 tw-px-2">
                            <button @click.prevent="onQuote" :disabled="quoting"
                            class="tw-w-full tw-font-semibold tw-bg-green-600 tw-text-white tw-py-4 tw-px-2 tw-rounded tw-capitalize"
                            >
                            <icon v-if="quoting" name="refresh" classes="tw-inline-block fa fa-spin fa-fw tw-mr-2" />
                            <span class="tw-sr-only">Loading...</span>
                            Re-Quote
                            </button>
                        </div>


                    </div>

                </div>
            </div>
        </div>

</template>

<script>
    import Icon from "./Icon";
    export default {
        props: ['quote', 'quoting','insuranceCategory'],
        components: {
            Icon
        },
        data() {
            return {
                requoting: false,
                terms: [],
                term: 0,
                localQuote: {},
                category: '',
                faceAmount: '0',
                requestedValue: 0.00,
                textFaceAmount: '$0.00',
                selectedBenefit: undefined,
                benefits: []
            }
        },
        mounted() {
            this.category = this.insuranceCategory;
            this.terms = this.getTermYears();
            this.localQuote = this.quote;
            // debugger;
            this.requestedValue = this.localQuote.quoteAmount;
            this.requestedValue = this.formatValue(this.localQuote.quoteAmount, "$");

            this.term = parseInt(this.localQuote.term);
            this.benefits = this.getBenefits();
            // debugger;
            this.$root.$on('quoteComplete', this.onQuoteComplete);
            window.vueEvents.$on('finishedRequote', this.finishedRequote);
        },
        methods: {
            formatValue(a, symbol='') {
                let n = a + "";
                if (typeof n === "string" && n !== "0" && n.indexOf(".") !== -1) {
                    n = parseInt(a) + "";
                }
                n = n.replace(/\$/g, "");
                n = n.replace(/,/g, "");
                n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return symbol + n;
            },
            finishedRequote() {
                this.quoting = false;
            },
            onQuote(e) {
                this.quoting = true;
                window.vueEvents.$emit('reGenerateQuote', { "benefit": parseFloat(this.cleanValuedAmount(this.requestedValue))/1000, "term": this.term } );
            },
            onQuoteComplete() {
                this.quoting = false;
            },
            onNewQuote() {
                location.reload();
            },
            onTermChange(e) {
                this.term = e.currentTarget.value;
            },
            onChooseFaceAmountChange(e) {
                this.localQuote.quoteAmount = this.formatCurrency(
                    e.currentTarget.value * 1000
                );
                this.faceAmount = e.currentTarget.value;
                this.requestedValue = this.formatValuedAmount(e.currentTarget.value*1000);
            },
            onEnterFaceAmountChange(e) {
                this.localQuote.quoteAmount = this.formatCurrency(
                    e.currentTarget.value
                );
                this.faceAmount = parseFloat(this.cleanValuedAmount(e.currentTarget.value))/1000;
                this.$refs.benefitSelect.selectedIndex = 0;
                // this.textFaceAmount = this.localQuote.quoteAmount;
            },
            updateAmount(newValue) {

				this.tempRequestValue = this.formatValuedAmount( newValue );

				if ( !this.isAmount(this.tempRequestValue) ) {
                    toastr.error('Invalid amount');
                    this.requestedValue = '';
                    return;
				}

				this.requestedValue = this.tempRequestValue;
            },
            isAmount(value) {
               value = value.replace(/\$/g,'').replace(/\,/g,"").replace(/ /g,'');
               return this.isNumeric( value ) && value > 0;
            },
            isNumeric(n) {
                return !isNaN(parseFloat(n)) && isFinite(n);
            },
            formatValuedAmount(a) {
                let n = a + "";
                n = n.replace(/\$/g, "");
                n = n.replace(/,/g, "");
                n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                return "$" + n;
            },
            updateKeyUpAmount(e) {
                this.$refs.benefitSelect.selectedIndex = 0;
                this.updateAmount(e.currentTarget.value);
            },
            getTermYears() {
                if (this.category === 'termlife') {
                    return [10,15,20,25,30,35,40].map( n => {
                        return { "text": n + " Years", value: n };
                    });
                } else if (this.category === 'fe') {
                    return [{"text": '10 Pay', value: 10},{"text": '20 Pay', value: 20},{"text": 'Life Pay', value: 121}];
                } else if(this.category === 'sit') {
                    return [10,15,20,25,30].map( n => {
                        return { "text": n + " Years", value: n };
                    });                } else {
                    return [ {name: 'No Category Provided', value: 0} ];
                }
            },
            getCategoryId() {
                if (this.category === 'termlife') {
                    return '1';
                } else if (this.category === 'fe') {
                    return '4';
                } else if(this.category === 'sit') {
                    return '1';
                } else {
                    return 0;
                }
            },
            getBenefits() {
                // debugger
                if (this.category === 'termlife') {
                    return this.genTermlifeBenefits();
                } else if (this.category === 'fe') {
                    return this.genFeBenefits();
                } else if(this.category === 'sit') {
                    return this.genSitBenefits();
                } else {
                    return 0;
                }
            },
            genSitBenefits() {

                const stops = [
                    { start: 25000, end: 400000, inc: 25000 }
                ];

                let arr = [];

                stops.forEach( point => {

                    for (let i = point.start; i <= point.end; i = i + point.inc) {
                        let txt = this.formatCurrency(i);
                        // debugger;
                        arr.push({ "text": txt, "value": i/1000 });
                    }

                });

                return arr;

            },
            genFeBenefits() {

                const stops = [
                    { start: 1000, end: 10000, inc: 1000 },
                    { start: 10000, end: 25000, inc: 2500 },
                    { start: 25000, end: 50000, inc: 5000 },
                    { start: 50000, end: 100001, inc: 10000 },
                ];

                let arr = [];

                stops.forEach( point => {

                    for (let i = point.start; i < point.end; i = i + point.inc) {
                        let txt = this.formatCurrency(i);
                        // debugger;
                        arr.push({ "text": txt, "value": i/1000 });
                    }

                });

                return arr;
            },
            genTermlifeBenefits() {
                const stops = [
                    { start: 25, end: 201, inc: 25 },
                    { start: 250, end: 950, inc: 50 },
                    { start: 1000, end: 4500, inc: 500 },
                    { start: 5000, end: 10000, inc: 1000 },
                ];

                let arr = [];

                stops.map( point => {
                    for (let i = point.start; i <= point.end; i = i + point.inc) {
                        let v = this.formatCurrency(i*1000);
                        arr.push({ "text": v, "value": i });
                    }
                    // debugger;
                    return arr;
                });

                // debugger;
                return arr;
            },
            formatCurrency(s, n, x) {
                let num = parseInt(s);
                let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
                return '$'+num.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
            },
            cleanValuedAmount(a) {
                let n = a + "";
                n = n.replace(/\$/g, "");
                n = n.replace(/,/g, "");
                return n;
            },
            getCategoryFromHash() {
                return location.hash.length > 0 ? location.hash.substr(1) : '';
            },
        }
    }
</script>

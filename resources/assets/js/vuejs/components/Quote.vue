<template>
    <div v-if="show" class="tw-w-full">

        <re-quote
            v-show="!printing"
            v-if="canRequote"
            :quote="quote"
            :quoting="quoting"
            :insuranceCategory="insuranceCategory">
        </re-quote>

        <h2 v-show="!printing" class="tw-text-center tw-text-primaryLighter tw-text-3xl tw-font-bold tw-pb-4" v-text="quoteResultsTitle"></h2>

        <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-my-4">
            <div class="tw-w-full">
                <div class="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto" style="/* border: none; */">
                    <div class="tw-flex tw-w-full tw-justify-around tw-rounded tw-py-2 tw-px-2 tw-flex-wrap tw-justify-center tw-items-center">
                        <div class="tw-flex tw-flex-col sm:tw-flex-row tw-w-full tw-py-2">
                            <div class="tw-flex tw-w-full md:tw-w-full">
                                <div class="tw-w-full tw-flex tw-justify-end tw-items-center">
                                    <button class="tw-font-semibold tw-text-primary tw-py-4 tw-px-8 tw-rounded tw-capitalize tw-cursor-pointer" @click="togglePrintMode">{{ printMode.text }}</button>
                                    <button class="tw-font-semibold tw-text-primary tw-py-4 tw-px-8 tw-rounded tw-capitalize tw-cursor-pointer" @click="printQuote"><icon name="print" classes="tw-inline-block fa-fw tw-mr-1" />Print</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-show="printing" class="tw-w-full tw-flex tw-justify-center tw-items-center tw-my-4">
            <div class="tw-w-full">
                <div class="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto" style="/* border: none; */">
                    <div class="tw-flex tw-w-full">
                        <div class="tw-flex tw-flex-col sm:tw-flex-row tw-w-full tw-py-2">
                            <div class="tw-flex tw-w-full md:tw-w-full">
                                <div class="tw-w-full tw-flex tw-flex-col tw-justify-center tw-leading-loose tw-items-center tw-rounded tw-border-0 tw-py-4 tw-px-4">
                                    <label class="tw-text-xl"><strong>Name:</strong> {{ quote.fname +  " " + quote.lname }}</label>
                                    <label class="tw-text-xl"><strong>Insurance:</strong> Term Life</label>
                                    <label class="tw-text-xl"><strong>Term Length:</strong> {{ quote.term }} Years</label>
                                    <label class="tw-text-xl"><strong>Benefit:</strong> {{ quote.quoteAmount }}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tw-w-full" id="quote-body">

            <quote-item v-for="(item, index) in quoteItems" :key="index"
                :policy="item.policy"
                :links="item.links"
                :logo="item.logo"
                :carrierDetails="item.carrierDetails"
                :reference="item.reference"
                :insuranceCategory="insuranceCategory"
                :rate-classifications="item.rateClassifications"
                :force-show-policy="printing"
            >
            </quote-item>

        </div>

    </div>
</template>

<script>
    import QuoteItem from './QuoteItem';
    import ReQuote from './ReQuote';
    import Icon from "./Icon";

    export default {
        props: ['items', 'show', 'quoteDetails', 'canRequote', 'heading', 'insuranceCategory'],
        components: {
            QuoteItem, ReQuote, Icon
        },
        data() {
            return {
                quoteItems: [],
                quoting: false,
                quote: {},
                category: '',
                token: '',
                printing: false,
                printMode: {
                    text: 'Show Print View',
                    show: false,
                    visible: 'Show Normal View',
                    hidden: 'Show Print View',
                }
            }
        },
        mounted() {
            debugger;

            window.vueEvents.$on('generateQuote', this.onGenerateQuote);
            window.vueEvents.$on('reGenerateQuote', this.onReGenerateQuote);
            this.$root.$on('quoteUpdated', this.onQuoteUpdated);

            this.quoteItems = this.items;
            debugger;
            this.category = this.insuranceCategory;
            this.category = this.getCategoryFromHash();
            this.category = this.insuranceCategory === '' ? 'termlife' : this.insuranceCategory;
            this.quoteResultsTitle = this.getQuoteResultsTitle();
            this.printMode.show = false;

        },
        methods: {
            togglePrintMode() {
              this.printing = !this.printing;
              this.printMode.show = this.printing;
              if (this.printMode.show) {
                  this.printMode.text = this.printMode.visible;
              } else {
                  this.printMode.text = this.printMode.hidden;
              }
              this.printModeText.value = this.printMode[this.printing];
            },
            printQuote() {
              window.print();
            },
            getQuoteResultsTitle() {
                if (this.insuranceCategory === 'termlife') {
                    return 'Term Life Quote Results';
                } else if (this.insuranceCategory === 'fe') {
                    return 'Burial Insurance Quote Results';
                } else if(this.insuranceCategory === 'sit') {
                    return 'Mortgage Protection Quote Results';
                } else {
                    return 0;
                }
            },
            getCategoryFromHash() {
                return location.hash.length > 0 ? location.hash.substr(1) : '';
            },
            onQuoteUpdated(quote) {
                this.quote = quote.value;
            },
            onReGenerateQuote(data) {

                const token = jQuery('meta[name="csrf-token"]').attr('content');

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                };

                debugger;
                let benefit = data.benefit;
                let term = data.term;

                if (benefit === 0) {
                    toastr.error('You must choose a Face Amount');
                    return;
                }

                let url = '/quote/verified/?token=' + this.token + '&format=json&action=requote' + '&benefit=' + benefit + '&term=' + term;

                this.verifying = true;

                axios.get(url).then( res => {
                    console.log(res);
                    if (res.statusText === "OK") {

                        if (res.data.success === true) {
                            debugger;
                            this.quoteItems = res.data.quote.items;
                            window.vueEvents.$emit('showQuote');
                            this.$root.$emit('quoteComplete', {});
                            window.vueEvents.$emit('finishedRequote');
                            // location.href = res.data.redirect;
                        } else {
                            window.vueEvents.$emit('finishedRequote');
                        }

                    }
                });

            },
            onGenerateQuote(data) {

                const token = jQuery('meta[name="csrf-token"]').attr('content');

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                };

                debugger;
                let url = '/quote/verified/?token=' + data.token + '&format=json';

                this.token = data.token;

                this.verifying = true;

                axios.get(url).then( res => {
                    console.log(res);
                    if (res.statusText === "OK") {

                        if (res.data.success === true) {
                            debugger;
                            this.quoteItems = res.data.quote.items;
                            window.vueEvents.$emit('showQuote');
                            // location.href = res.data.redirect;
                        } else {

                        }

                    }
                });

            },
            getQuote() {
                let quote = {
                    items: [
                        {
                            policy: "Protective Classic Choice Term 20",
                            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
                            logo: "/images/logos/protective-life-insurance.jpg",
                            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.20' }, { name: 'Preferred', 'premium': '12.40' }, { name: 'Select', 'premium': '16.02' }, { name: 'Standard', 'premium': '16.50' }]
                        },
                        {
                            policy: "Protective Classic Choice Term 20",
                            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
                            logo: "/images/logos/protective-life-insurance.jpg",
                            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.20' }, { name: 'Preferred', 'premium': '12.40' }, { name: 'Select', 'premium': '16.02' }, { name: 'Standard', 'premium': '16.50' }]
                        },
                        {
                            policy: "Protective Classic Choice Term 20",
                            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
                            logo: "/images/logos/protective-life-insurance.jpg",
                            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.20' }, { name: 'Preferred', 'premium': '12.40' }, { name: 'Select', 'premium': '16.02' }, { name: 'Standard', 'premium': '16.50' }]
                        },
                        {
                            policy: "Protective Classic Choice Term 20",
                            links: [ { text: 'Click Here to Match a rate to your Health Profile', 'href': '#'}, { text: 'View Policy Details', 'href': '#'} ],
                            logo: "/images/logos/protective-life-insurance.jpg",
                            rateClassificaions: [{ name: 'Preferred Plus', 'premium': '10.20' }, { name: 'Preferred', 'premium': '12.40' }, { name: 'Select', 'premium': '16.02' }, { name: 'Standard', 'premium': '16.50' }]
                        }
                    ]
                };
                return quote;
            },
            onQuote( quoteRequest ) {

                this.quoting = true;

                this.quote = {
                    benefit: 200000,
                    term: 20,
                    birthdate: {
                        yyyy: 1989,
                        mm: 1,
                        dd: 1
                    }
                };

                let that = this;

                setTimeout(function() {

                    that.quoteItems = that.getQuote().items;
                    that.quoting = false;

                }, 2000);
            }
        }
    }
</script>

<template>
<div  :v-show="show" class="tw-w-full tw-flex tw-justify-center tw-items-center">
    <div class="tw-w-full">

        <div class="signup-banner tw-flex tw-justify-center tw-items-center tw-w-full lg:tw-py-8">
            <div class="dz:section tw-w-full md:tw-w-11/12 lg:tw-w-4/5 tw-flex tw-justify-center tw-items-center tw-mx-1 md:tw-no-margin">
                <div class="tw-flex tw-flex-col md:tw-flex-row tw-w-100 sm:tw-11/12">

                    <div class="tw-text-center tw-flex tw-flex-col tw-items-center tw-leading-loose"> 
                        <h3 class="tw-text-lg tw-tracking-wider">Get a quote in less than a minute</h3>
                        <div class="tw-flex tw-flex-row tw-leading-none tw-w-full md:tw-leading-loose" style="position:relative;">
    <!--                       <input type="text" v-model="requestedValue" @keyup="updateKeyUpAmount" @click="showAmountList = ! showAmountList" :placeholder="placeholder" class="quote-field tw-shadow tw-appearance-none tw-border tw-rounded tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-1/2 tw-text-center"> -->
                        <input type="text" v-model="requestedValue" @keyup="updateKeyUpAmount" :placeholder="placeholder" class="quote-field tw-h-13 tw-shadow tw-appearance-none tw-border tw-rounded tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-1/2 tw-text-center">
                           <select 
                                v-if="false"
                                v-model="requestedValue" 
                                @change="onAmountChange" 
                                class="quote-field tw-shadow tw-appearance-none tw-border tw-rounded tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0">
                                <option disabled value="">Please select one</option>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>

                            <ul class="tw-border-2 tw-border-t-0 tw-rounded-b-lg tw-rounded tw-overflow-y-auto" style="position: absolute;top: 42px;left: 1px;max-height:250px;" v-if="showAmountList" >
                                <li v-for="(item, index) in items" v-bind:key="item" @mouseover="setSelectedItem(index)" :class="{ active: itemsProperties[selectedItem]}" @mouseout="" class="tw-bg-white tw-border-t first:tw-border-t-0 tw-py-1 hover:tw-bg-blue-600 hover:tw-text-white tw-px-13" @click="onAmountChange(item)">
                                    {{ item | formatAmount }}
                                </li>
                            </ul>

                            <button type="button" @click="startQuote" class="quote-field tw-bg-primary hover:tw-bg-blue-700 tw-text-white tw-py-2 tw-px-8 tw-rounded focus:tw-outline-none focus:tw-shadow-outline tw-w-1/2 tw-capitalize" :disabled="!ready">Start a quote</button>
                        </div>
                        <p class="tw-text-md tw-tracking-widest">Find the coverage your need.</p>
                    </div>
            
                    <div class="tw-mx-8 tw-flex tw-justify-center tw-items-center tw-uppercase tw-text-xl md:tw-tracking-widest tw-my-4 md:m-my-0"> 
                        - or -
                    </div>
            
                    <div class="tw-text-center tw-flex tw-flex-col tw-items-center tw-leading-loose tw-flex-1"> 
                        <h3 class="tw-text-lg md:tw-text-lg sm:tw-m-0 tw-tracking-tight md:tw-tracking-loose">Unsure how much coverage you need?</h3>
                        <div class="tw-flex xs:tw-w-full">
                            <button type="button" class="start-btn tw-bg-white hover:tw-bg-blue-700 hover:tw-text-white tw-w-full tw-text-green-400 tw-font-normal tw-border tw-capitalize tw-border-green-500 hover:tw-border-blue-700 tw-py-2 tw-px-10 tw-rounded focus:tw-outline-none focus:tw-shadow-outline" @click="onShowCalculator" >Take our needs assessment</button>
                        </div>
                        <p>Enter the coverage your need.</p>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>    
</template>

<script>

export default {
    props: ['placeholder', 'show'],
    data() {
        return {
            items: [
                10000,
                20000,
                30000,
                40000,
                50000,
                60000
            ],
            selectedItem: 0,
            itemsProperties: [],
            requestedValue: '',
            showAmountList: false,
            ready: false,
        }
    },
    mounted() {
      this.items.forEach( (item, index) => {
            this.itemsProperties[index] = false;
      });
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
    methods: {
            setSelectedItem(index) {
                 this.selectedItem = index
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
                this.updateAmount(e.currentTarget.value);                   
            },
            onAmountChange(newValue) {
                this.showAmountList = false;
                this.updateAmount(newValue);   
            },
            updateAmount(newValue) {

				this.tempRequestValue = this.formatValuedAmount( newValue );

				if ( !this.isAmount(this.tempRequestValue) ) {
                    toastr.error('Invalid amount');
                    this.requestedValue = '';
                    this.ready = true;
                    return;
				}

				this.requestedValue = this.tempRequestValue;
                this.ready = true;
                this.$emit('change', { amount: this.requestedValue });
            },
            startQuote() {
                this.$emit('next');
            },
            onShowCalculator() {
                this.$emit('showCalculator', {});
            },
            isReady() {
			    return false;
		    }
    }

}
</script>
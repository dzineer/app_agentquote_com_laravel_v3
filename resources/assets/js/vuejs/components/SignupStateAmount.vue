<template>
<div :v-show="show" class="tw-w-full tw-flex tw-justify-center tw-items-center">
	<div class="tw-w-full">

			<div v-if="show" class="dz:section signup-state-amount tw-flex tw-justify-center tw-items-center tw-w-full tw-mt-6">
				<div id="step-1" style="max-height:1px"></div>
				<div class="tw-w-full tw-flex tw-justify-center tw-items-center md:tw-no-margin">
					<div class="tw-flex tw-flex-col tw-text-center tw-w-full">
						<div class="tw-pb-16 tw-border-b">
							<h2 class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">Instant Life Insurance Quote in less than 60 seconds</h2>
							<p class="tw-text-md sm:tw-text-lg tw-tracking-widest">Simply answer a few questions below to get a quote. Quote only applies in respective USA states.</p>
						</div>

						<div class="tw-pb-8 tw-border-b">


								<h2 class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl tw-mt-16">What is the amount of insurance you would like to apply for?</h2>

								<div class="tw-flex tw-justify-center tw-items-center">
									<div @click="decreaseAmount" class="tw-cursor-pointer tw-flex tw-justify-center tw-items-center tw-border-3 tw-border-primary tw-w-10 tw-h-10 tw-rounded-full tw-text-3xl tw-text-primary">-</div>
									<div class="tw-text-3xl tw-px-16" @click="updatingRequestedValue = !updatingRequestedValue" v-if="!updatingRequestedValue">
										{{ requestedValue | formatMoney }}
									</div>
									<input type="text" :value="requestedValue" ref="amountField" v-if="updatingRequestedValue" class="tw-border-b-3 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-text-center tw-text-3xl" @blur="updatingRequestedValue = !updatingRequestedValue" @keyup="e => updateAmount(e.currentTarget.value)">
									<div @click="increaseAmount" class="tw-cursor-pointer tw-flex tw-justify-center tw-items-center tw-border-3 tw-border-primary tw-w-10 tw-h-10 tw-rounded-full tw-text-3xl tw-text-primary tw-my-3">+</div>

								</div>

							<h2 class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">What state do you live in ?</h2>

							<select @change="onStateChange" ref="state" class="tw-border-b-3 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-h-13 tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-3/4 sm:tw-w-full md:tw-w-1/5 tw-text-center" id="state" name="state">
									<option v-for="state in stateNames" :value="state.abbreviation" v-bind:key="state.abbreviation" :selected="state.abbreviation === defaultState">
										{{ state.name }}
									</option>
								</select>

								<p v-if="amountError" class="tw-text-red-600">Please enter a valid amount!</p>

								<div class="dz:section tw-my-6 tw-flex tw-flex-col sm:tw-flex-row tw-justify-center tw-items-center tw-px-8 tw-w-1/2 tw-mx-auto">
		<!-- 						<a @click.prevent="prevStep" class="tw-bg-gray-600 hover:tw-bg-gray-700 sm:tw-mr-2 tw-text-white tw-py-2 tw-px-8 tw-rounded focus:tw-outline-none focus:tw-shadow-outline">Back</a>
		-->						<a @click.prevent="nextStep" class="dz:btn dz:btn-blue tw-text-lg" :disabled="!ready">Next</a>
								</div>

								<secure-confidential-banner></secure-confidential-banner>

							</div>

							<needs-analyzer-banner></needs-analyzer-banner>

					</div>
				</div>
			</div>
	</div>
</div>
</template>

<script>

export default {
    props: ['show', 'defaultAmount', 'defaultState', 'increment'],
    data() {
        return {
			selectedItem: 0,
			selectedState: '',
			itemsProperties: [],
			updatingRequestedValue: false,
            requestedValue: '',
            showAmountList: false,
			ready: false,
			amountError: false,
			stateNames: [
				{
					"name": "Select State",
					"abbreviation": "-1"
				},
				{
					"name": "Alabama",
					"abbreviation": "AL"
				},
				{
					"name": "Alaska",
					"abbreviation": "AK"
				},
/* 				{
					"name": "American Samoa",
					"abbreviation": "AS"
				}, */
				{
					"name": "Arizona",
					"abbreviation": "AZ"
				},
				{
					"name": "Arkansas",
					"abbreviation": "AR"
				},
				{
					"name": "California",
					"abbreviation": "CA"
				},
				{
					"name": "Colorado",
					"abbreviation": "CO"
				},
				{
					"name": "Connecticut",
					"abbreviation": "CT"
				},
				{
					"name": "Delaware",
					"abbreviation": "DE"
				},
/* 				{
					"name": "District Of Columbia",
					"abbreviation": "DC"
				}, */
/* 				{
					"name": "Federated States Of Micronesia",
					"abbreviation": "FM"
				}, */
				{
					"name": "Florida",
					"abbreviation": "FL"
				},
				{
					"name": "Georgia",
					"abbreviation": "GA"
				},
/* 				{
					"name": "Guam",
					"abbreviation": "GU"
				}, */
				{
					"name": "Hawaii",
					"abbreviation": "HI"
				},
				{
					"name": "Idaho",
					"abbreviation": "ID"
				},
				{
					"name": "Illinois",
					"abbreviation": "IL"
				},
				{
					"name": "Indiana",
					"abbreviation": "IN"
				},
				{
					"name": "Iowa",
					"abbreviation": "IA"
				},
				{
					"name": "Kansas",
					"abbreviation": "KS"
				},
				{
					"name": "Kentucky",
					"abbreviation": "KY"
				},
				{
					"name": "Louisiana",
					"abbreviation": "LA"
				},
				{
					"name": "Maine",
					"abbreviation": "ME"
				},
/* 				{
					"name": "Marshall Islands",
					"abbreviation": "MH"
				}, */
				{
					"name": "Maryland",
					"abbreviation": "MD"
				},
				{
					"name": "Massachusetts",
					"abbreviation": "MA"
				},
				{
					"name": "Michigan",
					"abbreviation": "MI"
				},
				{
					"name": "Minnesota",
					"abbreviation": "MN"
				},
				{
					"name": "Mississippi",
					"abbreviation": "MS"
				},
				{
					"name": "Missouri",
					"abbreviation": "MO"
				},
				{
					"name": "Montana",
					"abbreviation": "MT"
				},
				{
					"name": "Nebraska",
					"abbreviation": "NE"
				},
				{
					"name": "Nevada",
					"abbreviation": "NV"
				},
				{
					"name": "New Hampshire",
					"abbreviation": "NH"
				},
				{
					"name": "New Jersey",
					"abbreviation": "NJ"
				},
				{
					"name": "New Mexico",
					"abbreviation": "NM"
				},
				{
					"name": "New York",
					"abbreviation": "NY"
				},
				{
					"name": "North Carolina",
					"abbreviation": "NC"
				},
				{
					"name": "North Dakota",
					"abbreviation": "ND"
				},
/* 				{
					"name": "Northern Mariana Islands",
					"abbreviation": "MP"
				}, */
				{
					"name": "Ohio",
					"abbreviation": "OH"
				},
				{
					"name": "Oklahoma",
					"abbreviation": "OK"
				},
				{
					"name": "Oregon",
					"abbreviation": "OR"
				},
/* 				{
					"name": "Palau",
					"abbreviation": "PW"
				}, */
				{
					"name": "Pennsylvania",
					"abbreviation": "PA"
				},
/* 				{
					"name": "Puerto Rico",
					"abbreviation": "PR"
				}, */
				{
					"name": "Rhode Island",
					"abbreviation": "RI"
				},
				{
					"name": "South Carolina",
					"abbreviation": "SC"
				},
				{
					"name": "South Dakota",
					"abbreviation": "SD"
				},
				{
					"name": "Tennessee",
					"abbreviation": "TN"
				},
				{
					"name": "Texas",
					"abbreviation": "TX"
				},
				{
					"name": "Utah",
					"abbreviation": "UT"
				},
				{
					"name": "Vermont",
					"abbreviation": "VT"
				},
				{
					"name": "Virgin Islands",
					"abbreviation": "VI"
				},
				{
					"name": "Virginia",
					"abbreviation": "VA"
				},
				{
					"name": "Washington",
					"abbreviation": "WA"
				},
				{
					"name": "West Virginia",
					"abbreviation": "WV"
				},
				{
					"name": "Wisconsin",
					"abbreviation": "WI"
				},
				{
					"name": "Wyoming",
					"abbreviation": "WY"
				}
			]
        }
    },
    mounted() {
		this.requestedValue = this.defaultAmount;
		this.ready = this.defaultState.length === 2;
		this.$nextTick(function () {
			// Code that will run only after the
			// entire view has been rendered
			// document.querySelector( that.scrollToOnLoad ).scrollIntoView( { behavior: 'smooth' } );
			// now account for fixed header
			window.scroll(0, 0);
		});
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
		cleanValuedAmount(a) {
			let n = a + "";
			n = n.replace(/\$/g, "");
			n = n.replace(/,/g, "");
			return n;
		},
		formatValuedAmount(a) {
			let n = this.cleanValuedAmount( a );
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
        },
		updateKeyUpAmount(e) {
			this.updateAmount(e.currentTarget.value);
		},
		onAmountChange(newValue) {
			this.showAmountList = false;
			this.updateAmount(newValue);
		},
		updateAmount(newValue) {

			this.tempRequestValue = this.formatMoney( newValue );

			if ( !this.isAmount(this.tempRequestValue) ) {
				toastr.error('Invalid amount');
				'';
				return;
			}

			this.requestedValue = this.tempRequestValue;
			this.$emit('change', { amount: this.requestedValue });
		},
		decreaseAmount() {

			let amount =  parseInt( this.cleanValuedAmount( this.requestedValue ) );
			amount = amount - parseInt(this.increment);

			if (amount < 0) {
				return;
			}

			this.updateAmount( amount+"" );
		},
		increaseAmount() {

			let amount =  parseInt( this.cleanValuedAmount( this.requestedValue ) );
			amount = amount + parseInt(this.increment);

			if (amount >= 10000000) {
				return;
			}

			this.updateAmount( amount+"" );
		},
		onStateChange(e) {
			if (e.target.options.selectedIndex > -1) {
				this.selectedState = e.target.options[ e.target.options.selectedIndex ].value;
				this.ready = true;
				this.$emit('stateChange', { selectedState: this.selectedState } );
			}
		},
		prevStep() {
			this.$emit('prev');
		},
		nextStep() {
			if (this.ready) {
				this.$emit('next');
			}
		}
	},
	watch: {
		defaultState() {
			this.ready = true;
		}
	}
}
</script>

<template>
<div :v-show="show" class="tw-w-full tw-flex tw-justify-center tw-items-center">
        <div  class="tw-w-full">

			<div class="dz:section signup-state-amount tw-flex tw-justify-center tw-items-center tw-w-full tw-my-6">
				<div class="tw-w-full tw-flex tw-justify-center tw-items-center md:tw-no-margin">
					<div class="tw-flex tw-flex-col tw-text-center tw-w-full">

						<div class="tw-pb-8 tw-no-border">
							<h2 class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">You are almost there. Just one more step.</h2>
							<p class="tw-text-md sm:tw-text-xl tw-tracking-widest">In the last twelve (12) months, have you used any substance or products containing tobacco or nicotine, or used e-cigerettes?</p>
							<div class="tw-flex tw-justify-center tw-items-center tw-mx-auto tw-w-full tw-mt-6">
											
										<div class="tw-flex tw-items-center tw-mr-4 tw-mb-4">
											<input id="radio1" type="radio" name="tobacco" class="dz-input tw-hidden" value="Y" :checked="defaultTobacco == 'Y'" @click="onTobaccoChange"  />
											<label for="radio1" class="dz-label tw-flex tw-items-center tw-cursor-pointer tw-text-xl">
												<span class="tw-w-8 tw-h-8 tw-inline-block tw-mr-2 tw-rounded-full tw-border tw-border-grey tw-flex-no-shrink"></span>
												Yes
											</label>
										</div>

										<div class="tw-flex tw-items-center tw-mr-4 tw-mb-4">
											<input id="radio2" type="radio" name="tobacco" value="N" @click="onTobaccoChange" :checked="defaultTobacco == 'N'" class="dz-input tw-bg-gray-900 tw-hidden" />
											<label for="radio2" class="dz-label tw-flex tw-items-center tw-cursor-pointer tw-text-xl">
												<span class="tw-w-8 tw-h-8 tw-inline-block tw-mr-2 tw-rounded-full tw-border tw-border-grey tw-flex-no-shrink"></span>
												No
											</label>
										</div>

								</div>

								<h2 v-if="this.insuranceCategory !== 'fe'" class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">How many years do you require coverage for?</h2>
		<!--                         <p class="tw-text-lg tw-tracking-widest">In the last twelve (12) months, have you used any substance or products containing tobacco or nicotine, or used e-cigerettes?</p>
		-->					    <select v-if="this.insuranceCategory !== 'fe'" @change="onTermChange" ref="term" class="tw-border-b-3 tw-h-13 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0 tw-w-3/4 sm:tw-w-full md:tw-w-1/5 tw-text-center" id="term" name="term">
									<option v-for="term in terms" :value="term.value" v-bind:key="term.value" :selected="term.value == defaultTerm">
										{{ term.text }}
									</option>
								</select>   

								<p v-if="amountError" class="tw-text-red-600">Please enter a valid amount!</p>

								<div class="tw-my-16 tw-pb-8 tw-flex tw-flex-row tw-justify-center tw-items-center tw-px-8 tw-w-1/2 tw-mx-auto">
									<a @click.prevent="prevStep" class="dz:btn tw-text-lg tw-text-white tw-bg-gray-600 hover:tw-bg-gray-700 sm:tw-mr-8 tw-mr-4">Back</a>
									<a @click.prevent="nextStep" class="dz:btn dz:btn-blue tw-text-lg hover:tw-bg-blue-700 tw-text-white" >Next</a>
								</div>

								<secure-confidential-banner></secure-confidential-banner>

							</div>                     

							<!-- <needs-analyzer-banner></needs-analyzer-banner>	 -->

					</div>
				</div>
			</div>
	</div>		
</div>			
</template>

<script>

export default {
    props: ['placeholder', 'show', 'defaultTerm', 'defaultTobacco', 'terms', 'insuranceCategory'],
    data() {
        return {
			term: '10',
			tobacco: '',
			ready: false,
			amountError: false,
			premiums: []
        }
    },
    mounted() {
		this.premiums = this.getPremiums();

		this.$nextTick(function () {
			// Code that will run only after the
			// entire view has been rendered
			// document.querySelector( that.scrollToOnLoad ).scrollIntoView( { behavior: 'smooth' } );
			// now account for fixed header
			window.scroll(0, 0);
		});

		if (this.insuranceCategory === 'fe') {
			this.term = '121';
			this.$emit('termChange', { value: this.term });
		}

    },
    methods: {
		getPremiums() {
			return [{value: 0, text: 'Annual'},{value: 1, text: 'Monthly'},{value: 2, text: 'Quarterly'},{value: 3, text: 'Semiannual'}].map( p => {
				return { key: p.value+p.text, value: p.value, text: p.text }
			});
		},
		onTobaccoChange(e) {
			this.tobacco = e.currentTarget.value;
			this.$emit('tobaccoChange', { value: this.tobacco });
		},
		onTermChange(e) {
			this.term = e.target.options[ e.target.options.selectedIndex ].value;
			this.$emit('termChange', { value: this.term });
		},
		prevStep() {
			this.$emit('prev');
		},
		isReady() {
			this.ready = !! this.tobacco.length > 0;
		},
		nextStep() {
			this.isReady();
			debugger;
			if (this.ready) {
				this.$emit('next');
			}
		}
	}
}
</script>
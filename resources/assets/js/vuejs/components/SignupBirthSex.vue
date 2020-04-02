<template>
<div  :v-show="show" class="tw-w-full tw-flex tw-justify-center tw-items-center">
	<div class="tw-w-full">

			<div class="dz:section signup-state-amount tw-flex tw-justify-center tw-items-center tw-w-full tw-my-6">
				<div id="step-2" style="max-height:1px"></div>
				<div class="tw-w-full tw-flex tw-justify-center tw-items-center md:tw-no-margin">
					<div class="tw-flex tw-flex-col tw-text-center tw-w-full">

						<div class="tw-pb-8 tw-no-border">
							<h2 class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">What is your name / email?</h2>
		<!--                        <p class="tw-text-lg tw-tracking-widest">Simply answer a few questions below to get a quote. Quote only applies in respective USA states.</p>
		-->					   <div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-my-2 tw-w-full sm:tw-w-2/3 sm:tw-w-11/12 tw-mx-auto">
									<div class="tw-flex tw-w-full tw-flex-row tw-justify-center tw-items-center tw-my-2 tw-flex-wrap md:tw-flex-nowrap">
										<div class="tw-w-3/4 tw-my-4 sm:tw-my-2 sm:tw-w-1/3 sm:tw-w-3/12 xs:tw-mr-0 sm:tw-mr-2">
											<input type="text" name="fname" v-model="fname" @change="onFnameChange" class="tw-w-full tw-h-13 focus:tw-outline-none focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mb-1 sm:tw-mb-0 tw-mr-2 tw-px-3 tw-py-2 tw-rounded-none tw-shadow tw-text-center tw-text-gray-700 tw-w-2/5" placeholder="First Name" required>
										</div>
										<div class="tw-w-3/4 tw-my-4 sm:tw-my-2 sm:tw-w-1/3 sm:tw-w-3/12 xs:tw-mr-0 sm:tw-mr-2">
											<input type="text" name="lname" v-model="lname" @change="onLnameChange" class="tw-w-full tw-h-13 focus:tw-outline-none focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mb-1 sm:tw-mb-0 tw-mr-2 tw-px-3 tw-py-2 tw-rounded-none tw-shadow tw-text-center tw-text-gray-700 tw-w-2/5" placeholder="Last Name" required>
										</div>
										<div class="tw-w-3/4 tw-my-4 sm:tw-my-2 sm:tw-w-1/3 sm:tw-w-3/12 xs:tw-mr-0">
											<input type="email" name="email" v-model="email" @change="onEmailChange" class="tw-w-full tw-h-13 focus:tw-outline-none focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mb-1 sm:tw-mb-0 tw-mr-2 tw-px-3 tw-py-2 tw-rounded-none tw-shadow tw-text-center tw-text-gray-700 tw-w-2/5" placeholder="Email" required>
										</div>
									</div>
										<!-- <div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-my-2 tw-w-full">
											<input type="email" name="email" v-model="email" @change="onEmailChange" class="focus:tw-outline-none focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mr-2 tw-px-3 tw-py-2 tw-rounded-none tw-shadow tw-text-center tw-text-gray-700 tw-w-2/5" placeholder="Email" required>
										</div>	 -->
							</div>

						</div>

						<div class="tw-no-border">
							<h2 id="what-is-your-name" class="dz:section-header tw-my-8 tw-text-3xl sm:tw-text-4xl">When were you born?</h2>
							<p class="tw-text-lg tw-tracking-widest">We use your date of birth to calcuate your cost and check your eligibility.</p>
							<div class="tw-flex tw-flex-col tw-justify-center tw-items-center tw-my-2 tw-w-11/12 sm:tw-w-11/12 tw-mx-auto">
									<div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-my-2 tw-w-full tw-flex-wrap md:tw-flex-nowrap">

<!--
 											<select @change="e => onAgeDOBChange('age', e.currentTarget.name, e.currentTarget.value)" ref="age" class="tw-border-b-3 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline xs:tw-mr-4 tw-w-full sm:tw-w-1/5 tw-text-center" id="age" name="age">
												<option v-for="age in ages" :value="age.value" :key="age.value" :selected="age.value == defaultDOBAge">
													{{ age.text }}
												</option>
											</select>  -->

											<!-- <span class="tw-mx-6 tw-w-full tw-my-4 sm:tw-my-0">OR</span> -->

											<select @change="e => onAgeDOBChange('date', 'month', e.currentTarget.value)" ref="bmonth" class="tw-border-b-3 tw-h-13 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-3 sm:tw-mr-2 sm:tw-mb-0 tw-w-4/12 sm:tw-w-3/12 lg:tw-w-1/5 tw-text-center" id="month" name="month">
												<option v-for="mm in calendarOptions.months" :value="mm.value" :key="mm.key" :selected="mm.value == defaultDOBMonth">
													{{ mm.text }}
												</option>
											</select>

											<select @change="e => onAgeDOBChange('date', 'day', e.currentTarget.value)" ref="bday" class="tw-border-b-3 tw-h-13 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-mr-2 sm:tw-mb-0  tw-w-3/12 sm:tw-w-1/3 lg:tw-w-3/12 tw-text-center" id="day" name="day">
												<option v-for="dd in calendarOptions.days" :value="dd.value" :key="dd.key" :selected="dd.value == defaultDOBDay">
													{{ dd.text }}
												</option>
											</select>

											<select @change="e => onAgeDOBChange('date', 'year', e.currentTarget.value)" ref="byear" class="tw-border-b-3 tw-h-13 tw-border-primary tw-rounded-none tw-shadow tw-appearance-none tw-py-2 tw-px-3 tw-text-gray-700 tw-leading-tight focus:tw-outline-none focus:tw-shadow-outline tw-ml-2 sm:tw-mr-2 sm:tw-mb-0 tw-w-4/12 sm:tw-w-3/12 lg:tw-w-1/5 tw-text-center" id="year" name="year">
												<option v-for="yyyy in calendarOptions.years" :value="yyyy.value" :key="yyyy.key" :selected="yyyy.value == defaultDOBYear">
													{{ yyyy.text }}
												</option>
											</select>
									</div>
							</div>

							<h2 class="dz:section-header tw-my-16 tw-mb-8 tw-text-3xl sm:tw-text-4xl">What is your gender?</h2>
							<p class="tw-flex tw-justify-center tw-items-center tw-w-full tw-text-lg tw-tracking-widest">We use your sex to calculate the cost of your coverage. For the purposes of your application, please select your sex assigned at birth, recognizing this may be different from your current gender identity</p>

							<div class="tw-flex tw-justify-center tw-items-center tw-w-full tw-mt-6">

									<div class="tw-flex tw-items-center tw-mr-4 tw-mb-4">
										<input id="radio1" type="radio" name="gender" class="dz-input tw-hidden" value="M" @click="onGenderChange" :checked="defaultGender == 'M'" />
										<label for="radio1" class="dz-label tw-flex tw-items-center tw-cursor-pointer tw-text-xl">
											<span class="tw-w-8 tw-h-8 tw-inline-block tw-mr-2 tw-rounded-full tw-border tw-border-blue-800 tw-flex-no-shrink"></span>
											Male
										</label>
									</div>

									<div class="tw-flex tw-items-center tw-mr-4 tw-mb-4">
										<input id="radio2" type="radio" name="gender" value="F" :checked="defaultGender == 'F'" @click="onGenderChange" class="dz-input tw-bg-gray-900 tw-hidden" />
										<label for="radio2" class="dz-label tw-flex tw-items-center tw-cursor-pointer tw-text-xl">
											<span class="tw-w-8 tw-h-8 tw-inline-block tw-mr-2 tw-rounded-full tw-border tw-border-blue-800 tw-flex-no-shrink"></span>
											Female
										</label>
									</div>
							</div>

							<p v-if="amountError" class="tw-text-red-600">Please enter a valid amount!</p>

							<div class="tw-my-8 tw-pb-8 tw-flex tw-flex-row tw-justify-center tw-items-center tw-px-8 tw-w-1/2 tw-mx-auto">
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
    props: ['placeholder', 'show', 'defaultAmount', 'defaultFirstName', 'defaultLastName', 'defaultEmail', 'defaultDOBAge', 'defaultDOBDay', 'defaultDOBMonth', 'defaultDOBYear', 'defaultGender'],
    data() {
        return {
			scrollToOnLoad: '#what-is-your-name',
			selectedItem: 0,
			selectedState: '',
            itemsProperties: [],
			requestedValue: '',
			gender: '',
            showAmountList: false,
			ready: true,
			amountError: false,
			fname: '',
			lname: '',
			email: '',
			birthdate: {
			   type: '',
			   age: -1,
			   month: -1,
			   day: -1,
			   year: -1
			},
			months: ["JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"],
			benefits: [],
			ages: [],
			premiums: [],
			terms: [],
			calendarOptions: {}
        }
    },
    mounted() {
		this.requestedValue = this.defaultAmount;
		this.benefits = this.generateBenefitOptions();
		this.terms = this.getTermYears();
		this.premiums = this.getPremiums();
		this.ages = this.getAges();
		this.calendarOptions = this.generateCalendarOptions({});
		this.fname = this.defaultFirstName;
		this.lname = this.defaultLastName;
		this.email = this.defaultEmail;
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
        }
    },
    methods: {
		onAgeDOBChange(type, name, value) {
		   this.birthdate.type = type;
		   this.birthdate[name] = value;
		   this.$emit('birthdateChange', this.birthdate)
		   this.isReady();
		},
		generateBenefitOptions() {
			const stops = [
				{ start: 25, end: 201, inc: 25 },
				{ start: 250, end: 950, inc: 50 },
				{ start: 1000, end: 4500, inc: 500 },
				{ start: 5000, end: 10000, inc: 1000 },
			];

			return stops.map( point => {
				let arr = [];
				for (let i = point.start; i < point.end; i = i + point.inc) {
					arr.push({ key:i, value:i, text: this.formatCurrency(i*1000) });
				}
				return arr;
			});
		},
		formatCurrency(s, n, x) {
			let num = parseInt(s);
			let re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
			return '$'+num.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
		},
		range(start, end) {
			return Array(end - start + 1).fill().map((_, idx) => start + idx)
		},
	    getTermYears()	 {
			return [10,15,20,25,30,35,40].map( n => {
				return { key:n, value:n, text: n + " Years" };
			});
		},
		getPremiums() {
			return [{value: 0, text: 'Annual'},{value: 1, text: 'Monthly'},{value: 2, text: 'Quarterly'},{value: 3, text: 'Semiannual'}].map( p => {
				return { key: p.value+p.text, value: p.value, text: p.text }
			});
		},
		getAges() {
			return this.range(-1, 90).map(y => {
				return y === -1 ? { key: y, value: y, text: 'Age' } : { key: y, value: y, text: y + ' year(s) ago' }
			});
		},
		generateCalendarOptions(options) {

			let localOptions = { months: { type: 'abbrr' } };
			let opts =  {...localOptions, ...options};

			let dd = [...Array(31).keys()].map(d => {
				return { key: d+1, value: d+1, text: d+1 };
			});
			dd = [...[{ key: -1, value: -1, text: 'Day'}], ...dd];

			let months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

			let mm = [...Array(12).keys()].map(m => {
				return opts.months.type === 'abbr' ? { key: m+1, value:m+1, text: months[m].substring(0, 3) } : { key: m+1, value:m+1, text: months[m] }
			});
		    mm = [...[{ key: -1, value: -1, text: 'Month'}], ...mm];

			let yyyy = this.range(new Date().getFullYear() - 90, new Date().getFullYear() ).map(y => {
				return { key: y, value: y, text: y };
			})
			yyyy = [...[{ key: -1, value: -1, text: 'Year'}], ...yyyy];

			return { months: mm, days: dd, years: yyyy };

		},
		onFnameChange() {
			this.$emit('fnameChange', { value: this.fname });
		},
		onLnameChange() {
			this.$emit('lnameChange', { value: this.lname });
		},
		onEmailChange() {
			this.$emit('emailChange', { value: this.email });
		},
		setSelectedItem(index) {
				this.electedItem = index
		},
		isNumeric(n) {
			return !isNaN(parseFloat(n)) && isFinite(n);
		},
		onGenderChange(e) {
			debugger;
			this.gender = e.currentTarget.value;
			this.$emit('genderChange', { value: this.gender });
		},
		prevStep() {
			this.$emit('prev');
		},
		isDOBReady() {
		   debugger;
           return !! this.birthdate.type.length &&
				   (parseInt(this.birthdate.month) != -1 && parseInt(this.birthdate.day) != -1 && parseInt(this.birthdate.year) != -1);
		},
		isNameReady() {
            return this.fname.length && this.lname.length;
		},
		isReady() {
			this.ready =
				(this.isDOBReady() &&
				      this.isNameReady() && this.email.length > 0 && this.gender.length > 0);
		},
		nextStep() {
			this.isReady();
			if (this.ready) {
				this.$emit('next');
			}
		}
	}
}
</script>

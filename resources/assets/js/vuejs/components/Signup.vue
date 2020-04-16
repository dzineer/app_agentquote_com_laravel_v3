<template>
        <div v-if="signingUp" class="tw-w-full">

                <fixed-top-nav v-if="showStatusBar" :delay="500" classes="tw-bg-white" offsetFromTheTop="25" >
                    <progress-bar :heading="stepsTitle[currentStep]" :states="states" classes="tw-mt-2 tw-px-8"></progress-bar>
                </fixed-top-nav>

                <signup-bar v-if="showSignupBar" :placeholder="benefitsPlaceholder" :show="showSignupBar" @change="onAmountChange" @showCalculator="onShowCalculator" @next="startQuote"></signup-bar>

                <needs-analyser :show="displayCalculator" @quoteFromCalculator="onQuoteFromCalculator"></needs-analyser>

                <signup-state-amount v-if="stepsState.SignupStateAmount"
                                :defaultAmount="quoteRequest.quoteAmount"
                                :defaultState="quoteRequest.state"
                                :show="stepsState.SignupStateAmount"
                                @change="onAmountChange"
                                @stateChange="onStateChange"
                                @prev="prevStep"
                                :increment="benefitIncrement"
                                @next="nextStep"></signup-state-amount>

                <signup-birth-sex v-if="stepsState.SignupBirthSex" :show="stepsState.SignupBirthSex"
                                :defaultFirstName="quoteRequest.fname"
                                :defaultLastName="quoteRequest.lname"
                                :defaultEmail="quoteRequest.email"
                                :defaultDOBMonth="quoteRequest.birthdate.month"
                                :defaultDOBDay="quoteRequest.birthdate.day"
                                :defaultDOBYear="quoteRequest.birthdate.year"
                                :defaultDOBAge="quoteRequest.birthdate.age"
                                :defaultGender="quoteRequest.gender"
                                @lnameChange="onLastNameChange"
                                @fnameChange="onFirstNameChange"
                                @emailChange="onEmailChange"
                                @stateChange="onStateChange"
                                @genderChange="onGenderChange"
                                @birthdateChange="onBirthdateChange"
                                @prev="prevStep"
                                @next="nextStep"></signup-birth-sex>

                <signup-smoking-term v-if="stepsState.SignupSmokingTerm" :show="stepsState.SignupSmokingTerm"
                                :defaultTerm="quoteRequest.term"
                                :defaultTobacco="quoteRequest.tobacco"
                                @tobaccoChange="onTobaccoChange"
                                @termChange="onTermChange"
                                @prev="prevStep"
                                :terms="terms"
                                :insuranceCategory="insuranceCategory"
                                @next="nextStep"></signup-smoking-term>

                <signup-mobile-verification v-if="stepsState.SignupMobileVerification" :show="stepsState.SignupMobileVerification"
                                @phoneChange="onPhoneChange"
                                @emailChange="onEmailChange"
                                :phone="quoteRequest.phone"
                                :token="token"
                                :sendverificationby="verification_send_method"
                                :email="quoteRequest.email"
                                @showFakeQuote="onShowFakeQuote"
                                @generateQuote="onGenerateQuote"></signup-mobile-verification>
        </div>
</template>

<script>
import ProgressBar from './ProgressBar';
import SignupBar from './SignupBar';
import SignupStateAmount from './SignupStateAmount';
import SignupBirthSex from './SignupBirthSex';
import SignupSmokingTerm from './SignupSmokingTerm';
import SignupMobileVerification from './SignupMobileVerification';
import NeedsAnalyser from './NeedsAnalyser.vue';

export default {
    props: ['userid', 'signingUp', 'benefitRequest', 'insuranceCategory', 'benefitLimits'],
    components: {
        ProgressBar, SignupBar, SignupStateAmount, SignupBirthSex, SignupSmokingTerm, SignupMobileVerification, NeedsAnalyser
    },
    data() {
        return {
            socialMediaIcons: [{"name":"facebook","icon":"fa-facebook","link":"https://facebook.com/agentquoter2"},{"name":"facebook","icon":"fa-twitter","link":"https://twitter.com/agentquoter2"},{"name":"facebook","icon":"fa-linkedin","link":"https://instagram.com/agentquoter2"}],
            showSignupBar: true,
            displayCalculator: false,
            showStatusBar: false,
            stepsState: {
                'SignupStateAmount': false,
                'SignupBirthSex': false,
                'SignupSmokingTerm': false,
                'SignupMobileVerification': false,
            },
            steps: [],
            currentStep: 0,
            states: [
                'in-progress',
                'not-completed',
                'not-completed',
                'not-completed',
            ],

            verification_send_method: 'phone',
            token: null,
            quoteRequest: {
                category: 1,
                id: 3,
                quoteAmount: 0,
                state: '',
                phone: '',
                fname: '',
                lname: '',
                email: '',
                gender: '',
                tobacco: '',
                term: '',
                premium: 1,
                birthdate: {
                    type: '',
                    age: -1,
                    month: -1,
                    day: -1,
                    year: -1
                }
            },
            terms: [],
            benefitsPlaceholder: '',
            benefitIncrement: 0
        }
    },
    mounted() {

            this.steps = [
                'SignupStateAmount',
                'SignupBirthSex',
                'SignupSmokingTerm',
                'SignupMobileVerification',
            ];

            this.stepsTitle = [
                'Step 1 of 4: Choose your state and coverage amount',
                'Step 2 of 4: Provide your name, birthdate, and gender',
                'Step 3 of 4: Provide Smoking status and years of coverage',
                'Step 4 of 4: Verify your mobile number',
            ];

            this.socialMediaIcons = [{"name":"facebook","icon":"fa-facebook","link":"https://facebook.com/agentquoter2"},{"name":"facebook","icon":"fa-twitter","link":"https://twitter.com/agentquoter2"},{"name":"facebook","icon":"fa-linkedin","link":"https://instagram.com/agentquoter2"}];
            this.category = this.insuranceCategory;
        // this.category = this.getCategoryFromHash();
            this.category = this.category === '' ? 'termlife' : this.category;
            this.terms = this.getTermYears();
            this.setBenefitPlaceHolderValues();

            this.benefitIncrement = this.getBenefitIncrements();

        //  this.showSignupBar = false;
        //  this.stepsState.SignupMobileVerification = true;
        window.vueEvents.$on('restartQuote', this.restartQuote);

    },
    methods: {
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
        commaFormatAmount(a) {
            let n = this.cleanValuedAmount( a );
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n;
        },
        parseParams(str) {
            var pieces = str.split("&"), data = {}, i, parts;
            // process each query pair
            for (i = 0; i < pieces.length; i++) {
                parts = pieces[i].split("=");
                if (parts.length < 2) {
                    parts.push("");
                }
                data[decodeURIComponent(parts[0])] = decodeURIComponent(parts[1]);
            }
            return data;
        },
        getCategoryFromHash() {
            return location.hash.length > 0 ? location.hash.substr(1) : '';
        },
        getCategoryFromURL() {
            return this.parseParams(location.href);
        },
        onBirthdateChange( birthdate ) {
            this.quoteRequest.birthdate = birthdate;
        },
        hasPrev() {
            return this.currentStep > 0;
        },
        hasNext() {
            return this.currentStep+1 < this.steps.length;
        },
        prev() {
            if (this.hasPrev()) {
                this.currentStep--;
                return true;
            }
            return false;
        },
        next() {
            if (this.hasNext()) {
                this.currentStep++;
                return true;
            }

            return false;
        },
        prevStep() {
         //   toastr.success(`Continuing quote with amount: ${this.quoteAmount}...`);

            if (this.hasPrev()) {
                this.updateProgressStatus( this.currentStep, 'not-completed');
                this.stepsState[ this.steps[this.currentStep] ] = false;
                this.prev();
                this.updateProgressStatus( this.currentStep, 'in-progress');
                this.stepsState[ this.steps[this.currentStep] ] = true;
            }

        },
        restartQuote() {
            window.vueEvents.$emit('show-section-views');
            this.showStatusBar = false;
            this.showSignupBar = true;
            this.displayCalculator = false;
          //  this.stepsState[ this.steps[this.currentStep] ] = true;
        },
        startQuote() {
            window.vueEvents.$emit('hide-section-views');
            this.showStatusBar = true;
            this.showSignupBar = false;
            this.stepsState[ this.steps[this.currentStep] ] = true;
           // this.reload();
        },
        nextStep() {
            if (this.hasNext()) {

                this.updateProgressStatus( this.currentStep, 'completed');
                this.stepsState[ this.steps[this.currentStep] ] = false;
                this.next();
                this.updateProgressStatus( this.currentStep, 'in-progress');
                this.stepsState[ this.steps[this.currentStep] ] = true;

            }
        },
        updateProgressStatus( statePos, newStatus ) {
            this.states[ statePos ] = newStatus;
        },
        onAmountChange(quote) {
            this.quoteRequest.quoteAmount = quote.amount;
         //   this.quoteRequest.quoteAmount = this.cleanValuedAmount(this.quoteRequest.quoteAmount) / 1000;
         //   toastr.success(`Updating quote amount: ${ this.quoteRequest.quoteAmount }...`);
        },
        onStateChange(state) {
            this.quoteRequest.state = state.selectedState;
            // toastr.success(`Updating selected state: ${this.quoteRequest.selectedState}...`);
        },
        onGenderChange(gender) {
            this.quoteRequest.gender = gender.value;
        },
        onPhoneChange(phone) {
            this.quoteRequest.phone = phone.value;
        },
        onTobaccoChange(tobacco) {
            this.quoteRequest.tobacco = tobacco.value;
        },
        onTermChange(term) {
            this.quoteRequest.term = term.value;
        },
        onFirstNameChange(fname) {
            this.quoteRequest.fname = fname.value;
        },
        onLastNameChange(lname) {
            this.quoteRequest.lname = lname.value;
        },
        onEmailChange(email) {
            this.quoteRequest.email = email.value;
        },
        onShowFakeQuote() {
            // debugger;
            this.$emit('generateFakeQuote');
        },
        getBenefitLimits() {
            if (this.category === 'termlife') {
                return {
                    min: 25000, max: 10000000
                };
            } else if (this.category === 'fe') {
                return {
                    min: 5000, max: 100000
                };

            } else if(this.category === 'sit') {
                return {
                    min: 25000, max: 400000
                };
            } else {
                return {
                    min: 1, max: 10000000
                };
            }
        },
        setBenefitPlaceHolderValues() {
            const limits = this.getBenefitLimits();
            // debugger;
            this.benefitsPlaceholder = this.commaFormatAmount(limits.min) + ' - ' + this.commaFormatAmount(limits.max)
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
                });
            } else {
                return [ {name: 'No Category Provided', value: 0} ];
            }
        },
        getCategoryId() {
            // debugger;
            if (this.insuranceCategory === 'termlife') {
                return '1';
            } else if (this.insuranceCategory === 'fe') {
                return '4';
            } else if(this.insuranceCategory === 'sit') {
                return '2';
            } else {
                return 0;
            }
        },
        getBenefitIncrements() {
            if (this.category === 'termlife') {
                return 50000;
            } else if (this.category === 'fe') {
                return 50000;
            } else if(this.category === 'sit') {
                return 25000;
            } else {
                return 0;
            }
        },
        onGenerateQuote() {

            // debugger;

            const token = jQuery('meta[name="csrf-token"]').attr('content');

            axios.defaults.headers.common = {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': token
            };
            // debugger;
            let url = '/api/app_module?module='+'phone_validation_module';//  + '?module='+'phone_validation_module';
            url = '/api/user/quote/generate';
            let fd = new FormData();

            fd.append("user_id" , this.userid);
            fd.append("id" , this.quoteRequest.id);
            fd.append("state" , this.quoteRequest.state);
            fd.append("email" , this.quoteRequest.email);
            fd.append("name" , this.quoteRequest.fname + ' ' + this.quoteRequest.lname);
            fd.append("phone" , this.quoteRequest.phone);

            if (this.quoteRequest.birthdate.type === 'age') {
                fd.append("month" , this.quoteRequest.birthdate.month === -1 ? 1 : this.quoteRequest.birthdate.month );
                fd.append("day" , this.quoteRequest.birthdate.day === -1 ? 1 : this.quoteRequest.birthdate.day );
                fd.append("year" , this.quoteRequest.birthdate.year === -1 ? 1 : this.quoteRequest.birthdate.year );
            } else {
                fd.append("month" , this.quoteRequest.birthdate.month );
                fd.append("day" , this.quoteRequest.birthdate.day );
                fd.append("year" , this.quoteRequest.birthdate.year );
            }

            fd.append("gender" , this.quoteRequest.gender);
            fd.append("term" , this.quoteRequest.term);
            fd.append("tobacco" , this.quoteRequest.tobacco);
            fd.append("benefit" ,
                parseInt(
                    this.cleanValuedAmount(this.quoteRequest.quoteAmount)
                ) / 1000
            );
            fd.append("period" , this.quoteRequest.premium);
            fd.append("age" , this.quoteRequest.birthdate.age);
            fd.append("age_or_date" , this.quoteRequest.birthdate.type);

            const categoryId = this.getCategoryId();

            fd.append("category" , categoryId);

/*                 let options = {
               //     'verification_code' : this.verification.code,
                    'token' : token,
                    'phone' : this.phone,
                    'module': 'phone_validation_module'
                }; */

            //    fd.append("options" , JSON.stringify(options) );
            //    fd.append("action" , 'update' );
            this.$root.$emit('quoteUpdated', { "value": this.quoteRequest });

            axios.post(url, fd).then( res => {
                console.log(res);
                if (res.statusText === "OK") {

                    if (res.data.success === true) {
                    //    location.href = res.data.redirect;
                        this.token = res.data.token;
                    } else {
                        // we are assuming that the phone number could not receive OTP
                        if (res.data.message.length && res.data.hasOwnProperty('token') && res.data.token.length > 0 ) {
                            this.token = res.data.token;
                            this.verification_send_method = 'email';
                        }
                    }

                }
            });

            // toastr.info('Verifying verification code...');
            // toastr.info('Verification successful.');
        },
        onShowCalculator() {
            this.showSignupBar = false;
            this.displayCalculator = true;
        },
        onQuoteFromCalculator(calculator) {
            this.quoteRequest.quoteAmount = calculator.value;
            this.displayCalculator = false;
            this.startQuote();
        }
    },
    watch: {
        benefitRequest(amount) {
            if (amount !== 'undefined') {
                this.quoteRequest.quoteAmount = amount;
            }
        }
    }
}
</script>

<template>

    <div class="tw-pb-8 tw-px-8 tw-no-border">

        <h2 class="dz:section-header tw-mt-0 tw-mb-6 sm:tw-mb-8 tw-text-3xl sm:tw-text-4xl">We need to confirm your identity</h2>
        <p class="tw-w-full tw-text-justify sm:tw-text-center tw-text-md sm:tw-text-lg tw-tracking-widest">Due to the amount of fraudulent requests, we require a quick verification to confirm your phone number you provided us earlier. You should receive a 5-digit verification code shortly. If you don't receive a code with-in 15 seconds check your email. <strong>Once confirmed you will be redirected to your instant quote.</strong> </p>

        <p class="tw-my-8 tw-text-2xl sm:tw-text-3xl tw-text-gray-800 tw-uppercase" v-if="showPhoneField">Enter Mobile Number For Your Instant Quote</p>
        <p class="tw-my-8 tw-text-2xl sm:tw-text-3xl tw-text-gray-800 tw-uppercase" v-if="verification.showEmailField">Enter Email For Your Instant Quote</p>

        <p class="tw-my-8 tw-mb-4 tw-text-2xl sm:tw-text-3xl tw-text-gray-800" v-if="verification.showVerificationByPhone">Mobile Number Verification</p>
        <p class="tw-my-8 tw-mb-4 tw-text-2xl sm:tw-text-3xl tw-text-gray-800" v-if="verification.showVerificationByEmail">Email Address Verification</p>

        <p class="tw-flex tw-w-full tw-justify-center tw-items-center tw-text-justify sm:tw-text-center tw-my-8 tw-text-md sm:tw-text-lg tw-font-semibold tw-tracking-widest tw-italic tw-text-red-600" v-if="verification.showEmailField">Phone verification failed. To receive to your verification code be sure to provide a valid email address below.</p>
        <p class="tw-flex tw-w-full tw-justify-center tw-items-center tw-text-justify sm:tw-text-center tw-my-8 tw-text-md sm:tw-text-lg tw-font-semibold tw-tracking-widest tw-italic tw-text-red-600" v-if="phoneVerificationFailed">Phone verification failed. We have sent the verification code to the following email address: {{ verification.email }}.</p>

        <p class="tw-my-3 tw-my-8 tw-text-lg sm:tw-text-xl tw-tracking-widest tw-text-gray-800" v-if="verification.showVerificationField" v-text="status">
        </p>

        <p class="tw-my-3 tw-my-8 tw-text-lg sm:tw-text-xl tw-tracking-widest tw-text-gray-800" v-if="showPhoneField">A 5-digit code will be sent to:
        <p class="tw-my-3 tw-my-8 tw-text-lg sm:tw-text-xl tw-tracking-widest tw-text-gray-800" v-if="verification.showEmailField">5-digit code will be sent to your email address:
        </p>

        <i class="tw-flex tw-justify-center tw-items-center tw-mt-1 tw-mb-2 tw-text-md tw-tracking-widest tw-text-gray-800" v-if="verification.showVerificationByPhone">
            <a @click.prevent="onShowPhoneField"
                v-if="verification.showVerificationByPhone"
                class="tw-cursor-pointer tw-underline"
                :disabled="!verification.ready" >Change mobile number</a>
        </i>

        <i class="tw-flex tw-justify-center tw-items-center tw-mt-1 tw-mb-2 tw-text-md tw-tracking-widest tw-text-gray-800" v-if="verification.showVerificationByEmail">
            <a @click.prevent="verification.showVerificationField = false; verification.showVerificationByEmail = false; verification.showVerificationByPhone = false;  verification.showPhoneField = false; verification.showEmailField = true;"
                class="tw-cursor-pointer tw-underline"
                :disabled="!verification.ready" >Change email address</a>
        </i>

        <div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-my-2">

            <div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-my-2 tw-w-full sm:tw-w-2/3 md:tw-w-1/2 xs:tw-mr-0 tw-mr-2">

                <input type="text" name="phone" class="focus:tw-outline-none tw-h-13 focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mr-4 tw-px-3 tw-py-4 tw-shadow tw-text-center tw-text-gray-700 tw-w-1/2 sm:tw-w-2/5"
                    v-if="showPhoneField"
                    placeholder="Phone"
                    @paste.prevent
                    v-model="phone"
                    @keyup="onPhoneUpdate"
                    @change="onPhoneChange"
                    :disabled="sending"
                    required>

                <button @click.prevent="onGenerateQuote"
                 v-if="showPhoneField"
                class="tw-cursor-pointer tw-no-underline tw-rounded tw-py-4 tw-h-13 tw-px-4 sm:tw-px-8 tw-uppercase tw-font-semibold tw-bg-primaryBright tw-text-white tw-w-1/2 sm:tw-w-2/5"
                :disabled="sending" >
                <icon v-if="sending" name="refresh" classes="tw-inline-block fa-spin fa-fw tw-mr-2" />
                <span class="tw-sr-only">Loading...</span>
                Send Code
                </button>

                <input type="text" name="code" class="focus:tw-outline-none tw-h-13 focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mr-4 tw-px-3 tw-py-4 tw-shadow tw-text-center tw-text-gray-700 tw-w-1/2 sm:tw-w-2/5"
                    v-if="verification.showVerificationField"
                    placeholder="Code"
                    v-model="verification.code"
                    @keyup="onValidationCodeUpdate"
                    :disabled="verifying"
                    required>

                <button @click.prevent="onValidateCode"
                v-if="verification.showVerificationField"
                class="tw-cursor-pointer tw-no-underline tw-rounded tw-py-4 tw-h-13 tw-px-4 sm:tw-px-8 tw-uppercase tw-font-semibold tw-bg-primaryBright tw-text-white tw-w-1/2 sm:tw-w-2/5"
                :disabled="verifying"
                 >
                 <icon v-if="verifying" name="refresh" classes="tw-inline-block fa-spin fa-fw tw-mr-2" />
                 <span class="tw-sr-only">Loading...</span>
                 {{ captions.verifyButton }}
                 </button>

                <input type="text" name="email" class="focus:tw-outline-none tw-h-13 focus:tw-shadow-outline sm:tw-mb-0 tw-appearance-none tw-border-b-3 tw-border-primary tw-leading-tight tw-mr-4 tw-px-3 tw-py-4 tw-shadow tw-text-center tw-text-gray-700 tw-w-1/2 sm:tw-w-2/5"
                    v-if="verification.showEmailField"
                    placeholder="Email"
                    v-model="verification.email"
                    @change="onEmailUpdate"
                    :disabled="sending"
                    required>

                <button @click.prevent="onSendEmail"
                v-if="verification.showEmailField"
                class="tw-cursor-pointer tw-no-underline tw-h-13 tw-rounded tw-py-4 tw-px-8 tw-uppercase tw-font-semibold tw-bg-primaryBright tw-text-white tw-w-1/2 sm:tw-w-2/5"
                :disabled="!verification.ready || sending" >
                <icon v-if="sending" name="refresh" classes="tw-inline-block fa-spin fa-fw tw-mr-2" />
                <span class="tw-sr-only">Loading...</span>
                Send
                </button>

            </div>

        </div>

        <secure-confidential-banner></secure-confidential-banner>

        <a v-if="false" class="tw-underline tw-cursor-pointer tw-mr-4" @click.prevent="onShowPhoneField" :disable="showPhoneField">Show Phone</a>
        <a v-if="false" class="tw-underline tw-cursor-pointer tw-mr-4" @click.prevent="onShowPhoneVerification" :disable="verification.showVerificationByPhone">Show Phone Validation</a>
        <a v-if="false" class="tw-underline tw-cursor-pointer tw-mr-4" @click.prevent="onShowEmailVerification"  :disable="verification.showVerificationByPhone">Show Email Validation</a>
        <a v-if="false" class="tw-underline tw-cursor-pointer" @click.prevent="onShowEmailField" :disable="verification.showVerificationByPhone">Show Phone Validation Failed</a>
    </div>
</template>


<script>
import Icon from "./Icon";
export default {
    props: ['email', 'token', 'sendverificationby'],
    components: { Icon },
    data() {
        return {
            sending: false,
            verifying: false,
            phone: '',
            ready: false,
            showPhoneField: true,
            status: '',
            phoneVerificationFailed: false,
            captions: {
                verifyButton: 'Verify'
            },
            verification: {
                code: '',
                email: '',
                requiredLength: 5,
                ready: false,
                showVerificationByPhone: false,
                showVerificationByEmail: false,
                showVerificationField: false,
                showEmailField: false,
                verificationFailed: false
            },
            // phoneExpression: /^(1\s?)?((\([0-9]{3}\))|[0-9]{3})[\s\-]?[\0-9]{3}[\s\-]?[0-9]{4}$/
            phoneExpression: /^\(?(\d{3})\)?[- ]?(\d{3})[- ]?(\d{4})$/
        }
    },
    mounted() {
         this.verification.email = this.email;
    },
    filters: {
        formatPhone( phone ) {
            return phone.replace(/[^0-9]/g, '')
                .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        }
    },
    methods: {
        isNumeric(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        },
        showVerificationField() {
            this.showPhoneField = false;
            this.verification.showVerificationByPhone = false;
            this.verification.showVerificationByEmail = false;
            this.verification.showVerificationField = false;
            this.verification.showEmailField = false;
            this.verification.showVerificationField = true;
        },
        onShowPhoneField() {
            this.showPhoneField = true;
            this.verification.showVerificationByPhone = false;
            this.verification.showVerificationByEmail = false;
            this.verification.showVerificationField = false;
            this.verification.showEmailField = false;
        },
        onShowPhoneVerification() {
            this.verification.showVerificationField = true;
            this.verification.showVerificationByEmail = false;
            this.verification.showVerificationByPhone = true;
            this.showPhoneField = false;
            this.verification.showEmailField = false;
        },
        onShowEmailVerification() {
            this.verification.showEmailField = false;
            this.verification.showVerificationField = true;
            this.verification.showVerificationByEmail = true;
            this.verification.showVerificationByPhone = false;
            this.showPhoneField = false;
            this.showPhoneField = false;
        },
        onShowEmailField() {
            this.verification.showVerificationField = false;
            this.verification.showVerificationByEmail = false;
            this.verification.showVerificationByPhone = false;
            this.showPhoneField = false;
            this.verification.showEmailField = true;
            this.showPhoneField = false;
        },
        onPhoneChange() {
            if(!this.isReady()) {
                toastr.error('Invalid phone number.');
                return;
            }
            this.$emit('phoneChange', { value: this.phone } );
        },
        onPhoneUpdate(e) {

            if(!this.isReady()) {
                // toastr.error('Invalid phone number.');
                return;
            }

            this.$emit('phoneChange', { value: this.phone } );

            if (e.keyCode === 13) /* enter key */ {
                return this.onGenerateQuote(e);
            }

        },
        onEmailUpdate() {
            this.$emit('emailChange', { value: this.verification.email } );
            toastr.info('Updating email address...');
        },
        onValidationCodeUpdate(e) {
            if (e.keyCode === 13) /* enter key */ {
                return this.onValidateCode(e);
            }

            if(! this.isNumeric(this.verification.code) && this.verification.code.length === this.verification.requiredLength) {
                this.verification.ready = false;
            }
        },
		isReady() {
            this.ready = this.phoneExpression.test(this.phone);
            return this.ready;
        },
        onValidateCode() {
            this.verification.ready = true;

            this.captions.verifyButton = 'Verifying...';

            if (this.verification.ready) {

                const token = jQuery('meta[name="csrf-token"]').attr('content');

                axios.defaults.headers.common = {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': token
                };

                // debugger;
                let url = '/api/app_module?module='+'phone_validation_module';//  + '?module='+'phone_validation_module';
                let fd = new FormData();

                let options = {
               //     'verification_code' : this.verification.code,
                    'token' : token,
                    'phone' : this.phone,
                    'module': 'phone_validation_module'
                };

                options = {
                    'verification_code' : this.verification.code,
                    'token' : this.token,
                    'module': 'phone_validation_module'
                };

                fd.append("options" , JSON.stringify(options) );
                fd.append("action" , 'verify' );

                this.verifying = true;

                axios.post(url, fd).then( res => {
                    console.log(res);
                    if (res.statusText === "OK") {

                        if (res.data.success === true) {
                            // debugger;
                            window.vueEvents.$emit('generateQuote', { data: res.data, token: this.token } );
                            this.verifying = false;
                            // location.href = res.data.redirect;
                        } else {
                            this.captions.verifyButton = 'Verifying...';
                            this.verifying = false;
                        }

                    }
                });

				// toastr.info('Verifying verification code...');
                // toastr.info('Verification successful.');

			}
        },
        onGenerateQuote() {
            // debugger;
            this.sending = true;
            this.$emit('generateQuote');
        },
        onSend() {
            if (this.isReady()) {
				// toastr.info('Sending verification code...');
                // toastr.info('Verification code sent.');
                this.showPhoneField = false;
                this.verification.showVerificationByPhone = true;
			}
        },
        onSendEmail() {
            if (this.isReady()) {
				// toastr.info('Sending verification code...');
                // toastr.info('Verification code sent.');
// just comment
                this.sending = true;
                this.verification.showEmailField = false;
                this.verification.showVerificationByPhone = true;
			}
        }
    },
    watch: {
        token(value) {
            // when we get a token value change that means that we have a quote request token now.
            // display verification code form
            this.status = 'Enter the 5-digit code.';
            this.showVerificationField();
        },
        sendverificationby(value) {
            if(this.sendverificationby === 'email') {
               // this.phoneVerificationFailed = true;
               // this.status = 'Enter the 5-digit code sent to your email address:';
               this.showVerificationField();
            }
        }
    }

}
</script>

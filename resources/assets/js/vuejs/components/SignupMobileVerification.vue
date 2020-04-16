<template>
<div :v-show="show" class="tw-w-full tw-flex tw-justify-center tw-items-center">
        <div  class="tw-w-full">

			<div class="dz:section signup-state-amount tw-flex tw-justify-center tw-items-center tw-w-full tw-my-6">
				<div class="tw-w-full tw-flex tw-justify-center tw-items-center md:tw-no-margin">
					<div class="tw-flex tw-flex-col tw-text-center tw-w-full">

							<code-verification
								@phoneChange="onPhoneChange"
								@emailChange="onEmailChange"
								@generateQuote="onGenerateQuote"
								@showFakeQuote="onShowFakeQuote"
								:email="email"
								:token="token"
								:sendverificationby="sendverificationby"
								></code-verification>
							<!-- <needs-analyzer-banner></needs-analyzer-banner>	 -->

					</div>
				</div>
			</div>
	</div>
</div>
</template>


<script>
import CodeVerification from './CodeVerification';
export default {
	props: ['placeholder', 'show', 'email', 'token', 'sendverificationby'],
	components: {
        CodeVerification
	},
    data() {
        return {
			ready: false,
        }
    },
    mounted() {
		this.$nextTick(function () {
			// Code that will run only after the
			// entire view has been rendered
			// document.querySelector( that.scrollToOnLoad ).scrollIntoView( { behavior: 'smooth' } );
			// now account for fixed header
			window.scroll(0, 0);
		});
    },
    methods: {
		onPhoneChange(phone) {
			this.phone = phone.value;
			this.isReady();
			this.$emit('phoneChange', phone );
		},
		onEmailChange(phone) {
			this.$emit('emailChange', phone );
		},
		onGenerateQuote() {
			this.$emit('generateQuote');
		},
		onShowFakeQuote(data) {
			// debugger;
			this.$emit('showFakeQuote', data);
		},
		prevStep() {
			this.$emit('prev');
		},
		isReady() {
			this.ready = !! this.phone.length > 9;
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

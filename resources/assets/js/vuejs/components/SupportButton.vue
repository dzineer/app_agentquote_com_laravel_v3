<template>
    <div>
        <a href="#" 
            class="tw-text-transparent-50 tw-text-gray-500 hover:tw-text-white"
            @click.prevent="$modal.show('contact-support-modal')">Support</a>

        <modal
            name="contact-support-modal"
            height="auto"
            width="100%"
            :pivotY="1"
            classes="tw-bg-white tw-rounded-none tw-shadow-innner"
        >
            <div class="tw-py-6 tw-container tw-mx-auto">
                <h1 class="tw-text-center tw-text-2xl">Have a question</h1>
                <form 
                    action="" 
                    class="tw-p-8 lg:tw-w-1/2 md:tw-mx-auto"
                    autocomplete="off"
                    @keydown="submitted = false"
                    @submit.prevent="contactSupport"
                >
                    <div class="control">
                        <input 
                            type="text"
                            name="name"
                            id="name"
                            class="input is-minimal lg:tw-placeholder-gray-800::placeholder"
                            placeholder="What's your name?"
                            v-model="message.name"
                            @keydown="delete errors.name"
                            required>
                    </div>

                    <span class="tw-text-xs tw-text-red-600"
                        v-text="errors.name"
                        v-if="errors.name"
                    >
                        
                    </span>

                    <div class="control">
                        <input 
                            type="email"
                            name="email"
                            id="email"
                            class="input is-minimal"
                            placeholder="Which email address should we respond to?"
                            v-model="message.email"
                            @keydown="delete errors.email"
                            required>
                    </div>

                    <div class="control">
                        <textarea 
                            name="question"
                            id="body"
                            data-autosize
                            class="textarea is-minimal"
                            placeholder="What's your question?"
                            v-model="message.question"
                            @keydown="delete errors.question"
                            required>
                            </textarea>
                    </div>

                    <div class="control">
                        <input 
                            name="verification"
                            id="verification"
                            class="input is-minimal"
                            placeholder="What is 1 + 4?"
                            v-model="message.verification"
                            @keydown="delete errors.verification"
                            required />
                            
                    </div>

                    <div class="tw-flex tw-justify-end tw-mt-4">
                        <a class="tw-bg-transparent hover:tw-bg-blue-500 tw-text-blue-700 tw-font-semibold hover:tw-text-white tw-py-1 tw-px-8 tw-border tw-border-gray-500 hover:tw-border-transparent tw-rounded-full tw-mr-4 tw-uppercase" 
                           @click.prevent="cancel">Cancel</a>


                        <button class="tw-bg-blue-500 hover:tw-bg-blue-700 tw-text-white tw-font-bold tw-py-1 tw-px-8 tw-rounded-full tw-uppercase" type="submit" :disabled="submitted">Send</button>
                    </div> 

                </form>
            </div>
        </modal>    
    </div>
</template>

<script>
import swal from 'sweetalert';

export default {
    data() {
        return {
            errors: { "name": "The name field is required." },
            message: {
                name: '',
                email: '',
                question: '',
                verification: ''
            },
            submitted: false
        }
    },
    methods: {
        cancel() {
            this.$modal.hide('contact-support-modal');
            this.resetForm();
        },
        contactSupport() {
            this.submitted = true;
            swal("Thanks! We will be in touch soon.");
            this.$modal.hide('contact-support-modal');
            this.resetForm();
            return;
            axios
                .post('/contact', this.message)
                    .then(() => {
                        this.$modal.hide('contact-support-modal');
                    })
                    .catch(errors => {
                        console.log(errors.response.data.errors)
                        this.errors = errors.response.data.errors;
                    })

        },
        resetForm() {
            debugger;
            this.message = {};
            this.submitted = false;
        }
    }
}
</script>

<style>
    
</style>
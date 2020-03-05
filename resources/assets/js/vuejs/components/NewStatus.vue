<template>
    <div class="message">
        <div class="message-header">
            Push to the Stream...
        </div>
        <div class="message-body">
            <form action="" class="form" @submit.prevent="onSubmit">
                <div class="field">
                    <p class="control">
                        <textarea name="" id="" cols="30" rows="10" class="textarea" placeholder="I have something to say..." v-model="form.body" @keydown="form.errors.clear('body')" required></textarea>
                        <span class="help is-danger" v-if="form.errors.has('body')" v-text="form.errors.get('body')" ></span>
                    </p>
                </div>
                <div class="field">
                    <p class="control">
                        <button class="button is-primary" :disabled="form.errors.any()">Submit</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</template>

<script>

import StatusRequest from '../requests/StatusRequest';

export default {
    data() {
        return {
            status: '',
            form: new Form({
                body: ''
            })
        }
    },
    methods: {

        onSubmit() {
            // submit ajax request to the server
            this.form.post('/statuses')
                .then(response => {
                    debugger;
                    toastr.success("Saved.");
                    this.form.reset();
                    this.$emit('completed', response);
                })
                .catch(errors => {
                    toastr.error("Not saved.");
                })
        }
    }
}
</script>
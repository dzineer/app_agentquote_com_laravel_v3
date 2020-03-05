<template>
    <div v-if="displayContent" class="tw-w-full">
        <slot></slot>
    </div> 
</template>

<script>
    export default {
        props: ['view'],
        data() {
            return {
                displayContent: true
            }
        },
        mounted() {
            debugger;
            this.displayContent = this.view;
            window.vueEvents.$on('hide-section-views', this.hideContent);
            window.vueEvents.$on('show-section-views', this.showContent);
            window.vueEvents.$on('toggle-section-views', this.toggleView);
        },
        methods: {
            toggleView() {
                this.displayContent = ! this.displayContent;
            },
            hideContent() {
                this.displayContent = false;
            },
            showContent() {
                this.displayContent = true;
            }            
        }
    }
</script>
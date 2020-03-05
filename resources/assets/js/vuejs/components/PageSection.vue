<template>
    <div class="tw-w-full tw-flex tw-justify-center tw-items-center" :class="container">
        <div class="tw-w-full">

            <div class="" :class="sectionClasses">
                <div class="tw-flex tw-w-full tw-py-2 tw-px-2" :class="frameClasses">
                    
                    <div class="tw-flex" :class="classes">
                        <slot></slot>  
                    </div>
                    
                </div>
            </div>

        </div>
    </div> 
</template>

<script>
    export default {
        props: ['container', 'frameClasses', 'classes', 'sectionClasses'],
        data() {
            return {

            }
        },
        mounted() {

        },
        methods: {

        }
    }
</script>
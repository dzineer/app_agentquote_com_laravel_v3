<template>
    <div class="tw-mb-8 tw-flex">
        <div class="tw-mg-4">
            <span class="tw-w-6 tw-h-6 tw-flex tw-items-center tw-justify-center tw-mr-3 tw-font-bold tw-cursor-pointer" @click="isOpen = ! isOpen">
                <template v-if="isOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 20 20" class="tw-fill-current"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm1.41-1.41A8 8 0 1 0 15.66 4.34 8 8 0 0 0 4.34 15.66zm9.9-8.49L11.41 10l2.83 2.83-1.41 1.41L10 11.41l-2.83 2.83-1.41-1.41L8.59 10 5.76 7.17l1.41-1.41L10 8.59l2.83-2.83 1.41 1.41z"/></svg>
                </template>           
                
                <template v-else>
                    <svg xmlns="http://www.w3.org/2000/svg" height="24" width="24" viewBox="0 0 20 20" class="tw-fill-current"><path d="M11 9h4v2h-4v4H9v-4H5V9h4V5h2v4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16z"/></svg>
                </template>                    
            </span>
        </div>

        <div class="tw-leading-loose">
            <h3 class="tw-font-bold tw-text-2xl tw-mb-3 tw-text-black tw-leading-none tw-cursor-pointer" @click="isOpen = ! isOpen" v-text="question.question"></h3>
            <div v-html="question.answer" v-show="isOpen"></div>
        </div>

    </div>
</template>

<script>
export default {
    props: ['question'],
    data() {
        return {
            isOpen: false
        }
    }
}
</script>
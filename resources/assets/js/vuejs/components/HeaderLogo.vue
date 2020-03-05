<template>
<div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-12 mark-header-logo">
    <div class="dz:section tw-py-4 tw-border-b tw-flex tw-flex-row tw-items-center tw-justify-start tw-text-white tw-w-full" style="min-height: 45px;">
        <div class="tw-flex tw-items-center tw-justify-start">
            <a :href="link" :target="targetName"><img class="brand-logo" :src="path" alt="Website Logo" ></a>    
        </div>
    </div>    
</div>    
</template>

<script>
// https://ppegram.agentquote.com/storage/landing-pages/logos/e4b6fcdacc4c2a4d61126097c47c4a74.png
export default {
    props: ['path', 'target', 'link'],
    data() {
        return {
            targetName: ''
        }
    },
    mounted() {
        this.targetName = '_' + this.target;
    }
}
</script>

<style scoped>
    @media screen AND (max-width: 320px) {
        .brand-logo {
            width: 80%;
            margin-top: 1.8rem;
        }
    }
</style>
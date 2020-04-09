<template>
    <div class="tw-flex tw-w-full tw-border tw-rounded tw-bg-primary tw-text-white tw-py-2 tw-px-2 tw-px-2 tw-mt-4 tw-justify-between tw-flex-col lg:tw-flex-row">
        <p class="tw-text-sm tw-px-2 tw-text-xl lg:tw-text-base" v-text="policy" :class="localStyles.policy"></p>
        <div class="tw-flex tw-flex-col lg:tw-flex-row tw-mt-5 lg:tw-mt-0">
<!--            <a class="hover:tw-underline tw-py-2 lg:tw-py-0 tw-px-2 tw-text-sm tw-cursor-pointer" target="_blank" :class="localStyles.links">
                <icon :name="links[0].icon" classes="tw-inline-block fa-fw tw-mr-0" />
                {{ links[0].text }}
            </a>   -->
            <a class="hover:tw-underline tw-py-2 lg:tw-py-0 tw-px-2 tw-text-sm tw-cursor-pointer" target="_blank" :class="localStyles.links" @click.prevent="toggle">
                <icon :name="links[0].icon" classes="tw-inline-block fa-fw tw-mr-0" />
                {{ links[0].text }}
            </a>
        </div>
    </div>
</template>

<script>

    import Icon from "./Icon";

    export default {
        props: ['policy', 'links', 'togglePolicyDetails'],
        components: {
            Icon
        },
        data() {
            return {
                localStyles: { policy: '', links: '' }
            }
        },
        mounted() {
            this.localStyles = this.styles || this.localStyles;
        },
        methods: {
            toggle() {
                this.$emit('togglePolicyDetails');
            }
        }
    }
</script>

<template>
        <div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-my-4" :class="{ 'tw-mb-6': !forceShowPolicy}">
            <div class="tw-w-full">

                <div v-if="!showPolicy" class="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
                    <div class="tw-flex tw-w-full tw-justify-around tw-rounded tw-py-2 tw-px-2 tw-flex-wrap" :class="{ 'tw-border': !forceShowPolicy}">

                        <div v-if="forceShowPolicy" class="tw-flex tw-w-full">
                            <div class="tw-flex tw-justify-start tw-items-center tw-px-0 sm:tw-mb-6 tw-mb-4">
                                <p class="tw-text-xl">{{ policy }}</p>
                            </div>
                        </div>

                        <div class="tw-flex tw-flex-col sm:tw-flex-row tw-w-full tw-py-2">

                            <carrier-logo :path="logo"></carrier-logo>

                            <rate-classification-items
                                :items="rateClassifications">
                            </rate-classification-items>

                        </div>

                         <quote-item-bar v-show="!forceShowPolicy" :policy="policy" :links="links" :insuranceCategory="insuranceCategory" @togglePolicyDetails="togglePolicyDetails"></quote-item-bar>
<!--
                         <div class="tw-flex tw-w-full tw-border tw-rounded tw-bg-primary tw-text-white tw-py-2 tw-px-2 tw-px-2 tw-mt-4 tw-justify-between tw-flex-col lg:tw-flex-row">
                            <p class="tw-text-sm tw-px-2 tw-text-xl lg:tw-text-base" v-text="policy"></p>
                            <div class="tw-flex tw-flex-col lg:tw-flex-row tw-mt-5 lg:tw-mt-0">
                                <a v-for="link in links" :href="link.href" class="hover:tw-underline tw-py-2 lg:tw-py-0 tw-px-2 tw-text-sm" target="_blank">
                                    <icon :name="link.icon" classes="tw-inline-block fa-fw tw-mr-0" />
                                    {{ link.text }}
                                </a>
                            </div>
                        </div>
-->
                    </div>
                </div>

                <div v-if="showPolicy || forceShowPolicy" class="tw-w-full">
                    <div class="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-mx-auto">
                        <div class="tw-flex tw-flex-col tw-w-full tw-justify-around tw-border tw-rounded tw-py-2 tw-px-4 tw-flex-wrap">
                            <p class="tw-py-2 tw-font-bold tw-text-md" v-text="carrierDetails.name"></p>
                            <p class="tw-py-2" v-text="carrierDetails.address1"></p>
                            <p class="tw-py-2" v-text="carrierDetails.city + ', ' + carrierDetails.state + '  ' + carrierDetails.zipCode "></p>
                            <p class="tw-py-2" v-html="carrierDetails.website"></p>
                            <p class="tw-py-2" v-html="carrierDetails.addressTrailer"></p>
                            <p class="tw-py-2">Policy Form #: {{ carrierDetails.reference }}</p>
                            <button v-show="!forceShowPolicy" class="tw-my-4 tw-py-4 tw-px-6 tw-bg-primary tw-text-white tw-rounded" @click="togglePolicyDetails">Close to return to rate</button>
                        </div>
                    </div>
                </div>

                <div v-if="forceShowPolicy" class="dz:section tw-flex tw-justify-center tw-items-center tw-w-full sm:tw-w-10/12 tw-my-4 tw-mx-auto">
                    <div class="tw-w-full tw-bg-primary" style="height: 2px;">
                    </div>
                </div>

            </div>
        </div>
</template>

<script>

import RateClassificationItems from './RateClassificationItems';
import QuoteItemBar from './QuoteItemBar';
import CarrierLogo from './CarrierLogo';
import Icon from "./Icon";

    export default {
        props: {
            'carrierDetails': {

            },
            'reference': {

            },
            'rateClassifications': {

            },
            'policy': {

            },
            'links': {

            },
            'logo': {

            },
            'insuranceCategory': {

            },
            'forceShowPolicy': {
                type: Boolean,
                default: false
            }
        },
        components: {
            RateClassificationItems, QuoteItemBar, CarrierLogo, Icon
        },
        data() {
            return {
                showPolicy: false,
            }
        },
        methods: {
            togglePolicyDetails() {
                this.showPolicy = !this.showPolicy;
            }

        }
    }
</script>

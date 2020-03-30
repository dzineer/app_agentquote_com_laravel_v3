<template>
    <div v-if="visible" class="tw-container dz:section tw-w-full md:tw-w-11/12 lg:tw-w-11/12 tw-flex tw-justify-center tw-items-center md:tw-no-margin">
        <div class="tw-w-full tw-bg-black na-container tw-rounded-t-xl tw-relative">


            <div class="tw-flex tw-relative">

                <div class="tw-absolute tw-top-0 tw-right-0 tw-w-8 tw-h-8 tw-z-50" style="right: 36px;top: 20px;" @click="closeNeedsAnalyser">
                    <i role="button" class="tw-flex tw-justify-center tw-items-center fa-icon icon-default fa-remove fa-fw tw-rounded-full tw-border tw-border-gray-400 tw-text-black hover:tw-border-0 hover:tw-text-white hover:tw-bg-red-600 tw-w-10 tw-h-10 tw-leading-tight tw-text-center"></i>
                </div>

                <div class="tw-w-1/3">

                    <na-part classes="tw-rounded-tl-xl">
                        part i: family income replacement
                    </na-part>

                    <na-section-header icon="users" title="family income" :show="sectionStates.FAMILY_INCOME" :selected="sectionStates.FAMILY_INCOME" @fieldChange="onFieldChange" @toggle="toggleState('FAMILY_INCOME')" :fields="currentSection()"></na-section-header>

                    <na-section-header icon="refresh" title="income to be replaced" :show="sectionStates.REPLACEMENT_INCOME" :selected="sectionStates.REPLACEMENT_INCOME" @fieldChange="onFieldChange" @toggle="toggleState('REPLACEMENT_INCOME')" :fields="currentSection()" ></na-section-header>

                    <na-section-header icon="university" title="investible family assets" :show="sectionStates.INVESTIBLE_FAMILY_ASSETS" :selected="sectionStates.INVESTIBLE_FAMILY_ASSETS" @fieldChange="onFieldChange" @toggle="toggleState('INVESTIBLE_FAMILY_ASSETS')" :fields="currentSection()" ></na-section-header>

                    <na-part>
                        part ii: debt, college, & other needed
                    </na-part>

                    <na-section-header icon="minus-circle" title="debt repayment" :show="sectionStates.DEBIT_REPAYMENT" :selected="sectionStates.DEBIT_REPAYMENT" @fieldChange="onFieldChange" @toggle="toggleState('DEBIT_REPAYMENT')" :fields="currentSection()" ></na-section-header>

                    <na-desktop-college-header-section icon="graduation-cap" title="college funding" :show="sectionStates.COLLEGE_FUNDING" :selected="sectionStates.COLLEGE_FUNDING" @fieldChange="onFieldChange" @toggle="toggleState('COLLEGE_FUNDING');" :value="this.sections.college_funding" ></na-desktop-college-header-section>

                    <na-section-header icon="balance-scale" title="other expenses" :show="sectionStates.OTHER_EXPENSES" :selected="sectionStates.OTHER_EXPENSES" @fieldChange="onFieldChange" @toggle="toggleState('OTHER_EXPENSES')" :fields="currentSection()" ></na-section-header>
<!--
                    <na-total icon="umbrella" title="total insurance needed" :show="true" :part1="totalPart1" :part2="totalPart2" :total="totalNeeded | formatAmount" ></na-total>
-->

                    <div class="na-section-block tw-w-full" >
                        <div class="section-fields tw-w-full">
                            <div class="tw-cursor-pointer desktop-view-section-heading tw-w-full tw-flex tw-items-center" :class="showTotal ? 'na-total-heading' : ''" @click="toggleTotal">
                                <div class="tw-w-16 tw-h-16 tw-flex tw-justify-center tw-items-center">
                                    <i class="fa-icon icon-default fa-umbrella tw-text-2xl"></i>
                                </div>
                                <h2 class="tw-text-lg tw-text-white tw-font-semibold tw-uppercase tw-ml-4 tw-py-2">insurance needed</h2>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="tw-flex tw-w-2/3 tw-justify-center tw-items-center tw-relative tw-px-4" style="background-color:#F4F3F3;">
                    <!-- <na-header>(Desktop) Total Insurance Needed: {{ totalNeeded | formatAmount }}</na-header> -->

                    <div class="tw-w-3/4 tw-bg-black tw-rounded-b-xl tw-flex tw-absolute tw-justify-center tw-top-0" style="background-color:#2285C4;">
                        <h1 class="tw-py-4 tw-text-2xl tw-font-bold tw-leading-loose tw-tracking-normal tw-uppercase tw-text-white">
                            Total Insurance Needed: {{ totalNeeded | formatAmount }}
                        </h1>
                    </div>

                    <div v-show="showCollegeFields" class="fields tw-w-full tw-py-2 tw-px-1 tw-overflow-auto" style="max-height: 720px;margin-top: 93px;margin-bottom: 20px;">
                        <h2 class="tw-flex tw-justify-center tw-text-center tw-text-2xl" :id="currentState">College Funding</h2>
                        <college-field @fieldChange="onFieldChange" header="Number of children" name="total" classes=""  :readonly="false"></college-field>
                        <div class="tw-flex">
                            <button class="tw-w-full tw-rounded tw-bg-primary tw-text-center tw-text-white tw-py-4 tw-px-2 tw-mt-4 tw-mr-2" v-if="previousState !== currentState" @click="toggleState( previousState )">Previous</button>
                            <button class="tw-w-full tw-rounded tw-bg-primary tw-text-center tw-text-white tw-py-4 tw-px-2 tw-mt-4 tw-ml-2" @click="toggleState( nextState )">Continue</button>
                        </div>
                    </div>

                    <div v-if="showGeneralFields" class="fields tw-w-full tw-py-2 tw-px-1 tw-overflow-auto" style="max-height: 720px;margin-top: 93px;margin-bottom: 20px;">
                        <h2 class="tw-flex tw-justify-center tw-text-center tw-text-2xl" :id="currentState">{{ currentHeader }}</h2>
                        <div v-for="(field, index) in currentSection()" :key="index" @fieldChange="onFieldChange" :header="field.text" :name="field.name" :value="field.value" :class="field.classes" :readonly="field.readonly" :is="field.component"></div>
                        <div class="tw-flex">
                            <button class="tw-w-full tw-rounded tw-bg-primary tw-text-center tw-text-white tw-py-4 tw-px-2 tw-mt-4 tw-mr-2" v-if="previousState !== currentState" @click="toggleState( previousState )">Previous</button>
                            <button class="tw-w-full tw-rounded tw-bg-primary tw-text-center tw-text-white tw-py-4 tw-px-2 tw-mt-4 tw-ml-2" @click="toggleState( nextState )">Continue</button>
                        </div>
                    </div>

                    <div v-if="showTotal" class="fields tw-w-full tw-py-2 tw-px-1 tw-overflow-auto">
                        <h2 class="tw-flex tw-justify-center tw-text-center tw-text-2xl">Total Insurance Needed</h2>
                        <amount-field header="Income Replacement Insurance Needed (Part I)" :value="totalPart1 | formatAmount" :readonly="true"></amount-field>
                        <amount-field header="Total Additional Expenses (Part II)" :value="totalPart2 | formatAmount" :readonly="true"></amount-field>
                        <amount-field header="Total Insurance Needed" :value="totalNeeded | formatAmount" :readonly="true"></amount-field>
                        <button class="tw-bg-primary tw-w-full hover:tw-bg-blue-700 tw-text-white tw-py-5 tw-px-8 tw-rounded focus:tw-outline-none focus:tw-shadow-outline"  @click="onQuoteAmount">Quote Amount</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import NaHeader from './NaHeader';
import NaPart from './NaPart';
import NaSection from './NaSection';
import NaSectionHeader from './NaSectionHeader';
import NaDesktopCollegeHeaderSection from './NaDesktopCollegeHeaderSection';
import NaDesktopTotal from './NaDesktopTotal';
import Fields from './Fields';
import Field from './Field';
import PercentageField from './PercentageField';
import YearField from './YearField';
import AmountField from './AmountField';
import NaDesktopView from './NaDesktopView';
import CollegeField from './CollegeField';
import Icon from './Icon';

export default {
    props: [
        'show', 'sections', 'sectionStates', 'applicationStates', 'totalNeeded', 'previousState', 'currentState', 'nextState', 'currentHeader', 'totalPart1', 'totalPart2', 'nextState'
    ],
    components: {
        NaDesktopView, NaPart, Icon, NaHeader, NaSection, NaSectionHeader, NaDesktopCollegeHeaderSection, NaDesktopTotal, Fields, AmountField, PercentageField, YearField, CollegeField, Field
    },
    mounted() {
        this.visible = this.show;
    },
    data() {
        return {
            visible: false,
            showGeneralFields: true,
            showCollegeFields: false,
            showTotal: false,
            generalHeader: 'Family Income',
            quoteReady: false
        }
    },
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "$" + n;
        }
    },
    methods: {
        onFieldChange(field) {
            this.$emit('fieldChange', field);
        },
        toggleState( newState ) {
            debugger;
            if (newState === 'COLLEGE_FUNDING') {
                this.showGeneralFields = false;
                this.showTotal = false;
                this.showCollegeFields = true;
            }
            else if (newState === 'TOTALS') {
                this.showCollegeFields = false;
                this.showGeneralFields = false;
                this.showTotal = true;
            }
            else {
                this.showCollegeFields = false;
                this.showTotal = false;
                this.showGeneralFields = true;
            }

            this.$emit('toggle', {value: newState});



        },
        closeNeedsAnalyser() {
            window.vueEvents.$emit('restartQuote');
        },
        toggleTotal() {
            this.toggleState('TOTALS');
            this.showCollegeFields = false;
            this.showGeneralFields = false;
            this.showTotal = true;
        },
        currentSection() {
           // console.log("NeedsAnalyserDesktop::currentSection", this.sections[ this.applicationStates[ this.currentState ] ]);
            return this.sections[ this.applicationStates[ this.currentState ] ];
        },
        onQuoteAmount() {
            debugger;
            if (this.totalPart1 + this.totalPart2 > 0.00) {
                this.$emit('quoteFromCalculator', { value: this.totalPart1 + this.totalPart2 } );
            }
        }
    }
/*     watch: {
        showGeneralFields() {
        //    document.getElementById(this.currentState).scrollIntoView();
        },
        showCollegeFields() {
        //    document.getElementById(this.currentState).scrollIntoView();
        }
    } */
}
</script>

<style scoped lang="scss">
</style>

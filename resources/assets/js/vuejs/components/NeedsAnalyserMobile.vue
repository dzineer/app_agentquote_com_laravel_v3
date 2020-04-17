<template>
    <div v-if="show" class="tw-container tw-w-full md:tw-w-11/12 lg:tw-w-4/5 tw-flex tw-justify-center tw-items-center md:tw-no-margin">
        <div class="tw-w-full tw-bg-black na-container tw-rounded-t-xl tw-relative">

           <div class="tw-w-full tw-flex tw-justify-center tw-items-center" @click="closeNeedsAnalyser">
                <button role="button" class="close-btn tw-flex tw-justify-center tw-items-center tw-rounded tw-bg-red-600 tw-text-white tw-leading-tight tw-text-center tw-text-xl tw-pt-1">Close</button>
           </div>

            <na-header>Insurance Needed: {{ totalNeeded | formatCurrency(true) }}</na-header>

            <na-part>
                part i: family income replacement
            </na-part>

            <na-section name="FAMILY_INCOME" icon="users" title="family income" :show="sectionStates.FAMILY_INCOME" @fieldChange="onFieldChange" @toggle="toggleState('FAMILY_INCOME')" @toggleNextState="toggleState('REPLACEMENT_INCOME')" :fields="currentSection()"></na-section>
            <na-section name="REPLACEMENT_INCOME" icon="refresh" title="income to be replaced" :show="sectionStates.REPLACEMENT_INCOME" @fieldChange="onFieldChange" @toggle="toggleState('REPLACEMENT_INCOME')" @toggleNextState="toggleState('INVESTIBLE_FAMILY_ASSETS')" :fields="currentSection()" ></na-section>
            <na-section name="INVESTIBLE_FAMILY_ASSETS" id="" icon="university" title="investible family assets" :show="sectionStates.INVESTIBLE_FAMILY_ASSETS" @fieldChange="onFieldChange" @toggle="toggleState('INVESTIBLE_FAMILY_ASSETS')" @toggleNextState="toggleState('DEBIT_REPAYMENT')" :fields="currentSection()" ></na-section>

            <na-part>
                part ii: debt, college, & other needed
            </na-part>

            <na-section name="DEBIT_REPAYMENT" id="debit-repayment" icon="minus-circle" title="debt repayment" :show="sectionStates.DEBIT_REPAYMENT" @fieldChange="onFieldChange" @toggle="toggleState('DEBIT_REPAYMENT')" @toggleNextState="toggleState('COLLEGE_FUNDING')" :fields="currentSection()" ></na-section>
            <na-college-section name="COLLEGE_FUNDING" id="college" icon="graduation-cap" title="college funding" :show="sectionStates.COLLEGE_FUNDING" @fieldChange="onFieldChange"  @toggleNextState="toggleState('OTHER_EXPENSES')" @toggle="toggleState('COLLEGE_FUNDING')" :value="this.sections.college_funding" ></na-college-section>
            <na-section name="OTHER_EXPENSES" icon="balance-scale" title="other expenses" :show="sectionStates.OTHER_EXPENSES" @fieldChange="onFieldChange" @toggle="toggleState('OTHER_EXPENSES')" @toggleNextState="toggleState('TOTAL')" :fields="currentSection()" ></na-section>

            <div v-show="show" class="fields tw-pb-3 tw-px-2 tw-bla">
                <div v-for="(field, index) in fields" :key="index" @fieldChange="onFieldChange" :header="field.text" :name="field.name" :value="field.value" :placeholder="field.placeholder" :class="field.classes" :readonly="field.readonly" :is="field.component"></div>
<!--
                <button class="tw-bg-primary tw-w-full hover:tw-bg-blue-700 tw-text-white tw-py-5 tw-px-10 tw-rounded focus:tw-outline-none focus:tw-shadow-outline" @click="toggleNextState">Continue</button>
-->
            </div>

            <na-total icon="umbrella" title="insurance needed" :show="true" :part1="totalPart1 | formatCurrency(true)" :part2="totalPart2 | formatCurrency(true)" :total="totalNeeded | formatCurrency(true)" @quoteFromCalculator="onQuoteAmount" ></na-total>

        </div>
    </div>
</template>

<script>
import NaHeader from './NaHeader';
import NaPart from './NaPart';
import NaSection from './NaSection';
import NaCollegeSection from './NaCollegeSection';
import NaTotal from './NaTotal';
import Fields from './Fields';
import Field from './Field';

export default {
    props: [
        'show', 'sections', 'sectionStates', 'applicationStates', 'totalNeeded', 'previousState', 'currentState', 'nextState', 'totalPart1', 'totalPart2'
    ],
    components: {
        NaPart, NaHeader, NaSection, NaCollegeSection, NaTotal, Fields, Field
    },
    mounted() {
        this.visible = true;
        // wait until this component is rendered and loaded
        this.$nextTick(function() {
            const id = 'FAMILY_INCOME';
            const yOffset = -2;
            const element = document.getElementById(id);
            const y = element.getBoundingClientRect().top + window.pageYOffset + yOffset;

            window.scrollTo({top: y, behavior: 'smooth'});
        });
    },
    methods: {
        onFieldChange(field) {
            this.$emit('fieldChange', field);
        },
        toggleState( newState ) {
            // debugger;
            this.$emit('toggle', { value: newState } );
        },
        toggleNextState( newState ) {
            // debugger;
            this.$emit('toggle', { value: newState } );
        },
        currentSection() {
            return this.sections[ this.applicationStates[ this.currentState ] ];
        },
        closeNeedsAnalyser() {
            window.vueEvents.$emit('restartQuote');
        },
        onQuoteAmount() {
            // debugger;
            if (this.totalPart1 + this.totalPart2 > 0.00) {
                this.$emit('quoteFromCalculator', { value: this.totalPart1 + this.totalPart2 } );
            }
        }
    }
}
</script>

<style scoped lang="scss">
    .close-btn {

        border-top-left-radius: 90px;
        border-top-right-radius: 90px;
        background: #dc0e0e;
        display: inline-block;
        height: 45px;
        line-height:45px;
        width: 90px;
        color: white;

    }
</style>

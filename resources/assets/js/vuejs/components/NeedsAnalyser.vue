<template>
<div v-if="show && visible" class="dz:section tw-w-full tw-flex tw-justify-center tw-items-center">
        <div class="tw-w-full">

            <div class="tw-h-screen-off tw-w-full tw-flex tw-justify-center tw-items-center tw-my-6">
                <div class="tw-container dz:section tw-w-full md:tw-w-11/12 lg:tw-w-4/5 tw-flex tw-justify-center tw-items-center md:tw-no-margin">

                    <needs-analyser-mobile
                        :show="isMobile()"
                        :sections="sections"
                        :previousState="previousState"
                        :currentState="currentState"
                        :nextState="nextState"
                        :currentHeader="currentHeader"
                        :sectionStates="sectionStates"
                        :applicationStates="applicationStates"
                        :collegeTuition="collegeTuition"
                        :totalNeeded="total_needed"
                        :totalPart1="total_part_1"
                        :totalPart2="total_part_2"
                        @quoteFromCalculator="quoteFromCalculator"
                        @fieldChange="onFieldChange"
                        @toggle="toggleState"
                    >
                    </needs-analyser-mobile>

                    <needs-analyser-desktop
                        :show="!isMobile()"
                        :sections="sections"
                        :previousState="previousState"
                        :currentState="currentState"
                        :nextState="nextState"
                        :currentHeader="currentHeader"
                        :sectionStates="sectionStates"
                        :applicationStates="applicationStates"
                        :collegeTuition="collegeTuition"
                        :totalNeeded="total_needed"
                        :totalPart1="total_part_1"
                        :totalPart2="total_part_2"
                        @quoteFromCalculator="quoteFromCalculator"
                        @fieldChange="onFieldChange"
                        @toggle="toggleState"
                    >
                    </needs-analyser-desktop>
                </div>
            </div>
    </div>
</div>
</template>

<script>
import NeedsAnalyserMobile from './NeedsAnalyserMobile';
import NeedsAnalyserDesktop from './NeedsAnalyserDesktop';
import _ from 'lodash';

let collegeTuition = {
    data() {
       return {
           public: 25290,
           private: 50900
       }
    },
    getPublic() { return this.public },
    getPrivate() { return this.private }
};

export default {
    props: [
        'show'
    ],
    components: {
        NeedsAnalyserMobile, NeedsAnalyserDesktop
    },
    data() {
        return {
            visible: false,
            view: {
                desktop: true,
                mobile: false
            },
            previousState: '',
            currentState: '',
            nextState: '',
            collegeCosts: 0.00,
            collegeTuition: collegeTuition,
            calculators: {
                family_income: null,
                replacement_income: null,
                investible_family_assets: null,
                debit_repayment: null,
                college_funding: null,
                other_expenses: null
            },
            applicationStates: {
                FAMILY_INCOME: 'family_income',
                REPLACEMENT_INCOME: 'replacement_income',
                INVESTIBLE_FAMILY_ASSETS: 'investible_family_assets',
                DEBIT_REPAYMENT: 'debt_repayment',
                COLLEGE_FUNDING: 'college_funding',
                OTHER_EXPENSES: 'other_expenses'
            },
            applicationHeaders: {
                FAMILY_INCOME: 'Family Income',
                REPLACEMENT_INCOME: 'Replacement Income',
                INVESTIBLE_FAMILY_ASSETS: 'Investible Family Assets',
                DEBIT_REPAYMENT: 'Debt Repayment',
                COLLEGE_FUNDING: 'College Funding',
                OTHER_EXPENSES: 'Other Expenses',
                TOTALS: '',
            },
            sectionStates: {
                FAMILY_INCOME: true,
                REPLACEMENT_INCOME: false,
                INVESTIBLE_FAMILY_ASSETS: false,
                DEBIT_REPAYMENT: false,
                COLLEGE_FUNDING: false,
                OTHER_EXPENSES: false,
                TOTALS: false
            },
            currentHeader: '',
            total_part_1: 0.00,
            total_part_2: 0.00,
            total_needed: 0.00,
            sections: {
                family_income: [
                    { component: 'amount-field', name: 'gross_income', value: 0.00, text: 'your gross income', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'spouse_gross_income', value: 0.00, text: 'Spouse\'s Gross Income (Only include if this income would stop if you were to die) ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'other_gross_income', value: 0.00, text: 'Other Gross Income (Only include if this income would stop if you were to die) ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'total', value: 0.00, text: 'total gross income to be replaced', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                ],
                replacement_income: [
                    { component: 'percentage-field', name: 'percent_income', value: 80, text: 'Desired annual income needs (typically 70-80% of current combined income) ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'total_replacement_income', value: 0.00, text: 'TOTAL REPLACEMENT INCOME NEEDED', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                    { component: 'year-field', name: 'years_income_needed', value: 5, text: 'Years Income Needed ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'percentage-field', name: 'rate_return', value: 0.00, text: 'Rate of Return ?', classes: 'tw-text-gray-800', readonly: false },
                    { component: 'percentage-field', name: 'rate_inflation', value: 0.00, text: 'Rate of Inflation ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'percentage-field', name: 'net_rate_return', value: 0.00, text: 'Net Rate of Return', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                    { component: 'amount-field', name: 'total', value: 0.00, text: 'INITIAL LIFE INSURANCE NEEDED TO REPLACE INCOME(BEFORE OTHER CALCULATIONS)', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                ],
                investible_family_assets: [
                    { component: 'amount-field', name: 'savings', value: 0.00, text: 'Savings ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'investment_portfolio', value: 0.00, text: 'Investment Portfolio ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'current_life_insurance', value: 0.00, text: 'Current Life Insurance ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'other_assets', value: 0.00, text: 'Other Assets ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'total', value: 0.00, text: 'TOTAL AVAILABLE ASSETS ?', classes: 'tw-text-gray-800 tw-text-md', readonly: true }
                ],
                debt_repayment: [
                    { component: 'amount-field', name: 'mortgage', value: 0.00, text: 'Mortgage ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'auto_loan', value: 0.00, text: 'Auto Loan ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'consumer_debt', value: 0.00, text: 'Consumer Debt ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'other_debt', value: 0.00, text: 'Other Debt', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'total', value: 0.00, text: 'TOTAL DEBT', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                ],
                college_funding: [
                    { name:'children', text: 'Number of children', value: 0.00, classes: '' },
                    { name:'total', text: 'Number of children', value: 0.00, classes: '' },
                ],
                other_expenses: [
                    { component: 'amount-field', name: 'funeral', value: 0.00, text: 'Funeral (typical cost of a funeral is approx. $5,000 ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'special_bequests', value: 0.00, text: 'Special Bequests ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'other_expenses', value: 0.00, text: 'Consumer Debt ?', classes: 'tw-text-gray-800 tw-text-md', readonly: false },
                    { component: 'amount-field', name: 'total', value: 0.00, text: 'TOTAL EXPENSES', classes: 'tw-text-gray-800 tw-text-md', readonly: true },
                ]
            }
        }
    },
    mounted() {
        this.currentState = 'FAMILY_INCOME';
        this.currentHeader = this.applicationHeaders[ this.currentState ];
        this.previousState = this.getPreviousState( this.currentState );
        this.nextState = this.getNextState( this.currentState );
        this.visible = true;
      //  _.find(this.sections[ 'family_income' ], { name: 'child 1' }).value = subtotal;
        this.calculators = {
            family_income: {
                family_income: this.familyIncomeCalculator,
                replacement_income: this.replacementIncomeCalculator,
                investible_family_assets: this.investibleFamilyAssetsCalculator,
            },
            other_income: {
                debt_repayment: this.debtRepaymentAssetsCalculator,
                college_funding: this.collegeFundingCalculator,
                other_expenses: this.otherExpensesCalculator
            }
        }
    },
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "$" + n;
        },
        formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
                console.log(e)
            }
        }
    },
    methods: {
        netPVR(r, ir, yy) {
            var rr;

            if (ir == r) {
                return 1;
            }
            else if (r <= 0) {
                return 1;
            }
            else if (r == rr) {
                return 1;
            }

            rr = (r - ir) / 100;

            return (1 - (1 / Math.pow((1 + rr), yy))) / rr;
        },
        familyIncomeCalculator() {
            let subtotal = 0.00;
            this.sections[ 'family_income' ].forEach( field => {
                let a = this.cleanValuedAmount( field.value );
                if (field.name !== 'total' && a.length > 0) {
                   a = parseFloat(a);
                   subtotal += a;
                }
            });
            _.find(this.sections[ 'family_income' ], { name: 'total' }).value = subtotal;
            return 0.00;
        },
        replacementIncomeCalculator() {
            let needed = 0.00;

            let totalFamilyIncome = _.find(this.sections[ 'family_income' ], { name: 'total' }).value;
            let percentIncome = _.find(this.sections[ 'replacement_income' ], { name: 'percent_income' }).value;
            let replacementIncome = totalFamilyIncome * (percentIncome / 100);
            _.find(this.sections[ 'replacement_income' ], { name: 'total_replacement_income' }).value = replacementIncome;

            let yearsIncomeNeeded = _.find(this.sections[ 'replacement_income' ], { name: 'years_income_needed' }).value;
            let rateReturnExpected = _.find(this.sections[ 'replacement_income' ], { name: 'rate_return' }).value;
            let rateInflationExpected = _.find(this.sections[ 'replacement_income' ], { name: 'rate_inflation' }).value;

            let netRateReturnExpected = ( rateReturnExpected - rateInflationExpected );
            _.find(this.sections[ 'replacement_income' ], { name: 'net_rate_return' }).value = netRateReturnExpected;

            needed =  (replacementIncome * yearsIncomeNeeded) - [(replacementIncome * yearsIncomeNeeded) * (netRateReturnExpected / 100)];
            _.find(this.sections[ 'replacement_income' ], { name: 'total' }).value = needed;
            return needed;
        },
        investibleFamilyAssetsCalculator() {
            let subtotal = 0.00;
            this.sections[ 'investible_family_assets' ].forEach( field => {
                let a = this.cleanValuedAmount( field.value );
                if (field.name !== 'total' && a.length > 0) {
                   a = parseFloat(a);
                   subtotal += a;
                }
            });
            _.find(this.sections[ 'investible_family_assets' ], { name: 'total' }).value = subtotal;
            return 0.00;
        },
        debtRepaymentAssetsCalculator() {
            let subtotal = 0.00;
            this.sections[ 'debt_repayment' ].forEach( field => {
                let a = this.cleanValuedAmount( field.value );
                if (field.name !== 'total' && a.length > 0) {
                   a = parseFloat(a);
                   subtotal += a;
                }
            });
            _.find(this.sections[ 'debt_repayment' ], { name: 'total' }).value = subtotal;
            return 0.00;
        },
        collegeFundingCalculator() {
            return _.find(this.sections[ 'college_funding' ], { name: 'total' }).value;
        },
        otherExpensesCalculator() {
            let subtotal = 0.00;
            this.sections[ 'other_expenses' ].forEach( field => {
                let a = this.cleanValuedAmount( field.value );
                if (field.name !== 'total' && a.length > 0) {
                   a = parseFloat(a);
                   subtotal += a;
                }
            });
            _.find(this.sections[ 'other_expenses' ], { name: 'total' }).value = subtotal;
            return 0.00;
        },
        calc() {
            let totalNeeded = 0.00;
            let total = 0.00;
            let family_income = 0.00;
            let other_income = 0.00;
            debugger;
            Object.values(this.calculators.family_income).map( calculator => {
                calculator();
            });

            Object.values(this.calculators.other_income).map( calculator => {
                calculator();
            });

            // family
            let familyGrossIncome = _.find(this.sections[ 'family_income' ], { name: 'total' }).value;

            // replacement income
            let percentIncome = _.find(this.sections[ 'replacement_income' ], { name: 'percent_income' }).value;
            let incomeToBeReplaced =  _.find(this.sections[ 'replacement_income' ], { name: 'total' }).value;
            let rateOfReturn = _.find(this.sections[ 'replacement_income' ], { name: 'rate_return' }).value;
            let inflationRate = _.find(this.sections[ 'replacement_income' ], { name: 'rate_inflation' }).value;
            let yearsIncomeNeeded = _.find(this.sections[ 'replacement_income' ], { name: 'years_income_needed' }).value;

            // investible family assets
            let investibleFamilyAssets = _.find(this.sections[ 'investible_family_assets' ], { name: 'total' }).value;

            // debt repayment
            let debtRepayment =  _.find(this.sections[ 'debt_repayment' ], { name: 'total' }).value;

            // other expenses
            let otherExpenses = _.find(this.sections[ 'other_expenses' ], { name: 'total' }).value;

            let baseNeeded = familyGrossIncome * (parseFloat(percentIncome) / 100);
            // (rateOfReturn, inflationRate, yearsIncomeNeeded)


            debugger;
            let npv = this.netPVR(rateOfReturn, inflationRate, yearsIncomeNeeded);

            if (npv == 1) {
                totalNeeded = baseNeeded * yearsIncomeNeeded;
            }
            else {
                totalNeeded = npv * baseNeeded;
            }

            let collegeFunding = this.cleanValuedAmount(_.find(this.sections[ 'college_funding' ], { name: 'total' }).value);
            collegeFunding = parseFloat(collegeFunding);
            // console.log("collegeFunding", collegeFunding);

            this.total_part_1 = totalNeeded - parseFloat(investibleFamilyAssets);
            this.total_part_2 = parseFloat(debtRepayment) + /*college*/ collegeFunding + parseFloat(otherExpenses);
            this.total_needed = this.total_part_1 + this.total_part_2;
        },

        onFieldChange(field) {
            _.find(this.sections[ this.applicationStates[ this.currentState ] ], { name: field.name }).value = field.value;
            this.calc();
        },
        resetNonSelectedStates(selected) {
            for(var prop in this.sectionStates) {
                if (prop !== selected) {
                    this.sectionStates[ prop ] = false;
                }
            }
        },
        updateTotal() {
            let totals = 0;
            Object.values(this.applicationStates).forEach( section => {
                let total = _.find(this.sections [ section ], { name: 'total' }).value;
                totals += total;
            });

            this.toReplace.totalReplace = NA.fn.formatCurrency(this.family.totalGross * (parseFloat(this.toReplace.percentIncome) / 100), false);
           // let total = _.find(this.sections [ section ], { name: 'total' }).value;

            return totals;
        },
        toggleState( newState ) {
            this.resetNonSelectedStates( newState.value );
            this.currentState = newState.value;
            this.sectionStates[ newState.value ] = ! this.sectionStates[ newState.value ];
            this.currentHeader = this.applicationHeaders[ newState.value ];
            this.previousState = this.getPreviousState( this.currentState );
            this.nextState = this.getNextState( this.currentState );
        },
        getNextState() {
            debugger;
            let keys = Object.keys( this.sectionStates );
            let idIndex = keys.indexOf( this.currentState );
            let nextIndex = idIndex += 1;
            // if we go beyond our states, return current state
            if (nextIndex >= keys.length) {
                return this.currentState;
            }
            let nextKey = keys[ nextIndex ];
            return nextKey;
        },
        getPreviousState() {
            let keys = Object.keys( this.sectionStates );
            let idIndex = keys.indexOf( this.currentState );
            let nextIndex = idIndex -= 1;
            debugger;
            // if we go less than our array states, return current state
            if (nextIndex === -1) {
                return this.currentState;
            }
            let nextKey = keys[ nextIndex ];
            return nextKey;
        },
        quoteFromCalculator() {
            this.$emit('quoteFromCalculator', { value: this.total_part_1 + this.total_part_2 })
        },
        currentSection() {
            return this.sections[ this.applicationStates[ this.currentState ] ];
        },
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return "$" + n;
        },
        formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",", symbol = "$") {
            try {
                decimalCount = Math.abs(decimalCount);
                decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

                const negativeSign = amount < 0 ? "-" : "";

                let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
                let j = (i.length > 3) ? i.length % 3 : 0;

                return symbol + negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
            } catch (e) {
                console.log(e)
            }
        },
        cleanValuedAmount(a) {
			let n = a + "";
			n = n.replace(/\$/g, "");
			n = n.replace(/,/g, "");
			return n;
		},
         isMobile() {
            if(window.location.href.indexOf("userAgent") > -1) {
                console.log("userAgent", navigator.userAgent);
            }

            if(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                return true
            } else {
                return false
            }
        }
    }
}
</script>

<style scoped lang="scss">
</style>

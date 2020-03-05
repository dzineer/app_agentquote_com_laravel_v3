<template>
    <div class="field">  
    <h3 class="field-heading" :class="classes" v-text="header"></h3>

    <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-4 tw-relative">
        <select @change="buildChildren" class="field-input tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-w-px tw-flex-1 tw-border tw-border-grey-light tw-px-3 tw-rtw-elative">
          <option :value="0">0</option> 
          <option :value="1">1</option> 
          <option :value="2">2</option> 
          <option :value="3">3</option> 
          <option :value="4">4</option> 
        </select>
    </div>

    <div :v-show="build" v-for="(child, index) in children" :key="child.key" class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-8 tw-relative">
        <future-college-tuition @ageChange="onAgeChange" @tuitionChange="onTuitionChange" :child="index+1"></future-college-tuition>
    </div>    

    <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-4 tw-relative">
        <amount-field header="Total Tuition" name="total" :value="totalTuition | formatAmount" :readonly="true"></amount-field>
    </div>
    
    </div>
</template>

<script>
import FutureCollegeTuition from './FutureCollegeTuition';
import AmountField from './AmountField';
import _ from 'lodash';

let collegeTuition = {
    public: 25290,
    private: 50900,
    getPublic() { return this.public },
    getPrivate() { return this.private }
};

export default {
    props: [
        'header',
        'classes',
        'name',
        'value'
    ],
    components: {
        FutureCollegeTuition, AmountField
    },
    data() {
        return {
            children_length: 0,
            build: false,
            children: [
            ],
            inflationRate: 6,
            collegeTuition: collegeTuition,
            totalTuition: 0.00
        }
    },
    filters: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n;
        }
    },
    methods: {
        formatAmount(a) {
            let n = a + "";
            n = n.replace(/\$/g, "");
            n = n.replace(/,/g, "");
            n = n.replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return n;
        },        
        onFieldChange(e) {
            let field = { name: e.currentTarget.name, value: e.currentTarget.value };
            this.$emit('fieldChange', field);
        },
		cleanValuedAmount(a) {
			let n = a + "";
			n = n.replace(/\$/g, "");
			n = n.replace(/,/g, "");
			return n;
		},      
        buildChildren(e) {
            if (e.currentTarget.value > 0) {
                this.build = false;
                this.children_length = e.currentTarget.value;
                this.children = [];
                this.children.length = 0;
                for(let i=1; i <= this.children_length; i++) {
                    this.build = true;
                     this.children.push(
                        { name:'child_'+i, age: 0, tuition: 0.00, key: Date.parse(new Date().toString()) + i },
                     );
                }
                this.build = true;
            } else {
                this.build = false;
            }
        },
        calculateCollegeCost(c, iRate, yearsTilCollege) {
            const rate = iRate / 100;
            let realCost = 0.00;
            if (yearsTilCollege > 0) {
                realCost = c * Math.pow((1 + rate), (yearsTilCollege-1));
            }
            else if(yearsTilCollege == 1 || yearsTilCollege == 0) {
                realCost = cost;
            }
            return realCost;
        },
        calc() {
            this.totalTuition = 0.00;

            debugger;
            this.children.forEach(child => {
                let yearsTilCollege = 0;
                let cost = 0.00;
                if (child.age > 0 && child.tuition > 0) {
                    if (child.age < 18) {
                        yearsTilCollege = 18 - child.age;
                    }
                   cost = this.calculateCollegeCost(child.tuition, this.inflationRate, yearsTilCollege);
                   _.find(this.children, { name: child.name }).value = parseFloat(cost);
                   this.totalTuition += parseFloat(cost); 
                }
            });
            this.totalTuition = this.formatAmount( Math.round(this.totalTuition) );
            this.$emit('fieldChange', { name: 'total', value: this.totalTuition });
        },
        onAgeChange(age) {
            this.children[age.child].age = parseInt(age.value);
            this.calc();
        },
        onTuitionChange(tuition) {
            let tuitionType = tuition.value;
            let collegeCost = 0.00;
            debugger;
            if (tuitionType === 'pub') {
                collegeCost = this.collegeTuition.getPublic();
            } else if (tuitionType === 'priv') {
                collegeCost = this.collegeTuition.getPrivate();
            }
            this.children[tuition.child].tuition = collegeCost;
            this.calc();
        }          
    }
}
</script>

<style lang="scss">
  .symbol {
    background-color: #17567F;
    color: white;
  }
</style>
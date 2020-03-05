<template>

    <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-1 tw-relative">

        <div class="tw-flex tw-flex-wrap tw-items-stretch tw-w-full tw-mb-4 tw-relative">
            <h3 class="field-heading" >Child {{ child }}</h3>
        </div>

        <select @change="updateAge" class="field-input tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-w-px tw-flex-1 tw-border tw-text-sm tw-px-3 tw-rtw-elative">
          <option :value="-1" :selected="true">Age</option>
          <option v-for="item in [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18]" :key="item" v-text="item" :value="item"></option> 
        </select>

        <div class="tw-w-4 tw-h-4"></div>

        <select @change="updateTuition" class="field-input tw-flex-shrink tw-flex-grow tw-flex-auto tw-leading-normal tw-w-px tw-flex-1 tw-border tw-text-sm tw-px-3 tw-rtw-elative">
            <option :value="-1" :selected="true">College Type</option>
            <option v-for="item in [{text: 'Public', value:'pub'}, {text: 'Private', value: 'priv'}]" :key="item.value" v-text="item.text" :value="item.value"></option> 
        </select>  


    </div>    

</template>

<script>
export default {
    props: ['child', 'minAge', 'maxAge'],
    filters: {
        lowerCase(t) {
            return t.toLowerCase();
        }
    },
    methods: {
        updateAge(e) {
            if (e.currentTarget.value != -1) {
                this.$emit('ageChange', { child: parseInt(this.child) - 1, value: e.currentTarget.value });
            } 
            else {
                this.$emit('ageChange', { child: parseInt(this.child) - 1, value: 0 });
            }
        },
        updateTuition(e) {
            if (e.currentTarget.value != -1) {
                this.$emit('tuitionChange', { child: parseInt(this.child) - 1, value: e.currentTarget.value });
            } 
            else {
                this.$emit('tuitionChange', { child: parseInt(this.child) - 1, value: 0 });
            }
        }
    }
}
</script>
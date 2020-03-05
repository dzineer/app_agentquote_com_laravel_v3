import Vue from 'vue';

export default Vue.extend({
    props: ['data'], // <collection data=<eloquent collection>>
    data() {
        debugger;
        return {
            items: this.data
        }
    },
    created() {
        console.log(this.items);
        debugger;
    },
    methods: {
        add(item) {
            this.items.push(item);
            this.$emit('added');
        },
        unshift(item) {
            this.items.unshift(item);
            this.updated();
        },
        update() {

        },
        remove(index) {
            // remove item from array
            this.items.splice(index, 1);
            // dispatch / emit the 'removed' custom event
            this.$emit('removed');
        }
    }
})
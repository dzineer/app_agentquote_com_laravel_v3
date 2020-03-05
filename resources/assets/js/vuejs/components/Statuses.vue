<template>
    <div>

        <div class="message" v-for="item in items" v-bind:key="item.id" >
            <status :data="item" v-if="item"></status>
        </div>
        <new-status @completed="unshift"></new-status>

    </div>

</template>

<script>

import Collection from '../collections/Collection';
import Status from "./Status";
import NewStatus from './NewStatus';

export default Collection.extend({
    components: {
        Status,
        NewStatus
    },
    methods: {
        postedOn(status) {
            return moment(status.created_at).fromNow();
        },
        updated() {
            window.scrollTo(0,0);
        }
    },
    mounted() {
        console.log(this.items);
        console.log(this.data);
    }
})
</script>
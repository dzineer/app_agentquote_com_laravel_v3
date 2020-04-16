<template>
    <div v-if="item">
        <div class="message-header">
            <p>
                {{ item.user.name }} said...
            </p>
            <p>
                {{ item.created_at | ago | shout }}
            </p>
        </div>
        <div class="message-body" v-text="item.body">
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
     props: ['data'], // <collection data=<eloquent collection>>
    data() {
        return {
            item: this.data
        }
    },
    filters: {
        ago(date) {
            return moment(date).fromNow();
        },
        shout(str) {
            return str + ' yo!';
        }
    },
    mounted() {
        console.log(this.item);
    },
    methods: {
        getName() {
            // debugger;
        }
    }
}
</script>

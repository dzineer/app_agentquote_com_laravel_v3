<template>
    <div class="progress-bar tw-my-6" :class="classes">
        <h3 class="tw-my-2 tw-text-large tw-font-bold" v-text="heading">
        </h3>
        <div class="tw-flex">
            <div v-for="(item, index) in items" :class="getStateBG(item)" :key="index" class="tw-py-1-more tw-px-0 tw-border-r">
                
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['heading', 'states', 'classes'],
    data() {
        return {
            items: [
                'in-progress',
                'not-completed',
                'not-completed',
            ],
            itemsStatuses: {
                completed: 'tw-bg-primary',
                inProgress: 'tw-bg-primaryLight',
                inCompleted: 'tw-bg-gray-600'
            }
        }
    },
    mounted() {
       this.items = this.states || this.items;
       this.itemsStatuses = this.statuses || this.itemsStatuses;
    },
    methods: {
        getStateBG(state) {
            
            switch(state) {
                
                case 'completed': 
                    return this.itemsStatuses.completed + ' tw-w-1/' + this.items.length;
                case 'in-progress': 
                    return this.itemsStatuses.inProgress + ' tw-w-1/' + this.items.length;
                case 'not-completed': 
                    return this.itemsStatuses.inCompleted + ' tw-w-1/' + this.items.length;                    
            }
        }
    }
}
</script>
<template>
    <div>
       <accordian-item v-for="(item, index) in items" :item="item" :key="index" :is-open="activeItemIndex == index" @toggled="onToggle"></accordian-item>
    </div>    
</template>

<script>
import AccordianItem from './AccordianItem';

export default {
		props: ['items'],
		components: {
      AccordianItem
		},
    data() {
        return {
						activeItemIndex: null
        }
		},
		methods: {
			onToggle(index) {
				if (this.activeItemIndex == index) {
					return (this.activeItemIndex = null)
				}
         this.activeItemIndex = index;
			}
		}
}
</script>

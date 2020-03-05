<template>
     <div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-text-left tw-ml-3">
        <a v-for="item in menuItems" class="tw-text-white tw-mt-3 tw-mx-4 tw-px-4 tw-pb-2 dz:menu-item tw-mx-auto" :key="item.key" :class="isActive(item)"
            :href="item.href"
            :target="item.target" v-text="item.text">
        </a>
    </div>
</template>

<script>
   export default {
       props: ['items'],
       data() {
           return {
               menuItems: []
           }
       },
       mounted() {

           this.menuItems = this.items.map( item => {
               return { active: item.active, text: item.text, href: item.link, key: item.link, target: '_blank'}
           });
           
       },
       methods: {
           isActive(item) {
               return item.active ? 'is-active' : '';
           }
       }
   }
</script>
<template>
     <div class="tw-flex tw-flex-row tw-justify-center tw-items-center tw-text-left tw-ml-3">
        <a v-for="socialMedia in socialMediaIcons" class="tw-mr-8 tw-text-primaryLight" :class="socialMedia.className"
            :href="socialMedia.href"
            :aria-label="socialMedia.label"
            :target="socialMedia.target">
        </a>
    </div>
</template>

<script>
   export default {
       props: ['icons'],
       data() {
           return {
               socialMediaIcons: []
           }
       },
       mounted() {
           debugger;

           console.log(this.icons);

           this.socialMediaIcons = this.icons.map( socialMedia => {
               return {
                   className:  "icon " + socialMedia.icon + " icon-default",
                   label: socialMedia.name,
                   href: socialMedia.link, target: '_blank'}
           });

           console.log(this.socialMediaIcons);

       }
   }
</script>

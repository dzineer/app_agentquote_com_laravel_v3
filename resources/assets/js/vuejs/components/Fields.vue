<template>
     <div v-if="show" class="fields tw-py-4 tw-px-2">  
         <slot></slot>
     </div>    
</template>

<script>
export default {
    props: [
        'show'
    ]
}
</script>
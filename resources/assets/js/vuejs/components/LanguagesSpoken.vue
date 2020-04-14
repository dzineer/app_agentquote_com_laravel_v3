<template>
    <p>
        <span v-for="(language, index) in languages" :key="language" class="tw-mr-1">{{ formatLanguage(language, index) }}</span>
    </p>
</template>

<script>
    export default {
        props: [
            'languages'
        ],
        methods: {
            formatLanguage(language, index) {
              debugger;
              if (index < this.languages.length) {
                  return language + ", ";
              }
              else {
                  return language;
              }
            }
        },

    }
</script>

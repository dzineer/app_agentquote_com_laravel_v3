<template>
    <p class="tw-inline">
        <span v-for="(language, index) in languages" :key="language" class="tw-mr-1">{{ formatLanguage(language, index+1) }}</span>
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

              // English and
              if (this.languages.length === 2 && index === 1) {
                  return language + " and ";
              }
              // English and Thai
              else if (this.languages.length === 2 && index === 2) {
                  return language + ".";
              }
              // English, Thai, and
              else if (index+1 === this.languages.length && this.languages.length >= 3) {
                  return language + ", and ";
              }
              // English, Thai,
              else if (index < this.languages.length) {
                  return language + ", ";
              }
              else {
                  return language + ".";
              }
            }
        },

    }
</script>

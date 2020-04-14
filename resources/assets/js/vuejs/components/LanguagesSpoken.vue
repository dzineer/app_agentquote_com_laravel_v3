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

              // English and
              if (this.languages.length === 2 && index === 0) {
                  return language + " and ";
              }
              // English and Thai
              else if (this.languages.length === 2 && index === 1) {
                  return language;
              }
              // English, Thai, and Korean
              else if (index <= this.languages.length && index+1 === this.languages.length) {
                  return language + ", and ";
              }
              else {
                  return language;
              }
            }
        },

    }
</script>

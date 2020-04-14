<template>
    <p>
        <span v-for="(language, index) in languages" class="tw-mr-1">{{ language | formatLanguage(language, index) }}</span>
    </p>
</template>

<script>
    export default {
        props: [
            'languages'
        ],
        filters: {
            formatLanguage(language, index) {
              if (index < this.languages.length) {
                  return language + ", ";
              }
              else {
                  return language;
              }
            }
        }
    }
</script>

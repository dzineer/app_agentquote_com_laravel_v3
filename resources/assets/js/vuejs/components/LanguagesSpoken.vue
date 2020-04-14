<template>
    <p>
        <span v-for="(language, index) in languages" class="tw-mr-1">{{ language | ffaa(language, index) }}</span>
    </p>
</template>

<script>
    export default {
        props: [
            'languages'
        ],
        filters: {
            ffaa(language, index) {
                debugger;
                return language;
            },
            formatLanguage(language, index, languages) {
              if (index < languages.length) {
                  return language + ", ";
              }
              else {
                  return language;
              }
            }
        }
    }
</script>

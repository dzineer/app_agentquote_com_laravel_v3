<template>
    <p>
        <span v-for="(language, index) in languages" class="tw-mr-1">{{ language | format(language, index) }}</span>
    </p>
</template>

<script>
    export default {
        props: [
            'languages'
        ],
        filters: {
            format(language, index) {
              if (index < this.props.languages.length) {
                  return language + ", ";
              }
              else {
                  return language;
              }
            }
        }
    }
</script>

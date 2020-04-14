<template>
    <p>
        <span v-for="(language, index) in languages" v-text="this.format(language, index)" class="tw-mr-1"></span>
    </p>
</template>

<script>
    export default {
        props: [
            'languages'
        ],
        methods: {
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

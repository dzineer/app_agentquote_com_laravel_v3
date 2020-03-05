<template>
    <span v-text="count"></span>
</template>

<script>
import inViewport from 'in-viewport';

export default {
    props: ['to'],
    data() {
        return {
            count: 0,
            interval: null
        }
    },
    mounted() {
        inViewport(this.$el, () => {
            this.interval = setInterval(this.tick, 40);
        });

    },
    computed: {
        increment() {
            return Math.ceil(this.to / 20);
        }
    },
    methods: {
        tick() {
            if (this.count + this.increment >= this.to) {
                this.count = this.to;
                return clearInterval( this.interval );
            }

            if (this.count < this.to) {
                return this.count += this.increment;
            }

            clearInterval( this.interval );
        }
    }
}
</script>
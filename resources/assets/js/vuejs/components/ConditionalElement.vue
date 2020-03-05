<template>
    <transition name="fade">
        <div v-show="isVisible">
            <slot></slot>
        </div>
    </transition>
</template>

<script>
import inViewport from 'in-viewport';

export default {
    props: ['whenHidden'],
    data() {
        return {
            isVisible: false,
            interval: null
        }
    },
    mounted() {
        window.addEventListener('scroll', this.checkDisplay, { passive: true });
    },
    methods: {
        checkDisplay() {
            this.isVisible = ! inViewport(
                document.querySelector( this.whenHidden )
            );
        }
    }
}
</script>

<style>
    .add-button {
        position: fixed;
        bottom: 40px;
        right: 40px;    
    }

    .fade-enter-active, .fade-leave-active {
        transition: opacity 0.3s;
    }

    .fade-enter, .fade-leave-to {
        opacity: 0;
    }
</style>
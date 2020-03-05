<template>
    <div class="na-main-section tw-w-full tw-bg-black" :class="classes">
        <h2 class="tw-text-xl tw-text-white tw-font-semibold tw-uppercase tw-py-2">
            <slot></slot>
        </h2>
    </div>
</template>

<script>
export default {
    props: ['classes']
}
</script>
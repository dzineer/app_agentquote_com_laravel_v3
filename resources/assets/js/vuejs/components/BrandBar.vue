<template>
<div class="tw-w-full tw-flex tw-justify-center tw-items-center tw-mt-12">
    <div class="dz:section tw-py-4 tw-border-b tw-flex tw-flex-row tw-items-center tw-justify-start tw-text-white tw-w-full" style="min-height: 45px;">
        <div class="tw-flex tw-w-full tw-items-between tw-justify-start">

            <div class="tw-flex">
                <slot name="left"></slot>
            </div>


            <div class="tw-flex">
                <slot name="right"></slot>
            </div>

        </div>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<template>
    <div>
        <div class="tw-flex tw-bg-blue-400" style="min-height: 160px;">
            <div class="container tw-flex tw-justify-center tw-items-end tw-mb-6">
                <div class="tw-flex tw-center-align tw-justify-center">
<!--                     <ul class="tw-flex tw-w-full tw-justify-center">
                        <li v-for="item in menu" v-bind:key="item" class="tw-px-12">
                            <a href="" v-text="item" @click.prevent="active = !active" class="tw-uppercase tw-text-sm tw-font-bold tw-text-white"></a>
                        </li>
                    </ul> -->
                    <ul class="tw-flex tw-w-full tw-justify-center">
                        <li class="tw-px-12">
                            <catalog-dropdown :activated="menuActive" @closing="menuActive = false"></catalog-dropdown>
                        </li>
                        <li class="tw-px-12">
                            <series-dropdown :activated="menuActive" @closing="menuActive = false"></series-dropdown>
                        </li>
                        <li class="tw-px-12">
                            <podcasts-dropdown :activated="menuActive" @closing="menuActive = false"></podcasts-dropdown>
                        </li>
                        <li class="tw-px-12">
                            <discussions-dropdown :activated="menuActive" @closing="menuActive = false"></discussions-dropdown>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
        <portal-target name="nav-after" multiple></portal-target>

<!--         <div v-if="active" class="tw-flex tw-w-full tw-bg-red-500 tw-shadow tw-absolute tw-z-50" style="min-height:200px">
            <div class="tw-container tw-mx-auto tw-flex tw-p-6">
                <div class="tw-w-1/5 tw-p-4 tw-flex tw-flex-col tw-justify-center">
                    <ul class="">
                        <li class="tw-p-2">
                            <a href="#" class="tw-font-bold">Reaching</a>
                        </li>                            
                        <li class="tw-p-2">
                            <a href="#" class="tw-font-bold">Beginnings</a>
                        </li>                            
                        <li class="tw-p-2">
                            <a href="#" class="tw-font-bold">Reaching further</a>
                        </li>                            
                        <li class="tw-p-2">
                            <a href="#" class="tw-font-bold">Help</a>
                        </li>                            
                        
                    </ul>
                </div>
                <div class="tw-w-4/5 tw-p-4 tw-flex">
                    <div class="container tw-flex tw-justify-between columns">
                        <div class="column">
                            <ul>
                                <li class="tw-p-2">We reach futher with our courses.</li>
                                <li class="tw-p-2">And here we go</li>
                                <li class="tw-p-2">Did that go well ?</li>
                            </ul>
                        </div>
                        <div class="column">
                            <ul>
                                <li class="tw-p-2">Ready for new beginnings?</li>
                                <li class="tw-p-2">ready ready ready...?</li>
                                <li class="tw-p-2">Okay, then go for IT!</li>
                            </ul>
                        </div>
                        <div class="column">
                            <ul>
                                <li class="tw-p-2">Reach for the moon... and then some!</li>
                                <li class="tw-p-2">Reach for the moon... and!</li>
                                <li class="tw-p-2">Some!</li>
                                <li class="tw-p-2">Got Some!</li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div> -->
    </div>
</template>

<script>
 
 import CatalogDropdown from './CatalogDropdown';
 import SeriesDropdown from './SeriesDropdown';
 import PodcastsDropdown from './PodcastsDropdown';
 import DiscussionsDropdown from './DiscussionsDropdown';

export default {
    components: {
        CatalogDropdown, SeriesDropdown, PodcastsDropdown, DiscussionsDropdown
    },
    data() {
        return {
            menu: ['catalog', 'series', 'podcasts', 'discussions'],
            menuActive: false
        }
    },
    created() {
            
    },
    methods: {

    }
}
</script>

<style>

</style>
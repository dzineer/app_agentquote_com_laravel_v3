<template>
    <div>
        <a href="" class="tw-uppercase tw-text-sm tw-font-bold tw-text-white"  @mouseover="showMenuItem" @click.prevent="active = !active" >catalog</a>
        
        <portal to="nav-after">
            <div v-show="active" class="tw-flex tw-w-full tw-bg-white tw-shadow-lg tw-absolute tw-z-10" style="min-height:200px" @mouseover="showMenuItem" @mouseout="active = false">
                <div class="tw-container tw-mx-auto tw-flex tw-p-6">
                    <div class="tw-w-1/5 tw-p-4 tw-flex tw-flex-col tw-justify-center">
                        <ul class=" tw-border-r-2 tw-border-gray-300 tw-w-48">
                            <li class="tw-p-2" v-for="item in items" v-bind:key="item" @mouseover="selectedItem = item">
                                <a href="#" class="tw-font-bold tw-uppercase hover:tw-text-blue-400" v-text="item"></a>
                            </li>                            
                        </ul>
                    </div>
                    <div class="tw-w-4/5 tw-p-4 tw-flex">
                        <div class="container tw-flex tw-justify-between columns">
                            <div class="tw-flex tw-flex-wrap">

                                <a href="" v-for="item in itemDetails[selectedItem]" v-bind:key="item" v-text="item" class="tw-w-1/3 tw-p-2 tw-text-sm hover:tw-text-blue-400"></a>

                                <!-- <div class="column">
                                    <ul>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">We reach futher with our courses.</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">And here we go</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Did that go well ?</li>
                                    </ul>
                                </div>
                                <div class="column">
                                    <ul>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Ready for new beginnings?</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">ready ready ready...?</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Okay, then go for IT!</li>
                                    </ul>
                                </div>
                                <div class="column">
                                    <ul>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Reach for the moon... and then some!</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Reach for the moon... and!</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Some!</li>
                                        <li class="tw-p-2 tw-text-sm hover:tw-text-blue-400">Got Some!</li>
                                    </ul>
                                </div> -->

                            </div>
                            

                        </div>
                    </div>
                </div>
            </div>

        </portal>
        

    </div>
        
</template>

<script>
import _ from 'lodash';
import DZFake from '../DZFaker';

export default {
    data() {
        return {
            active: false,
            selectedItem: 'Reaching',
            items: ['Reaching', 'Beginnings', 'Further', 'Help'],
            itemDetails: {
                'Reaching': [
                    'We reach futher with our courses.',
                    'And here we go',
                    'Did that go well ?',
                    'Ready for new beginnings?',
                    'ready ready ready...?',
                    'Okay, then go for IT!',
                    'Reach for the moon... and then some!',
                    'Reach for the moon... and!',
                    'Some!',
                    'Got Some!',
                ], 
                'Beginnings': [
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(3),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(2),
                    DZFake.wordList(4)
                ], 
                'Further': [
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(3),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(2),
                    DZFake.wordList(4)
                ], 
                'Help': [
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(3),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(4),
                    DZFake.wordList(2),
                    DZFake.wordList(4)
                ]
            }
        }
    },
    methods: {
        showMenuItem: _.debounce(function() { 
            this.active = true }, 100)
    }
}
</script>
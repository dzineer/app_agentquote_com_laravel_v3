<template>
    <div class="container">

        <div class="columns">
            <div class="column">
                <menu-list :items="['one', 'two', 'three', 'four']">
                    <template slot="george" slot-scope="props">
                       <div>
                            <h2> {{ props.index }}  - {{ props.data }}</h2>
                       </div>
                    </template>
<!--                     <template slot-scope="props">
                       <div>
                            <h2> {{ props.index }}  - {{ props.data }}</h2>
                       </div>
                    </template>
                    <hr>
                    <template slot-scope="{ index, data }">
                       <div>
                            <h2>@ {{ index }}  - {{ data }}</h2>
                       </div>
                    </template> -->
                </menu-list>
            </div>
        </div>

        <div class="columns">
            <div class="column">
                <statuses :data="items" v-if="items"></statuses>
            </div>
        </div>
    </div>
</template>

<script>

import StatusRequest from '../requests/StatusRequest';
import Statuses from '../components/Statuses';
import moment from 'moment';

import MenuList from '../components/MenuList';

export default {
    components: {
        MenuList,
        Statuses
    },
    data() {
        return {
            items: null
        }
    },
    mounted() {
        // fire off ajax request
        debugger;
        StatusRequest.all( 
            data => {
                debugger;
                console.log(data);
                this.items = data;
            },
            errors => {
                debugger;
                console.log(errors);
            }
        );
    }
}
</script>
<template>
    <div class="flex-row">
        <statistics-navbar @set-sub-component="setSubComponent"></statistics-navbar>
        <component @set-sub-component="setSubComponent" :is="currentComponent"></component>
    </div>
</template>

<script>

import StatisticsNavbar from "../layouts/StatisticsNavbar.vue";
import Tours from "../UI/StatisticsTours.vue";
import Stations from "../UI/StatisticsStations.vue";

export default {
    components: {
        StatisticsNavbar,
        Tours,
        Stations,
    },
    data() {
        return {
            currentComponent: "summary",
        }
    },
    emits: ['set-component'],
    methods:{
        setSubComponent(component) {
            this.currentComponent = component;
        }
    }

}
</script>

<template>
    <div class="flex flex-col lg:w-5/6 w-full">
        <statistics-navbar @set-sub-component="setSubComponent"></statistics-navbar>
        <component @set-sub-component="setSubComponent" :is="currentComponent"></component>
    </div>
</template>

<script>

import StatisticsNavbar from "../layouts/StatisticsNavbar.vue";
import StatisticsTours from "../UI/StatisticsTours.vue";
import StatisticsStations from "../UI/StatisticsStations.vue";

export default {
    components: {
        StatisticsNavbar,
        StatisticsTours,
        StatisticsStations,
    },
    data() {
        return {
            currentComponent: "statistics-stations",
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

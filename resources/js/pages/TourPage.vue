<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <all-stations-tour></all-stations-tour>
        <the-tour-window></the-tour-window>
        <div class="w-full sm:w-1/3 lg:w-1/2 h-96 sm:h-[calc(100vh-76px)] relative">
            <the-map ref="TheMap"></the-map>
        </div>
    </section>
</template>

<script>
import AllStationsTour from "../components/layouts/AllStationsTour.vue";
import TheTourWindow from "../components/layouts/TheTourWindow.vue";
import TheMap from "../components/layouts/TheMap.vue";

export default {
    name: "TourPage",
    components: {
        AllStationsTour,
        TheTourWindow,
        TheMap,
    },

    mounted() {
        this.changeMapStatus();
    },

    methods: {
        changeMapStatus() {
            this.$refs.TheMap.isFetched(true);
        },

        getStationMarker(stationTitle) {
            this.stationMarker = stationTitle;
        },
    },
}
</script>


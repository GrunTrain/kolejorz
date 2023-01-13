<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <all-stations-tour :marker="stationMarker" @send-name="setName"></all-stations-tour>
        <the-tour-window :stationName="stationName"></the-tour-window>
        <div class="w-full sm:w-1/3 lg:w-1/2 h-96 sm:h-[calc(100vh-76px)] relative">
            <the-map ref="TheMap" @set-station-marker="getStationMarker"></the-map>
        </div>
    </section>
</template>

<script>
import AllStationsTour from "../components/layouts/AllStationsTour.vue";
import TheTourWindow from "../components/layouts/TheTourWindow.vue";
import TheMap from "../components/layouts/TheMap.vue";
import stationsData from "@/stations.json";

export default {
    components: {
        AllStationsTour,
        TheTourWindow,
        TheMap,
    },

    data() {
        return {
            stationName: '',
            stationMarker: ''
        }
    },

    mounted() {
        this.changeMapStatus();
    },


    methods: {
        setName(name) {
            this.stationName = name;
        },

        changeMapStatus() {
            this.$refs.TheMap.isFetched(true);
        },

        getStationMarker(stationTitle) {
            this.stationMarker = stationTitle;
        },
    },

    provide() {
        return {
            stations: stationsData,
        }
    },

}
</script>


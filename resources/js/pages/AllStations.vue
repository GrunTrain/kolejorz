<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <all-stations-list :marker="stationMarker"></all-stations-list>
        <div class="sm:w-1/2 lg:w-2/3 h-96 sm:h-[calc(100vh-76px)] relative">
            <the-map ref="TheMap" @set-station-marker="getStationMarker"></the-map>
        </div>
    </section>
</template>

<script>
import AllStationsList from "../components/layouts/AllStationsList.vue";
import stationsData from "@/stations.json";

export default {
    components: {
        AllStationsList
    },

    data() {
        return {
            stationMarker: ''
        }
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

    provide() {
        return {
            stations: stationsData,
        }
    },
}

</script>


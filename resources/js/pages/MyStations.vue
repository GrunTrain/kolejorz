<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <my-stations-list :marker="stationMarker"></my-stations-list>
        <div class="sm:w-1/2 lg:w-2/3 h-96 sm:h-[calc(100vh-76px)] relative">
            <the-map ref="TheMap" @set-station-marker="getStationMarker"></the-map>
        </div>
    </section>
</template>

<script>
import MyStationsList from "../components/layouts/MyStationsList.vue";
import TheMap from "../components/layouts/TheMap.vue";
import axios from "axios"

export default {
    components: {
        MyStationsList,
        TheMap
    },

    data() {
        return {
            stationsData: [],
            stationMarker: ''
        }
    },

    methods: {
        getStationMarker(stationTitle) {
            this.stationMarker = stationTitle;
        },
        getStations() {
            axios.get('/api/user_stations/id')
                .then(response => {
                    response.data.data.forEach(station => {
                        this.stationsData.push(station)
                    })
                    this.$refs.TheMap.isFetched(true);
                })
                .catch(error => {
                    console.log(error)
            })
        }
    },

    mounted() {
        this.getStations();
    },

    provide() {
        return {
            stations: this.stationsData
        }
    }
}
</script>


<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <div class="sidebar bg-gradient-to-t from-gray-600 to-gray-700 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
            <div
                v-for="tour in tours" :key="tour.id"
                class="bg-gray-800 m-2 rounded-lg text-white font-semibold p-3">

                <div class="flex items-center">
                    <p class="text-gray-200">{{ tour.date }}</p>
                </div>
                <div class="border-b my-2 border-gray-300"></div>

                <div class="flex items-center">
                    <img class="rounded hover:bg-gray-600 py-2 px-1 pr-2" src="https://img.icons8.com/ios/20/FFFFFF/home--v1.png"/>
                    <p class="text-[#14b8a6]">{{stations[tour.start_station-1].name}}</p>
                </div>

                <div
                    v-for="tour_station in tour.middle" :key="tour_station.id"
                    class="flex items-center">
                    <img class="rounded hover:bg-gray-600 py-2 px-1 pr-2" src="https://img.icons8.com/ios/20/FFFFFF/final-state--v1.png"/>
                    <p class="text-[#ffbf00]">{{stations[tour_station.station_id-1].name}}</p>
                </div>

                <div class="flex items-center">
                    <img class="rounded hover:bg-gray-600 py-2 px-1 pr-2" src="https://img.icons8.com/ios/20/FFFFFF/finish-flag--v1.png"/>
                    <p class="text-[#14b8a6]">{{stations[tour.destination_station-1].name}}</p>
                </div>
            </div>
        </div>
        <div class="sm:w-1/2 lg:w-2/3 h-96 sm:h-[calc(100vh-76px)] relative">
            <the-map ref="TheMap" @set-station-marker="getStationMarker"></the-map>
        </div>
    </section>
</template>

<script>

import TheMap from "../components/layouts/TheMap.vue";
import axios from "axios";

export default {
    components: {
      TheMap
    },
    data() {
        return {
            tours: [],
            stations: [],
            stationsData: [],
        }
    },
    methods: {

        getStationMarker(stationTitle) {
            this.stationMarker = stationTitle;
        },
        getTours() {
            axios.get('/api/profile/active').then(response => {
                axios.get('/api/tours/'+response.data.data.id).then(response => {
                    this.tours = response.data.data
                    this.tours.forEach(tour => {
                        axios.get('/api/tour_station/'+tour.id).then((response) => {
                            tour.middle = response.data.data
                        })
                    });
                })
            });
        },
        getStations(){
            axios.get('/api/stations').then(response => {
                this.stations = response.data.data
            });
        },

        getMyStations() {
            axios.get('/api/user_stations/id')
                .then(response => {
                    response.data.data.forEach(station => {
                        this.stationsData.push(station)
                        this.$refs.TheMap.isFetched(true);
                    })
                })
                .catch(error => {
                    console.log(error)
                })
        }
    },
    mounted() {
        this.getStations();
        this.getTours();
        this.getMyStations();
    },

    provide() {
        return {
            stations: this.stationsData
        }
    }
}
</script>

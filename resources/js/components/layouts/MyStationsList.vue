<template>
    <div class="sidebar bg-gradient-to-t from-gray-600 to-gray-700 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
        <the-search-window>
            <input v-model.trim="searchInput" type="text" placeholder="Szukaj stacji" class="rounded-lg bg-gray-600 w-full py-2 mr-2 px-2">
            <button class="px-1" @click="clearInput">
                <img src="https://img.icons8.com/ios-filled/20/d3d3d3/delete-sign--v1.png"/>
            </button>
        </the-search-window>
        <span v-for="station in filteredStations.reverse()" :key="station.idStr">
            <my-station-dashboard :station="station"></my-station-dashboard>
        </span>
    </div>
</template>

<script>
import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import MyStationDashboard from "@/components/UI/MyStationDashboard.vue";

export default {
    inject: ['stations'],
    props: ['marker'],

    components: {
        TheSearchWindow,
        MyStationDashboard
    },

    data() {
        return {
            searchInput: '',
        }
    },

    methods: {
        clearInput() {
            this.searchInput = '';
        },
    },

    computed: {
        filteredStations() {
            return this.stations.filter(station => {
                return station.name.toLowerCase().includes(this.searchInput.toLowerCase())
            })
        },
    },

    watch: {
        marker() {
            this.searchInput = '' + this.marker
        }
    },
}
</script>

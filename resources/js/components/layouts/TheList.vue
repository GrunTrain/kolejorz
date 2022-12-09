<template>
    <div class="sidebar bg-gray-600 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
    <the-search-window>
        <input v-model="searchInput" type="text" placeholder="Szukaj stacji" class="rounded-lg bg-gray-600 w-full py-2 mr-2 px-2">
    </the-search-window>
        <span v-for="station in filteredStations" :key="station.id">
            <base-card :station="station"></base-card>
        </span>
    </div>
</template>

<script>
import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import BaseCard from "@/components/UI/BaseCard.vue";

export default {
    inject: ['stations'],
    props: ['marker'],

    components: {
        TheSearchWindow,
        BaseCard,
    },

    data() {
        return {
            searchInput: '',
        }
    },

    computed: {
        filteredStations() {
            return this.stations.filter(station => {
                return station.title.toLowerCase().includes(this.searchInput.toLowerCase())
            })
        },
    },

    watch: {
        marker() {
            this.searchInput = '' + this.marker
        }
    }
}
</script>

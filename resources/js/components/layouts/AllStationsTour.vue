<template>
    <div class="sidebar bg-gradient-to-t from-gray-600 to-gray-700 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
        <the-search-window>
            <input v-model.trim="searchInput" type="text" placeholder="Szukaj stacji" class="rounded-lg bg-gray-600 w-11/12 py-2 mr-2 px-2">
            <button class="px-1" @click="clearInput">
                <img src="https://img.icons8.com/ios-filled/20/d3d3d3/delete-sign--v1.png"/>
            </button>
        </the-search-window>

        <span v-for="station in filteredStations">
            <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
                <div class="flex flex-col space-y-2 break-words">
                    <p class="font-semibold lg:text-xl">
                        {{ station.title }}
                    </p>
                </div>
                <div class="flex items-center justify-end sm:space-x-0">
                    <button title="Dodaj do przejechanych">
                        <img class="rounded hover:bg-gray-600 py-3 px-2"
                             src="https://img.icons8.com/ios-filled/20/FFFFFF/plus--v1.png"/>
                    </button>
                </div>
            </div>
        </span>
    </div>
</template>

<script>
import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import stations from "@/stations.json";

export default {
    components: {
        TheSearchWindow
    },
    data() {
        return {
            searchInput: '',
        }
    },

    methods: {
        clearInput() {
            this.searchInput = '';
        }
    },

    computed: {
        filteredStations() {
            return stations.filter(station => {
                return station.title.toLowerCase().includes(this.searchInput.toLowerCase());
            })
        },
    },
}
</script>


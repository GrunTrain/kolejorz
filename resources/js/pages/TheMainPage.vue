<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <div class="sidebar bg-gray-600 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
            <the-search-window></the-search-window>
            <base-card #title v-for="station in stations">
                {{ station.title }}
            </base-card>
        </div>
        <div class="sm:w-1/2 lg:w-2/3 h-96 sm:h-[calc(100vh-76px)]">
            <the-map></the-map>
        </div>
    </section>
</template>

<script>

import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import stationsData from "@/stations.json";

export default {
    components: {
        TheSearchWindow,
    },

    data() {
        return {
            stations: stationsData
        }
    },

    provide() {
        return {
            stations: stationsData
        }
    }
}
</script>


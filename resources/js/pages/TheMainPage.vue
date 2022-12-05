<template>
    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto sm:h-[calc(100vh-76px)]">
        <the-list></the-list>
        <div class="sm:w-1/2 lg:w-2/3 h-96 sm:h-[calc(100vh-76px)]">
            <the-map></the-map>
        </div>
    </section>
</template>

<script>
import TheList from "../components/layouts/TheList.vue";
import stationsData from "@/stations.json";

export default {
    components: {
        TheList,
    },

    data() {
        return {
            stations: stationsData,
        }
    },

    provide() {
        return {
            stations: stationsData,
        }
    },
}
</script>


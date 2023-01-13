<template>
    <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
            <p class="font-semibold lg:text-xl">
                {{ station.name }}
            </p>
            <div v-if="station.timesVisited">
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#14b8a6]">odwiedzona ({{station.timesVisited}})</p>
                </div>
            </div>
            <div v-if="station.timesPassed">
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#ffbf00]">odwiedzona ({{ station.timesPassed }})</p>
                </div>
            </div>
            <div class="flex flex-row justify-end">
                <button @click="deleteStation(station.station_id)" class="flex w-fit mt-2 px-4 p-1 rounded bg-gray-600 hover:bg-red-900">
                    Usuń
                    <img class="flex ml-2 mt-1" src="https://img.icons8.com/ios/15/FFFFFF/delete--v1.png"/>
                </button>

            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['station'],

    methods: {
        deleteStation(id) {
            axios.delete('/api/stations/' + id).then(() => {
                location.reload();
            })
        }
    }
}
</script>

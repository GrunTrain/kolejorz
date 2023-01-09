<template>
    <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
            <p class="font-semibold lg:text-xl">
                {{ station.title }}
            </p>
            <div v-if="station.status === 'przejechana'">
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#ffbf00]">{{station.status}}</p>
                    <button @click="deleteStation(station.id, station.status)" class="flex justify-start w-fit mt-2 px-4 p-1 rounded bg-gray-600 hover:bg-red-900">
                        Usuń
                        <img class="flex ml-2 mt-1" src="https://img.icons8.com/ios/15/FFFFFF/delete--v1.png"/>
                    </button>
                </div>
            </div>
            <div v-else>
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#14b8a6]">{{station.status}}</p>
                    <button @click="deleteStation(station.id, station.status)" class="flex justify-start w-fit mt-2 px-4 p-1 rounded bg-gray-600 hover:bg-red-900">
                        Usuń
                        <img class="flex ml-2 mt-1" src="https://img.icons8.com/ios/15/FFFFFF/delete--v1.png"/>
                    </button>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: ['station'],

    methods: {
        deleteStation(id, status) {
            axios.delete('/api/stations/' + id, {
                data: {
                    status: status
                }
            }).then(() => {
                location.reload();
            })
        }
    }
}
</script>

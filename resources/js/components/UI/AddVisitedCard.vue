<template>
    <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-green-600 to-green-400 rounded-lg text-white space-y-2">
        <div class="flex flex-col space-y-2">
            <p class="font-semibold text-gray-900">Dodać stację do odwiedzonych?</p>
            <p class="font-semibold text-lg">
                {{ station.name }}
            </p>
        </div>

        <div class="flex items-center justify-end space-x-3">
            <button
                @click="insertStation"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg font-semibold shadow-inner shadow-2xl">
                Dodaj
            </button>
            <button
                @click="$emit('set-component', 'all-station-dashboard')"
                class="px-1 font-semibold hover:text-green-100">
                Wstecz
            </button>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    props: ['station'],
    emits: ['set-component', 'pass-alert'],

    data() {
        return {
            stationData: {
                station_id: this.station.idStr,
                name: this.station.title,
                lat: this.station.lat,
                lon: this.station.lon,
                status: 1
            },
            alert: ''
        }
    },

    methods: {
        insertStation() {
            axios.post('/api/user_stations', this.stationData)
                .then(response => {
                    this.alert = response.data.alert;
                    this.$emit('pass-alert', this.alert);
                    this.$emit('set-component', 'all-station-dashboard');
                })
        }
    }
}
</script>


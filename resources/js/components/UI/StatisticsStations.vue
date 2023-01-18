<template>
    <div class="flex justify-center items-center lg:justify-start lg:items-start flex-col p-6 space-y-2">
        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-gray-800 to-slate-800 text-lg font-semibold text-white">
            <p class="mr-1">Ulubiona stacja - </p>
            <p class="text-teal-400 font-bold">{{favourite_station}}</p>
        </div>

        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-gray-800 to-slate-800 text-lg font-semibold text-white">
            <p class="mr-1">Ilość wizyt na ulubionej stacji - </p>
            <p class="text-teal-400 font-bold">{{favourite_station_records}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-yellow-800 to-yellow-600 text-lg font-semibold text-white">
            <p class="mr-1">Ilość stacji przejechanych - </p>
            <p class="text-yellow-500 font-bold">{{stations_passed}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-yellow-800 to-yellow-600 text-lg font-semibold text-white">
            <p class="mr-1">Ilość przejazdów łącznie - </p>
            <p class="text-yellow-500 font-bold">{{total_passes}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-green-900 to-green-600 text-lg font-semibold text-white">
            <p class="mr-1">Ilość stacji odwiedzonych - </p>
            <p class="text-green-300 font-bold">{{stations_visited}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gradient-to-r from-green-900 to-green-600 text-lg font-semibold text-white">
            <p class="mr-1">Ilość wizyt łącznie - </p>
            <p class="text-green-300 font-bold">{{total_visits}}</p>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            favourite_station: 0,
            favourite_station_records: 0,
            stations_passed: 0,
            stations_visited: 0,
            total_passes: 0,
            total_visits: 0,
            }
    },

    mounted() {
        axios.get("/api/user_stations").then((response) =>
        {
            this.favourite_station = response.data['favourite_station'];
            this.favourite_station_records = response.data['favourite_station_records'];
            this.stations_passed = response.data['stations_passed'];
            this.stations_visited = response.data['stations_visited'];
            this.total_passes = response.data['total_passes'];
            this.total_visits = response.data['total_visits'];
        })
    },
}
</script>

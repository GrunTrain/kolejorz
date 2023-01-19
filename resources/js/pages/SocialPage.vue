<template>



    <div class="flex justify-center" v-for="tour in this.tours" :key="tour.id">

            <div class="w-4/5 md:w-2/3 lg:w-3/5 m-5 p-6 bg-gray-800 justify-center rounded-lg">
                <div class="text-xl text-white text-left">{{ users[tour.user_id].name }}</div>
                <div class="mt-2 text-xs border-b border-[#b2f5ea] text-white"></div>

                <div class="bg-gray-800 pt-2 shadow text-m text-white font-small">
                    <p class="font-semibold">{{ tour.data }}</p>
                    <p class="mt-4">{{ tour.description }}</p>

                    <div class="text-sm font-semibold mt-4">
                        <p class="text-green-400">{{this.stations[tour.start_station].name}}</p>
                        <span v-for="station in tour.stations" :key="station_id">
                            <p class="text-yellow-400">{{this.stations[station.id].name}}</p>
                        </span>
                        <p class="text-green-400">{{this.stations[tour.destination_station].name}}</p>
                    </div>
                </div>

                <div class="mt-5 text-xs border-b py-1 border-[#b2f5ea] text-white"></div>
                <div class="bg-gray-800 p-1 rounded-b-lg shadow flex flex-row flex-wrap">
                </div>
            </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tours: [],   
            users: [], 
            stations: [], 
            }
    },
    mounted() {
        axios.get("/api/profile").then((response) =>
        {
            response.data.data.forEach(user => {
                this.users[user.id] = user
            });
                axios.get("/api/stations").then((response) =>
                {
                    response.data.data.forEach(station => {
                        this.stations[station.id] = station
                    });
                })
            axios.get('/api/tours/friends').then(response => {
                this.tours = response.data.data
                this.tours.forEach(tour => {
                    axios.get('/api/tour_station/'+tour.id).then((response) => {
                        tour.stations = response.data.data
                    })
                });
            })
        })
    },
}
</script>


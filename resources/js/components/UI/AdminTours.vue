<template>
    <div class="flex-row">
           id user start end length<br>
    <span v-for="tour in this.tours" :key="tours.id">
            {{tour.id}} {{this.users[tour.user_id-1]["name"]}} {{this.stations[tour.start_station-1]["name"]}} {{this.stations[tour.destination_station-1]["name"]}} {{tour.length}} <base-button @click="deleteTour(tour.id)">Usuń</base-button><br>
        </span>
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
            this.users = response.data.data
        })
        axios.get("/api/stations").then((response) =>
        {
            this.stations = response.data.data
        })
        axios.get("/api/tours").then((response) =>
                {
                    this.tours = response.data.data
                })
    },

    methods:{
        deleteTour(id){
            axios.delete("api/tours/"+id).then((response) =>{
                axios.get("/api/profile").then((response) =>
                {
                    this.users = response.data.data
                })
                axios.get("/api/stations").then((response) =>
                {
                    this.stations = response.data.data
                })
                axios.get("/api/tours").then((response) =>
                {
                    this.tours = response.data.data
                })
            })
        }
    },
}
</script>

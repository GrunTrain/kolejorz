<template>
    <div class="flex-row">
           <div>
            <input v-model="this.id" type="text" placeholder="id">
            <input v-model="this.user" type="text" placeholder="user">
            <input v-model="this.start" type="text" placeholder="start">
            <input v-model="this.end" type="text" placeholder="end">
            <input v-model="this.length" type="text" placeholder="length">
           </div>
    <span v-for="tour in filteredTours" :key="tours.id">
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
            id: '',
            user: '',
            start: '',
            end: '',
            length: '',
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
    computed:{
        filteredTours(){
            return this.tours.filter((tour) => {
                console.log(tour)
                return tour.id.toString().includes(this.id) &&
                       tour.length.toString().includes(this.length) &&
                       this.stations[tour.start_station-1].name.toLowerCase().includes(this.start) &&
                       this.users[tour.user_id-1].name.toLowerCase().includes(this.user) &&
                       this.stations[tour.destination_station-1].name.toLowerCase().includes(this.end)
            })
        }
    },
}
</script>

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
            <p v-if="tour.id != this.edited.id">{{tour.id}} {{this.users[tour.user_id]["name"]}} {{this.stations[tour.start_station]["name"]}} {{this.stations[tour.destination_station]["name"]}} {{tour.length}}<base-button @click="setEdited(tour.id)">Edytuj</base-button></p>
            <p v-if="tour.id == this.edited.id">{{tour.id}} <input v-model="this.edited.user"> <input v-model="this.edited.start"> <input v-model="this.edited.destination"> {{tour.length}}<base-button @click="saveEdited()">Zapisz</base-button></p> 
            <base-button @click="deleteTour(tour.id)">Usuń</base-button>
            <br>
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
            edited: {
                id: 0,
                user: 0,
                start: 0,
                destination: 0,
            }
        }
    },

    mounted() {
        axios.get("/api/profile").then((response) =>
        {
            response.data.data.forEach(user => {
                this.users[user.id] = user
            });
        })
        axios.get("/api/stations").then((response) =>
        {
            response.data.data.forEach(station => {
                this.stations[station.id] = station
            });
        })
        this.getTours()
    },

    methods:{
        getTours(){    
            axios.get("/api/tours").then((response) =>
            {
                this.tours = response.data.data
            })
        },
        deleteTour(id){
            axios.delete("api/tours/"+id).then((response) =>{
                axios.get("/api/profile").then((response) =>
                {
                    response.data.data.forEach(user => {
                        this.users[user.id] = user
                    });
                })
                axios.get("/api/stations").then((response) =>
                {
                    response.data.data.forEach(station => {
                        this.stations[station.id] = station
                    });
                })
                axios.get("/api/tours").then((response) =>
                {
                    response.data.data.forEach(tour => {
                        this.tours[tour.id] = tour
                    });
                })
            })
        },
        setEdited(id){
            this.edited.id = id
            this.edited.user = this.tours[id].user_id
            this.edited.start = this.tours[id].start_station
            this.edited.destination = this.tours[id].destination_station
        },
        saveEdited(){
            this.edited.id = 0
            axios.post("api/tours/admin", this.edited).then(response => {
                this.getTours()
            })
        }
    },
    computed:{
        filteredTours(){
            return this.tours.filter((tour) => {

                return tour.id.toString().includes(this.id) &&
                       tour.length.toString().includes(this.length) &&
                       this.stations[tour.start_station].name.toLowerCase().includes(this.start) &&
                       this.users[tour.user_id].name.toLowerCase().includes(this.user) &&
                       this.stations[tour.destination_station].name.toLowerCase().includes(this.end)
            })
        }
    },
}
</script>

<template>
    {{tours}}
    <hr><hr>
    {{stations}}
</template>

<script>
export default {

    data() {
        return {
            tours: [],
            stations: [],
        }
    },

    methods: {
        getTours() {
            axios.get('/api/profile/active').then(response => {
                axios.get('/api/tours/'+response.data.data.id).then(response => {
                    this.tours = response.data.data
                    this.tours.forEach(tour => {
                        axios.get('/api/tour_station/'+tour.id).then((response) => {
                            tour.stations = response.data.data
                        })
                    });
                })

            })
        },
        getStations(){
            axios.get('/api/stations').then(response => {
                this.stations = response.data.data
            })
        }
    },

    mounted() {
        this.getStations();
        this.getTours();
    }
}
</script>


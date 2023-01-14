<template>
    <div class="flex-row">
    <p>favourite_station: {{favourite_station}}</p>
    <p>favourite_station_records: {{favourite_station_records}}</p>
    <p>stations_passed: {{stations_passed}}</p>
    <p>stations_visited: {{stations_visited}}</p>
    <p>total_passes: {{total_passes}}</p>
    <p>total_visits: {{total_visits}}</p>
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

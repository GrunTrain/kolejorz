<template>
    <div class="flex-row">
    <p>tours_amount: {{tours_amount}}</p>
    <p>tour_shortest: {{tour_shortest}}</p>
    <p>tour_longest: {{tour_longest}}</p>
    <p>tour_mean: {{tour_mean}}</p>
    <p>tour_public: {{tour_public}}</p>
    </div>
</template>

<script>

export default {
    data() {
        return {
            tours_amount: 0,
            tour_shortest: 0,
            tour_longest: 0,
            tour_mean: 0,
            tour_public: 0,
            }
    },

    mounted() {
        axios.get("/api/tours").then((response) =>
        {
            this.tours_amount = response.data['user_tours'];
            this.tour_shortest = response.data['len_min'];
            this.tour_longest = response.data['len_max'];
            this.tour_mean = response.data['len_mean'];
            this.tour_public = response.data['public_tours'];
        })
    },
}
</script>

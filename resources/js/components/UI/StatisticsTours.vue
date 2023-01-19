<template>
    <div class="flex justify-center items-center lg:justify-start lg:items-start flex-col p-6 space-y-2">
        <div class="flex w-full rounded-xl p-6 bg-gray-800 text-lg font-semibold text-white">
            <p class="mr-1">Ilość wycieczek - </p>
            <p class="text-teal-400 font-bold">{{tours_amount}}</p>
        </div>

        <div class="flex w-full rounded-xl p-6 bg-gray-800 text-lg font-semibold text-white">
            <p class="mr-1">Ilość stacji w najkrótszej wycieczce - </p>
            <p class="text-teal-400 font-bold">{{tour_shortest}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gray-800 text-lg font-semibold text-white">
            <p class="mr-1">Ilość stacji w najdłuższej wycieczce - </p>
            <p class="text-teal-400 font-bold">{{tour_longest}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gray-800 text-lg font-semibold text-white">
            <p class="mr-1">Średnia liczba stacji w wycieczce - </p>
            <p class="text-teal-400 font-bold">{{tour_mean}}</p>
        </div>
        <div class="flex w-full rounded-xl p-6 bg-gray-800 text-lg font-semibold text-white">
            <p class="mr-1">Opublikowane wycieczki - </p>
            <p class="text-teal-400 font-bold">{{tour_public}}</p>
        </div>
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
        axios.get("/api/tours/statistics").then((response) =>
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

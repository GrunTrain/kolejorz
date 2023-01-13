<template>
    <div class="overflow-auto scrollbar sidebar w-full sm:w-1/2 lg:w-1/3 flex-col bg-gray-800 text-white h-full">
        <div class="flex w-full justify-center">
            <div class="flex flex-col sm:py-8 py-4 w-4/5">
                <p class="text-teal-200">Stacja początkowa:</p>
                <input v-model="tour.start" type="search" class="font-semibold text-red-900 rounded-lg py-2 px-2 my-2 w-full">
            </div>
        </div>

        <div class="flex w-full justify-center">
            <div class="flex flex-col space-y-2 w-4/5">
                <p class="text-teal-200">Przez:</p>
                <div v-for="(station, index) in tour.middle" :key="index" class="flex justify-end">
                    <input v-model="station.name" type="search"  class="font-semibold text-red-900 rounded-lg my-1 px-2 py-2 w-full">
                    <button  @click="remove(index)" class="flex items-center" title="Usuń stację">
                        <img class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/delete--v1.png"/>
                    </button>
                </div>
                <div class="flex justify-center">
                    <base-button @click="addStation" class="flex justify-center bg-teal-400 hover:bg-teal-500 w-full">Dodaj stację</base-button>
                </div>

                <div class="flex flex-col justify-center pt-4">
                    <p class="text-teal-200 py-2">Stacja końcowa:</p>
                    <input v-model="tour.end" type="search" class="font-semibold text-red-900 rounded-lg px-2 py-2 w-full">

                    <p class="text-teal-200 py-2">Data:</p>
                    <input v-model="tour.date" type="search" class="font-semibold text-red-900 rounded-lg pl-2 px-2 py-2 w-full">

                    <p class="text-teal-200 py-2">Opis:</p>
                    <textarea class="font-semibold text-red-900 rounded-lg pl-2 py-8 w-full"></textarea>
                </div>

                <div class="flex justify-center">
                    <base-button @click="addStation" class="flex justify-center bg-teal-400 hover:bg-teal-500 mb-8 w-full">Opublikuj wycieczkę</base-button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>

export default {
    name: "TheTourWindow",

    data(){
        return{
            tour: {
                start: '',
                middle: [],
                end: '',
                date: null,
            },
        }
    },
    components: {},
    methods: {
        addTour() {
            axios.post('/api/add-tour', this.tour).then(() => {
                this.$router.push({ name: "my-stations" });
            }).catch((error) => {
                this.errors = error.response.data.errors
            })
        },
        addStation(){
            this.tour.middle.push({name: ''})
        },
        remove(index){
            this.tour.middle.splice(index, 1)
        },
    }
}
</script>

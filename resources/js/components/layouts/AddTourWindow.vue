<template>
    <div class="mb-4 px-3 pb-4 pt-2 bg-gray-800 text-white justify-between h-full">

        <div class="flex flex-row">
            <div class="flex flex-col space-y-1 w-9/12">
                <p class="text-teal-200">Stacja początkowa:</p>
                <input v-model="tour.start" class="font-semibold text-red-900">
            </div>
            <button class="flex justify-end items-center mt-6 w-3/12" title="Usuń stację">
            </button>
        </div>
                <p class="text-teal-200">Przez:</p>
        <div v-for="(station, index) in tour.middle" :key="index" class="flex flex-row">
            <div class="flex flex-col space-y-1 my-2 w-9/12">
                <input v-model="station.name" class="font-semibold text-red-900">
                <button  @click="remove(index)" class="flex justify-end items-center mt-6 w-3/12" title="Usuń stację">
                    <img class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/delete--v1.png"/>
                </button>
            </div>

        </div>
            <base-button @click="addStation" class="bg-teal-400 hover:bg-teal-500 w-2/3 lg:w-7/12">Dodaj stację</base-button>
        <div class="flex flex-row">
            <div class="flex flex-col space-y-1 my-2 w-9/12">
                <p class="text-teal-200">Stacja końcowa:</p>
                <input v-model="tour.end" class="font-semibold text-red-900">
            </div>
            <button class="flex justify-end items-center mt-6 w-3/12" title="Usuń stację">
            </button>
        </div>
        <div class="flex flex-row">
            <div class="flex flex-col space-y-1 my-2 w-9/12">
                <input v-model="tour.date" type="date" class="font-semibold text-red-900">
            </div>
        </div>

        <div class="flex flex-wrap flex-col items-center">
            <base-button @click="addTour" class="bg-teal-400 hover:bg-teal-500 w-2/3 lg:w-7/12">Dodaj wycieczkę</base-button>
            <base-button class="bg-teal-600 hover:bg-teal-700 w-2/3 lg:w-7/12">Opublikuj wycieczkę</base-button>
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
                console.log(this.tour.date)
            axios.post('/api/add_tour', this.tour).then(() => {
                this.$router.push({ name: "all-stations" });
            }).catch((error) =>{
                this.errors = error.response.data.errors
            })
            },
            addStation(){
                this.tour.middle.push({name: ''})
            },
            remove(index){
                console.log("siemano")
                this.tour.middle.splice(index, 1)
            },
        }
}
</script>

<style scoped>

</style>

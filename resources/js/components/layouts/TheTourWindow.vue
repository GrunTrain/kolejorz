<template>
    <div class="overflow-auto scrollbar sidebar w-full sm:w-1/2 lg:w-1/3 flex-col bg-gray-800 text-white h-full">
        <div class="flex w-full justify-center">
            <div class="flex flex-col sm:py-8 py-4 w-4/5">
                <h1 class="font-semibold text-xl mb-2">Dodawanie wycieczki</h1>
                <p v-if="middle.length < 1" class="flex text-teal-200 pt-2">
                    Kliknij
                    <img class="px-2" src="https://img.icons8.com/ios-filled/25/FFFFFF/plus--v1.png"/>
                    aby dodać stację
                </p>

                <div v-if="middle.length < 1" class="text-xs border-b my-4 border-[#b2f5ea] text-white"></div>

                <div class="flex flex-col">
                    <div
                        v-for="(station, index) in middle" :key="index"
                        :class="(index === 0 || index === middle.length - 1) ? 'border-2 border-green-600' : 'border border-yellow-500'"
                        class="flex flex-col text-white rounded-lg my-2 p-2">

                        <div
                            :class="(index === 0 || index === middle.length - 1) ? 'text-green-600 font-bold' : 'text-yellow-500 font-semibold'"
                             class="flex items-center">

                            <img v-if="index === 0" class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/home--v1.png"/>
                            <img v-if="(index === middle.length - 1 && middle.length > 1)" class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/finish-flag--v1.png"/>
                            <img v-if="(index !== 0 && index !== middle.length - 1)" class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/final-state--v1.png"/>
                            {{ station }}
                        </div>

                        <div class="flex justify-end">
                            <button @click="removeStation(index)" class="items-center" title="Usuń stację">
                                <img class="rounded hover:bg-gray-600 py-2 px-1" src="https://img.icons8.com/ios/20/FFFFFF/delete--v1.png"/>
                            </button>
                        </div>

                    </div>
                </div>

                <p class="font-semibold py-2">Data:</p>
                <input v-model="date" type="date" class="font-semibold text-red-900 rounded-lg pl-2 px-2 py-2 w-full">
                <span v-if="error" class="break-words" style="color: red">{{ error }}</span>

                <div class="flex items-center py-2">
                    <input
                        v-model="agreement"
                        type="checkbox" class="w-4 h-4 text-teal-600 bg-gray-100 border-gray-300 rounded focus:ring-teal-500 dark:focus:ring-teal-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                    <label class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Czy chcesz dodać post?</label>
                </div>

                <p v-if="agreement" class="font-semibold py-2">Opis:</p>
                <textarea v-if="agreement" v-model="description" class="font-semibold text-red-900 rounded-lg pl-2 pt-2 pb-8 w-full"></textarea>

                <base-button v-if="middle.length > 1" @click="addTour" class="bg-teal-500 hover:bg-teal-600">
                    <p v-if="agreement">
                        Dodaj wycieczkę i post
                    </p>
                    <p v-else>
                        Dodaj wycieczkę
                    </p>
                </base-button>

                <alert-pop-up v-if="alert">
                    {{ alert }}
                </alert-pop-up>

            </div>
        </div>

    </div>
</template>

<script>
import AlertPopUp from "@/components/UI/AlertPopUp.vue"

export default {
    components: {
        AlertPopUp
    },

    props: ['stationName'],

    data(){
        return{
            middle: [],
            date: '',
            description: '',

            agreement: false,
            error: '',
            alert: '',
        }
    },

    watch: {
      stationName() {
          this.middle.push(this.stationName);
      }
    },

    methods: {
        addTour() {
            if (this.date !== '') {
                this.insertStation();
            } else {
                this.error = 'Nie podano daty!';
            }
        },

        insertStation() {
            axios.post('/api/tours', {
                data: {
                    start: this.middle[0],
                    end: this.middle[this.middle.length - 1],
                    middle: this.middle.slice(1, -1),
                    date: this.date,
                    description: this.description,
                }
            }).then((response) => {
                this.middle = [];
                this.date = '';
                this.description = '';
                this.error = '';
                this.showAlert(response.data.alert);
            }).catch((error) => {
                this.error = error.response.data.errors
            })
        },

        removeStation(index) {
            this.middle.splice(index, 1)
        },

        showAlert(alert) {
            this.alert = alert;
            setTimeout(this.hideAlert, 2000);
        },

        hideAlert() {
            this.alert = '';
        }
    }
}
</script>

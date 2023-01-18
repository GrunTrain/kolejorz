<template>
    <div class="w-full lg:w-5/6 p-5 h-3/4 lg:pl-60 flex justify-center lg:block">
        <div class="w-full sm:w-2/3 lg:w-2/3 xl:w-1/2 p-4 bg-gray-800 rounded-lg shadow-md p-8">
            <form @submit.prevent class="space-y-6">
                <h1 class="text-xl font-medium text-white justify-center">Zmiana nazwy</h1>
                <div>
                    <label class="block mb-2 text-sm font-medium text-white">Stara nazwa</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" v-model="userData.name" readonly>
                </div>

                <div>
                    <label class="block mb-2 text-sm font-medium text-white">Nowa nazwa</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5" v-model.trim="name" required>
                </div>

                <div class="bottom-0 flex justify-start w-fit">
                    <button type="submit" @click="changeName" class="top-10 w-full text-white bg-yellow-600 hover:bg-yellow-500 font-semibold rounded-lg text-sm px-5 py-3 text-center">Zmień nazwę</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    computed: {
        ...mapGetters('auth', {
            userData: 'getUserData',
        }),
    },

    emits: ['set-component'],

    data() {
        return {
            name: '',
        }
    },

    methods: {
        changeName() {
            axios.put('/api/profile/id', {
                data: {
                    name: this.name
                }
            });
            this.$emit('set-component', 'change-password');
            this.$flashMessage.show({
                type: 'info',
                time: 2000,
                text: "Nazwa została zmieniona!",
                image: 'https://img.icons8.com/ios/50/1087c2/steam-engine.png',
            });

            location.reload();
        }
    }
}
</script>

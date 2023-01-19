<template>
    <section class="bg-gradient-to-t from-gray-600 to-gray-700 flex items-center justify-center py-6">

        <div class="bg-gray-800 flex flex-col rounded-2xl shadow-lg items-center px-8 py-6 w-2/3 md:w-2/3 lg:w-1/3">

            <div class="flex flex-col justify-center w-full md:w-3/4">
                <h2 class="font-bold text-2xl text-white text-[] pb-7 ">Login</h2>

                <form @submit.prevent="login" class="flex flex-col gap-4">

                    <input class="p-2 rounded-xl border" type="email" name="email" placeholder="Email" v-model.trim="loginForm.email">
                    <span v-if="errors.email" class="break-words" style="color: red">{{ errors.email[0] }}</span>

                    <div class="relative">
                        <input class="p-2 rounded-xl border w-full" type="password" name="password" autocomplete="on" placeholder="Hasło" v-model.trim="loginForm.password">
                    </div>
                    <span v-if="errors.password" class="break-words" style="color: red">{{ errors.password[0] }}</span>

                    <button type="submit" class="bg-yellow-600 rounded-xl text-white py-2 hover:scale-105 duration-300">Zaloguj się</button>
                </form>

                <div class="mt-6 grid grid-cols-3 items-center text-gray-400">
                    <hr class="border-[#b2f5ea]">
                    <p class="text-center text-sm text-[#b2f5ea]">LUB</p>
                    <hr class="border-[#b2f5ea]">
                </div>

                <a href="/api/login/github">
                    <button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-start items-center text-sm hover:scale-105 duration-300 text-[#002D74]">
                        <img src="https://img.icons8.com/ios-glyphs/30/null/github.png" class="mr-3"/>
                        Kontynuuj przez GitHub
                    </button>
                </a>


                <div class="mt-5 text-xs border-b py-1 border-[#b2f5ea] text-white"></div>

                <div class="mt-3 text-xs flex justify-between items-center text-white">
                    <router-link to="/register">Nie masz konta?</router-link>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    data(){
        return{
            loginForm: {
                email: '',
                password: '',
            },
            errors: {}
        }
    },

    computed: {
        ...mapGetters('auth', {
            getStatus: 'getStatus'
        }),

        ...mapActions('auth', {
            setAuth: 'setAuth',
        }),
    },

    methods:{
        async login() {

            await axios.get('/sanctum/csrf-cookie');

            await axios.post('/api/login', this.loginForm).then(() => {
                this.$router.push({ name: "all-stations" });
                this.$flashMessage.show({
                    type: 'info',
                    time: 3000,
                    title: "Zalogowano",
                    image: 'https://img.icons8.com/ios/50/1087c2/steam-engine.png',
                });
            }).catch((error) =>{
                this.errors = error.response.data.errors
            })

            await axios.get('/api/user')
                .then(response => {
                    if (response.data) {
                        this.setAuth;
                    }
                }).catch(() => {});
        },
    }
}
</script>

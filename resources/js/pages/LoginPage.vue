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

                <button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-start items-center text-sm hover:scale-105 duration-300 text-[#002D74]">
                    <svg class="ml-1 mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
                    </svg>
                    Kontynuuj przez Google
                </button>

                <button class="bg-white border py-2 w-full rounded-xl mt-5 justify-start items-center flex align-self:center text-sm hover:scale-105 duration-300 text-[#002D74]">

                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="ml-1 bi bi-facebook mr-3" viewBox="0 0 16 16">
                        <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
                    </svg>
                    Kontynuuj przez Facebooka
                </button>

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
            setUnauth: 'setUnauth'
        }),
    },

    methods:{
        async login() {

            await axios.get('/sanctum/csrf-cookie');

            await axios.post('/api/login', this.loginForm).then(() => {
                this.$router.push({ name: "all-stations" });
            }).catch((error) =>{
                this.errors = error.response.data.errors
            })

            await axios.get('/api/user')
                .then(response => {
                    if (response.data) {
                        this.setAuth;
                    }
                }).catch(() => {
                this.setUnauth;
            });
        },
    }
}
</script>

<template>
    <nav class="static w-full flex items-center justify-between flex-wrap bg-gray-800 px-8">
        <div class="flex items-center text-white mr-6 pt-4 pb-5">
            <router-link to="/" class="flex">
                <img
                    src="https://img.icons8.com/ios/50/88E8D9/steam-engine.png"
                    onmouseover="src='https://img.icons8.com/ios/50/FFFFFF/steam-engine.png'"
                    onmouseout="src='https://img.icons8.com/ios/50/88E8D9/steam-engine.png'"
                    width="40"
                    alt="Kolejorz"
                />
                <span class="flex items-center ml-2 font-bold text-3xl">Kolejorz</span>
            </router-link>
        </div>
        <div class="block lg:hidden">
            <button
                @click="dropMenu"
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div
            :class="menuIsDropped ? 'block' : 'hidden'"
            class="w-full flex-grow lg:flex lg:items-center lg:w-auto lg:border-0 border-t-2 border-teal-200 pb-2 lg:pb-0">
            <div class="lg:flex-grow">
                <router-link to="/" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Wszystkie stacje
                </router-link>
                <router-link v-if="isAuth" to="/my-stations" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Moje stacje
                </router-link>
                <a href="#" v-if="isAuth" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Moje wycieczki
                </a>
                <router-link v-if="isAuth" to="/add-tour" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Dodaj wycieczkę
                </router-link>
            </div>

            <a href="#" v-if="isAuth" @click="logout">
            <div class="mr-4">
                <div class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:px-2 py-2 lg:border rounded lg:bg-white text-white lg:text-black lg:border-white lg:hover:bg-gray-300 mt-8 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                    <img
                        class="lg:hidden inline-block mr-2"
                        src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/login-rounded-right--v1.png"
                    />
                    <span class="flex items-center">Wyloguj się</span>
                </div>
            </div>
            </a>

            <div>
                <router-link v-if="!isAuth" to="/login" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:px-2 py-2 lg:border rounded lg:bg-white text-white lg:text-black lg:border-white lg:hover:bg-gray-300 mt-8 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                    <img
                        class="lg:hidden inline-block mr-2"
                        src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/login-rounded-right--v1.png"
                    />
                    <span class="flex items-center">Zaloguj się</span>
                </router-link>
            </div>
            <div>
                <router-link v-if="!isAuth" to="/register" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:ml-4 lg:px-2 py-2 lg:border rounded text-white lg:border-white lg:hover:bg-gray-600 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                    <img
                        class="lg:hidden inline-block mr-2"
                        src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/add-user-male.png"
                    />
                    <span class="flex items-center">Dołącz do nas</span>
                </router-link>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            menuIsDropped: false
        }
    },

    computed: {
        ...mapGetters('auth', {
            isAuth: 'getStatus'
        }),

        ...mapActions('auth', {
            setUnauth: 'setUnauth'
        }),
    },

    methods: {
        dropMenu() {
            this.menuIsDropped = !this.menuIsDropped;
        },

        logout() {
            axios.post('/api/logout')
            .then(() => {
                this.$router.push({ name: "login-page" })
                this.setUnauth
            }).catch((error) => console.log(error))
        },
    }
}
</script>

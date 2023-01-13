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
                @click="dropMainMenu"
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div
            :class="mainMenuIsDropped ? 'block' : 'hidden'"
            class="w-full flex-grow lg:flex lg:items-center lg:w-auto lg:border-0 border-t-2 border-teal-200 pb-2 lg:pb-0">
            <div class="lg:flex-grow">
                <router-link to="/" @click="dropMainMenu" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Wszystkie stacje
                </router-link>
                <router-link v-if="isAuth" to="/my-stations" @click="dropMainMenu" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Moje stacje
                </router-link>
                <router-link to="#" v-if="isAuth" @click="dropMainMenu" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Moje wycieczki
                </router-link>

                <router-link v-if="isAuth" to="/tour" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                    Dodaj wycieczkę
                </router-link>

            </div>

            <div v-if="isAuth" class="mt-7 mb-3 lg:pr-20 lg:mt-0 lg:mb-0">
                <button
                    @click="dropUserMenu"
                    class="flex items-center text-sm font-medium text-white hover:text-gray-300 rounded-full" type="button">
                    <img class="mr-2 rounded-full" src="https://img.icons8.com/external-kiranshastry-lineal-kiranshastry/35/88E8D9/external-user-interface-kiranshastry-lineal-kiranshastry.png"/>
                    {{ user.name }}
                    <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

                <div
                    :class="userMenuIsDropped ? 'block' : 'hidden'"
                    class="z-10 absolute bg-gray-700 divide-y divide-gray-100 rounded-lg shadow w-44 divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="truncate">{{ user.email }}</div>
                    </div>
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200">
                        <li>
                            <router-link to="profile" @click="dropBothMenu" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edycja profilu</router-link>
                        </li>
                        <li>
                            <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Statystyki</a>
                        </li>
                    </ul>
                    <div class="py-1 hover:cursor-pointer">
                        <a @click="dropMenuAndLogout" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Wyloguj się</a>
                    </div>
                </div>
            </div>


            <router-link v-if="!isAuth" to="/login" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:px-2 py-2 lg:border rounded lg:bg-white text-white lg:text-black lg:border-white lg:hover:bg-gray-300 mt-8 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                <img
                    class="lg:hidden inline-block mr-2"
                    src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/login-rounded-right--v1.png"
                />
                <span class="flex items-center">Zaloguj się</span>
            </router-link>

            <router-link v-if="!isAuth" to="/register" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:ml-4 lg:px-2 py-2 lg:border rounded text-white lg:border-white lg:hover:bg-gray-600 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                <img
                    class="lg:hidden inline-block mr-2"
                    src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/add-user-male.png"
                />
                <span class="flex items-center">Dołącz do nas</span>
            </router-link>


        </div>
    </nav>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
    data() {
        return {
            mainMenuIsDropped: false,
            userMenuIsDropped: false,
            userName: 'Gall Anonim'
        }
    },

    computed: {
        ...mapGetters('auth', {
            isAuth: 'getStatus',
            user: 'getUserData'
        }),

        ...mapActions('auth', {
            setUnauth: 'setUnauth'
        }),
    },

    methods: {
        dropMainMenu() {
            this.mainMenuIsDropped = !this.mainMenuIsDropped;
        },

        dropUserMenu() {
            this.userMenuIsDropped = !this.userMenuIsDropped;
        },

        dropBothMenu() {
            this.userMenuIsDropped = !this.userMenuIsDropped;
            if (this.mainMenuIsDropped) {
                this.dropMainMenu();
            }
        },

        logout() {
            axios.post('/api/logout')
            .then(() => {
                this.setUnauth
            }).catch((error) => console.log(error)).finally(() => {
                location.reload()
            })
        },

        dropMenuAndLogout() {

            this.dropUserMenu();
            if (this.mainMenuIsDropped) {
                this.dropMainMenu();
            }
            this.logout();
            this.$router.push({name: 'login-page'})
        }
    }
}
</script>

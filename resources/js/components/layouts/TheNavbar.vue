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
        <div class="block xl:hidden">
            <button
                @click="dropMainMenu"
                class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
            </button>
        </div>
        <div
            :class="mainMenuIsDropped ? 'block' : 'hidden'"
            class="w-full flex-grow xl:flex xl:items-center xl:w-auto xl:border-0 border-t-2 border-teal-200 pb-2 xl:pb-0">
            <div class="xl:flex-grow">
                <router-link to="/" @click="dropMainMenu" class="block mt-6 xl:inline-block xl:mt-0 text-teal-200 xl:ml-12 font-semibold hover:text-teal-100">
                    Wszystkie stacje
                </router-link>
                <router-link v-if="isAuth" :to="{name: 'my-stations'}" @click="dropMainMenu" class="block mt-6 xl:inline-block xl:mt-0 text-teal-200 xl:ml-12 font-semibold hover:text-teal-100">
                    Moje stacje
                </router-link>
                <router-link v-if="isAuth" :to="{name: 'my-tours'}" @click="dropMainMenu" class="block mt-6 xl:inline-block xl:mt-0 text-teal-200 xl:ml-12 font-semibold hover:text-teal-100">
                    Moje wycieczki
                </router-link>
                <router-link v-if="isAuth" :to="{name: 'tour-page'}" @click="dropMainMenu" class="block mt-6 xl:inline-block xl:mt-0 text-teal-200 xl:ml-12 font-semibold hover:text-teal-100">
                    Dodaj wycieczkę
                </router-link>
                <router-link v-if="isAuth" :to="{name: 'social-page'}" @click="dropMainMenu" class="block mt-6 xl:inline-block xl:mt-0 text-teal-200 xl:ml-12 font-semibold hover:text-teal-100">
                    Tablica
                </router-link>

            </div>

            <div v-if="isAuth" class="mt-7 mb-3 xl:pr-20 xl:mt-0 xl:mb-0">
                <button
                    @click="dropUserMenu"
                    class="flex items-center text-sm font-medium text-white hover:text-gray-300 rounded-full" type="button">
                    <img class="mr-2 rounded-full w-12" :src="'https://source.boringavatars.com/beam/48/' + user.name + '?colors=72BCA5,F4DDB4,F1AE2B,BC0B27,1BBECD'" alt="Zdjęcie profilowe">
                    {{ user.name }}
                    <svg class="w-4 h-4 mx-1.5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>

                <div
                    :class="userMenuIsDropped ? 'block' : 'hidden'"
                    class="z-10 absolute bg-gray-700 divide-y divide-gray-100 rounded-lg shadow w-44 divide-gray-600">
                    <div class="px-4 py-3 text-sm text-white">
                        <div class="truncate">{{ user.email }}</div>
                    </div>
                    <ul class="py-1 text-sm text-white">
                        <li>
                            <router-link :to="{ name: 'profile' }" @click="dropBothMenu" class="block px-4 py-2 hover:bg-gray-600 text-white">Profil</router-link>
                        </li>
                        <li>
                            <router-link :to="{ name: 'friends' }" @click="dropBothMenu" class="block px-4 py-2 hover:bg-gray-600 hover:text-white">Obserwowani</router-link>
                        </li>
                        <li v-if="this.user.isAdmin">
                            <router-link :to="{ name: 'admin' }" @click="dropBothMenu" class="block px-4 py-2 hover:bg-gray-600 text-white">Admin Panel</router-link>
                        </li>
                    </ul>
                    <div class="py-1 hover:cursor-pointer">
                        <a @click="dropMenuAndLogout" class="block px-4 py-2 text-sm hover:bg-gray-600 text-white">Wyloguj się</a>
                    </div>
                </div>
            </div>


            <router-link v-if="!isAuth" :to="{ name: 'login-page' }"  class="inline-block flex justify-left xl:justify-center xl:w-28 text-sm xl:px-2 py-2 xl:border rounded xl:bg-white text-white xl:text-black xl:border-white xl:hover:bg-gray-300 mt-8 xl:mt-0 hover:font-semibold xl:hover:font-normal">
                <img
                    class="xl:hidden inline-block mr-2"
                    src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/login-rounded-right--v1.png"
                />
                <span class="flex items-center">Zaloguj się</span>
            </router-link>

            <router-link v-if="!isAuth" :to="{ name: 'register-page' }" class="inline-block flex justify-left xl:justify-center xl:w-28 text-sm xl:ml-4 xl:px-2 py-2 xl:border rounded text-white xl:border-white xl:hover:bg-gray-600 xl:mt-0 hover:font-semibold xl:hover:font-normal">
                <img
                    class="xl:hidden inline-block mr-2"
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
            this.$router.push({name: 'login-page'});
            this.$flashMessage.show({
                type: 'info',
                time: 3000,
                title: "Wylogowano",
                image: 'https://img.icons8.com/ios/50/1087c2/steam-engine.png',
            });

        }
    }
}
</script>

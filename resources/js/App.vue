<template>
    <the-navbar></the-navbar>
    <router-view></router-view>
</template>

<script>
import TheNavbar from "./components/layouts/TheNavbar.vue";

import { mapGetters, mapActions } from 'vuex';

export default {
    components: {
      TheNavbar,
    },

    computed: {
        ...mapGetters('auth', {
            getStatus: 'getStatus',
            user: 'getUserData'
        }),

        ...mapActions('auth', {
            setAuth: 'setAuth',
        }),
    },


    mounted() {
        this.setAuth;
    },

}
</script>

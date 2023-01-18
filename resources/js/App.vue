<template>
    <the-navbar></the-navbar>
    <router-view></router-view>
    <FlashMessage position="right bottom" strategy="multiple" class="absolute z-20"/>

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

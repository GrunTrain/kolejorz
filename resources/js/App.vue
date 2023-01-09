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
            getStatus: 'getStatus'
        }),

        ...mapActions('auth', {
            setAuth: 'setAuth',
            setUnauth: 'setUnauth'
        }),
    },

    methods: {
        async getUser() {
            await axios.get('/api/user')
                .then(response => {
                    if (response.data) {
                        this.setAuth;
                    }
                }).catch(() => {
                    this.setUnauth;
                });
        }
    },

    mounted() {
        this.getUser();
    }
}
</script>

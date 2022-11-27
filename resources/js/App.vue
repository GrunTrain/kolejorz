<template>
    <the-navbar></the-navbar>
    <router-view></router-view>
</template>

<script>
import TheNavbar from "./components/layouts/TheNavbar.vue";

export default {
    components: {
      TheNavbar,
    },
}
</script>

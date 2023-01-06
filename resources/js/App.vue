<template>
    <the-navbar @user-logged-in="userLoggedIn"></the-navbar>
    <router-view @user-logged-in="userLoggedIn"></router-view>
</template>

<script>
import TheNavbar from "./components/layouts/TheNavbar.vue";

export default {
    data(){
        return{
            loggedIn: false
        }
    },
    components: {
      TheNavbar,
    },
    mounted() {
        // axios.get('/api/user')
        //     .then((response)=> console.log(response.data.name))
        //     .catch((error)=>console.log(error));
        if(localStorage.getItem('authenticated')){
            this.loggedIn = true
        }else{
            this.loggedIn = false
        }
    },
    methods: {
        userLoggedIn() {
            this.loggedIn = !this.loggedIn;
        }
    },
}
</script>

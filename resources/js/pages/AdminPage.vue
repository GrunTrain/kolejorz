<template>
    <div class="flex flex-col lg:flex-row">
        <admin-navbar @set-component="setSelectedComponent"></admin-navbar>
        <component @set-component="setSelectedComponent" :is="currentComponent"></component>
    </div>
</template>

<script>
import AdminNavbar from "../components/layouts/AdminNavbar.vue";
import Users from "../components/UI/AdminUsers.vue"
import Tours from "../components/UI/AdminTours.vue"
import Friends from "../components/UI/AdminFriends.vue"

export default {
    components: {
        AdminNavbar,
        Users,
        Tours,
        Friends,
    },

    data() {
        return {
            currentComponent: 'users',
        }
    },

    methods: {
        setSelectedComponent(component) {
            this.currentComponent = component;
        }
    }, mounted(){
        axios.get("/api/profile/active").then(response => {
            if (!response.data.data.isAdmin) this.$router.push({ name: "all-stations" });
        })
    }
}
</script>

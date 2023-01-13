<template>
    <div class="flex flex-col lg:flex-row">
        <user-navbar @set-component="setSelectedComponent"></user-navbar>
        <component @set-component="setSelectedComponent" :is="currentComponent"></component>
    </div>
</template>

<script>
import UserNavbar from "../components/layouts/UserNavbar.vue";
import ChangePassword from "../components/UI/ChangePassword.vue";
import ChangeName from "../components/UI/ChangeName.vue";

export default {
    components: {
        UserNavbar,
        ChangePassword,
        ChangeName,
    },

    data() {
        return {
            currentComponent: 'change-password',
        }
    },

    methods: {
        setSelectedComponent(component) {
            this.currentComponent = component;
        }
    }
}
</script>

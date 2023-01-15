<template>
    <div class="flex flex-col lg:flex-row">
    <users-list></users-list>
    </div>
</template>

<script>

import UsersList from "../components/layouts/UsersList.vue";

export default {
    components: {
        UsersList
    },

    data() {
        return {
        }
    },

    methods: {
    },
}
</script>

<template>
    <div class="flex justify-center flex-col lg:flex-row">
    <users-list></users-list>
    </div>
</template>

<script>

import UsersList from "../components/layouts/UsersList.vue";

export default {
    components: {
        UsersList
    },
}
</script>

<template>
    <div class="flex-row">
           id nazwa e-mail<br>
    <span v-for="user in this.users" :key="user.id">
            {{user.id}} {{user.name}} {{user.email}} <base-button @click="deleteUser(user.id)">Usuń</base-button><br>
        </span>
    </div>
</template>

<script>

export default {

    data() {
        return {
            users: [],
        }
    },

    mounted() {
        axios.get("/api/profile").then((response) =>
        {
            this.users = response.data.data
        })
    },

    methods:{
        deleteUser(id){
            axios.delete("api/profile/"+id).then((response) =>{
                axios.get("/api/profile").then((response) =>
                {
                    this.users = response.data.data
                })
            })
        },
    },
}
</script>

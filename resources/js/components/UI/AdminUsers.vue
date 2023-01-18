<template>
    <div class="flex-row">
           <div>
            <input v-model="this.id" type="text" placeholder="id">
            <input v-model="this.name" type="text" placeholder="name">
            <input v-model="this.email" type="text" placeholder="e-mail">
           </div>
    <span v-for="user in filteredUsers" :key="user.id">
            {{user.id}} {{user.name}} {{user.email}} <base-button @click="deleteUser(user.id)" v-if="!user.isAdmin">Usuń</base-button><br>
        </span>
    </div>
</template>

<script>

export default {

    data() {
        return {
            users: [],
            id: '',
            name: '',
            email: '',
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

    computed: {
        filteredUsers() {
            return this.users.filter((user) => {
                return user.id.toString().includes(this.id) &&
                       user.name.toLowerCase().includes(this.name) &&
                       user.email.toLowerCase().includes(this.email)
            })
        }
    },
}
</script>

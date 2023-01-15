<template>
    <div class="flex-row">
           id observer observed<br>
    <span v-for="friend in this.friends" :key="friend.id">
            {{friend.id}} {{this.users[friend.user_id-1]["name"]}} {{this.users[friend.observed_id-1]["name"]}} <base-button @click="deleteFriend(friend.id)">Usuń</base-button><br>
        </span>
    </div>
</template>

<script>

export default {

    data() {
        return {
            users: [],
            friends: [],
        }
    },

    mounted() {
        axios.get("/api/profile").then((response) =>
        {
            this.users = response.data.data
        })
        axios.get("/api/friends").then((response) =>
        {
            this.friends = response.data.data
        })
    },

    methods:{
        deleteFriend(id){
            axios.delete("api/friends/"+id).then((response) =>{
                axios.get("/api/profile").then((response) =>
                {
                    this.users = response.data.data
                })
                axios.get("/api/friends").then((response) =>
                {
                    this.friends = response.data.data
                })
            })
        }
    },
}
</script>

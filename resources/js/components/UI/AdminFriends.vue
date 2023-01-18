<template>
    <div class="flex-row">
        <div>
            <input v-model="this.id" type="text" placeholder="id">
            <input v-model="this.observer" type="text" placeholder="observer">
            <input v-model="this.observed" type="text" placeholder="observed">
        </div>
        <span v-for="friend in filteredFriends" :key="friend.id">
            <p>{{friend.id}} {{this.users[friend.user_id-1]["name"]}} {{this.users[friend.observed_id-1]["name"]}} <base-button @click="deleteFriend(friend.id)">Usuń</base-button><br></p>
        </span>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            friends: [],
            id: '',
            observed: '',
            observer: ''
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
    computed:{
        filteredFriends() {
            return this.friends.filter((friend) => {
                return this.users[friend.user_id-1]["name"].toLowerCase().includes(this.observer) &&
                    this.users[friend.observed_id-1]["name"].toLowerCase().includes(this.observed) &&
                    friend.id.toString().includes(this.id)
            })
        }
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

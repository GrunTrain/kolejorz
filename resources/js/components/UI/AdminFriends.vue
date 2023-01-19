<template>
    <div class="flex-row">
        <div>
            <input v-model="this.id" type="text" placeholder="id">
            <input v-model="this.observer" type="text" placeholder="observer">
            <input v-model="this.observed" type="text" placeholder="observed">
        </div>
    <span v-for="friend in filteredFriends" :key="friend.id">
            <p v-if="this.edited.id != friend.id">{{friend.id}} {{this.users[friend.user_id]["name"]}} {{this.users[friend.observed_id]["name"]}} <base-button @click="setEdited(friend.id)">Edytuj</base-button></p>
            <p v-if="this.edited.id == friend.id">
            {{friend.id}} 
            <input v-model="this.edited.user_id" type="text">
            <input v-model="this.edited.observed_id" type="text">
            <base-button @click="saveEdit()">Zapisz</base-button>
            </p>
            <base-button @click="deleteFriend(friend.id)">Usuń</base-button><br>
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
            observer: '',
            edited: {
                id: 0,
                user_id: 0,
                observed_id: 0,
            },
        }
    },
    mounted() {
        axios.get("/api/profile").then((response) =>
        {
            this.getUsers()
        })
        this.getFriends()
    },
    computed:{
        filteredFriends() {
            return this.friends.filter((friend) => {
                return this.users[friend.user_id]["name"].toLowerCase().includes(this.observer) &&
                       this.users[friend.observed_id]["name"].toLowerCase().includes(this.observed) &&
                       friend.id.toString().includes(this.id)
            })
        }
    },
    methods:{
        deleteFriend(id){
            axios.delete("/api/friends/"+id).then(response =>{
                this.getUsers()
                this.getFriends()
            })
        },
        setEdited(id){
            this.edited.id = id
            this.edited.user_id = this.friends[id].user_id
            this.edited.observed_id = this.friends[id].observed_id
        },
        getUsers(){
            axios.get("/api/profile").then((response) =>
            {
                response.data.data.forEach(user => {
                    this.users[user.id] = user
                });
            })
        },
        saveEdit(){
            axios.post('/api/friends', this.edited)
            this.edited.id = 0
            this.getFriends()
        },
        getFriends(){
            axios.get("/api/friends").then((response) =>
            {
                this.friends = response.data.data
            })
        }
    },
}
</script>

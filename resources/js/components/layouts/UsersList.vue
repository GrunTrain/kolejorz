<template>
    <div class="sidebar bg-gradient-to-t from-gray-600 to-gray-700 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
        <the-search-window>
            <input v-model.trim="searchInput" type="text" placeholder="Szukaj użytkownika" class="rounded-lg bg-gray-600 w-11/12 py-2 mr-2 px-2">
            <button class="px-1" @click="clearInput">
                <img src="https://img.icons8.com/ios-filled/20/d3d3d3/delete-sign--v1.png"/>
            </button>
        </the-search-window>
        <span v-for="user in filteredUsers" :key="user.id">
            <users-dashboard :user="user" v-if="!this.friendsIds.includes(user.id) && user.id != this.userId" @add-friend="addFriend"></users-dashboard>
        </span>
        <span v-for="user in this.friends" :key="user.id">
            <friends-dashboard :user="user" @delete-friend="deleteFriend"></friends-dashboard>
        </span>
    </div>
</template>

<script>
import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import UsersDashboard from "@/components/UI/UsersDashboard.vue";
import FriendsDashboard from "@/components/UI/FriendsDashboard.vue";
import { mapGetters, mapActions } from 'vuex';

export default {

    components: {
        TheSearchWindow,
        UsersDashboard,
        FriendsDashboard,
    },

    data() {
        return {
            searchInput: '',
            users: [],
            userId: -1,
            friends: [],
            friendsIds: [],
            isFriend: false,
        }
    },

    computed: {
        filteredUsers() {
            return this.users.filter(user => {
                return user.name.toLowerCase().includes(this.searchInput.toLowerCase()) &&
                       !user.idPublic;
            })
        },
    },

    mounted() {
            this.reload()
    },
    methods: {
        reload(){
            axios.get("/api/profile/active").then((response) => {
                this.userId = response.data.data.id
            })
            axios.get("/api/profile/friends/id").then((response) =>
            {
                this.friendsIds = []
                this.friends = response.data.data
                this.friends.forEach(friend => {
                    this.friendsIds.push(friend.id)
                });
            })
            axios.get("/api/profile").then((response) =>
            {
                this.users = response.data.data
            })
        },
        addFriend(newFriend){
            axios.post("/api/profile/friends", {'id' : newFriend})
            this.reload()
        },
        deleteFriend(toDelete){
            axios.delete("/api/profile/friends/" + toDelete)
            this.reload()
        },
        clearInput() {
            this.searchInput = '';
        }
    }
}
</script>

<template>
    <alert-pop-up v-if="alert">
        {{ alert }}
    </alert-pop-up>
    <div
        v-if="selectedComponent === 'all-station-dashboard'"
        class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
              <p class="font-semibold lg:text-xl">
                {{ station.name }}
              </p>
        </div>

        <div class="flex items-center justify-end sm:space-x-0">
            <button
                v-if="isAuth"
                @click="setSelectedComponent('add-travelled-card')"
                title="Dodaj do przejechanych">
                <img class="rounded hover:bg-gray-600 py-3 px-2"
                     src="https://img.icons8.com/ios-filled/20/FFBF00/pin--v1.png"/>
            </button>
            <button
                v-if="isAuth"
                @click="setSelectedComponent('add-visited-card')"
                title="Dodaj do odwiedzonych">
                <img class="rounded hover:bg-gray-600 py-3 px-2"
                     src="https://img.icons8.com/ios-filled/20/14B8A6/pin--v1.png"/>
            </button>
        </div>
    </div>

    <add-travelled-card v-if="selectedComponent === 'add-travelled-card'" :station="station" @set-component="setSelectedComponent" @pass-alert="showAlert">
    </add-travelled-card>

    <add-visited-card v-if="selectedComponent === 'add-visited-card'" :station="station" @set-component="setSelectedComponent" @pass-alert="showAlert">
    </add-visited-card>

</template>

<script>
import AddTravelledCard from "@/components/UI/AddTravelledCard.vue";
import AddVisitedCard from "../UI/AddVisitedCard.vue";
import AlertPopUp from "./AlertPopUp.vue";

import { mapGetters } from 'vuex';

export default {
    props: ['station'],
    components: {
        AlertPopUp,
        AddVisitedCard,
        AddTravelledCard
    },

    computed: {
        ...mapGetters('auth', {
            isAuth: 'getStatus'
        }),
    },

    data() {
        return {
            selectedComponent: 'all-station-dashboard',
            userStations: [],
            alert: ''
        }
    },
    methods: {
        setSelectedComponent(component) {
            this.selectedComponent = component;
        },
        showAlert(alert) {
            this.alert = alert;
            setTimeout(this.hideAlert, 2000);
        },
        hideAlert() {
            this.alert = '';
        }
    },
}
</script>

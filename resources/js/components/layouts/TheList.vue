<template>
    <div class="sidebar bg-gray-600 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">
    <the-search-window></the-search-window>
        <span v-for="station in stations">
            <base-card :station="station"></base-card>
        </span>
    </div>
</template>

<script>
import TheSearchWindow from "@/components/layouts/TheSearchWindow.vue";
import BaseCard from "@/components/UI/BaseCard.vue";

export default {
    inject: ['stations'],

    components: {
        TheSearchWindow,
        BaseCard,
    },
}
</script>

<template>
    <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
            <p class="font-semibold lg:text-xl">
                {{ station.name }}
            </p>
            <div v-if="station.timesVisited">
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#14b8a6]">odwiedzona ({{station.timesVisited}})</p>
                </div>
            </div>
            <div v-if="station.timesPassed">
                <div class="flex justify-between flex-wrap">
                    <p class="text-[#ffbf00]">przejechana ({{ station.timesPassed }})</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['station'],
}
</script>

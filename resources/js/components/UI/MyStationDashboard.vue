<template>
    <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
            <p class="font-semibold lg:text-xl">
                {{ station.title }}
            </p>
            <div v-if="station.status === 'przejechana'">
                <p class="text-[#ffbf00]">{{station.status}}</p>
            </div>
            <div v-else>
                <p class="text-[#14b8a6]">{{station.status}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['station']
}
</script>

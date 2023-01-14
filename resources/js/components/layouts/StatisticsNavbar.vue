<template>
    <nav class="static w-full h-flex flex-col items-center justify-between flex-wrap bg-gray-800 px-8">
    <base-button @click="$emit('set-sub-component', 'stations')" class="bg-gray-600">Stacje</base-button>
    <base-button @click="$emit('set-sub-component', 'tours')" class="bg-gray-600">Wycieczki</base-button>
    </nav>
</template>

<script>

export default {
    emits: ['set-sub-component']
}
</script>

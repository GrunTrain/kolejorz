<template>
    <nav class="static w-full bg-gray-700 lg:px-3 flex justify-center lg:justify-start flex-wrap">
        <button @click="$emit('set-sub-component', 'statistics-stations')" class="text-white text-lg font-semibold py-2 w-1/3 md:w-1/4 lg:w-1/6 my-4 mr-2 rounded-lg bg-gray-800">Stacje</button>
        <button @click="$emit('set-sub-component', 'statistics-tours')" class="text-white text-lg font-semibold py-2 w-1/3 md:w-1/4 lg:w-1/6 my-4 rounded-lg bg-gray-800">Wycieczki</button>
    </nav>
</template>

<script>

export default {
    emits: ['set-sub-component']
}
</script>

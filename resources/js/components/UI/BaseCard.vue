<template>
    <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
        <div class="flex flex-col space-y-2 break-words">
            <p class="font-semibold lg:text-xl">Przedmieście Szczebrzeszyńskie</p>
            <p class="text-orange-200">Przejechane</p>
        </div>

        <div class="flex items-center justify-end sm:space-x-0">

            <button title="Dodaj do przejechanych">
                <img class="rounded hover:bg-gray-600 py-3 px-2"
                     src="https://img.icons8.com/ios-filled/20/FFBF00/pin--v1.png"/>
            </button>

            <button title="Dodaj do odwiedzonych">
                <img class="rounded hover:bg-gray-600 py-3 px-2"
                     src="https://img.icons8.com/ios-filled/20/14B8A6/pin--v1.png"/>
            </button>

            <button title="Dodaj post lub wycieczkę">
                <img class="rounded hover:bg-gray-600 p-2"
                     src="https://img.icons8.com/quill/30/FFFFFF/experimental-map-quill.png"/>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: "BaseCard"
}
</script>

<style scoped>

</style>

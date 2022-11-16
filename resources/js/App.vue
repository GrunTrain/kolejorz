<template>
    <the-navbar></the-navbar>


    <section class="flex flex-col-reverse flex-grow sm:flex-row mx-auto flex-grow h-[calc(100vh-76px)]">
        <div class="sidebar bg-gray-600 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">

            <the-tour-window></the-tour-window>
            <the-search-window></the-search-window>

            <base-card></base-card>
            <base-card></base-card>



            <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg text-white space-y-2">
                <div class="flex flex-col space-y-2">
                    <p class="font-semibold text-gray-900">Dodać stację do przejechanych?</p>
                    <p class="font-semibold lg:text-xl">Przedmieście Szczebrzeszyńskie</p>
                </div>

                <div class="flex flex-wrap items-center justify-end space-x-3">
                    <button class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg font-semibold shadow-inner shadow-2xl">Dodaj</button>
                    <button class="px-1 font-semibold hover:text-orange-100">Wstecz</button>
                </div>
            </div>


            <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg text-white space-y-2">
                <div class="flex flex-col space-y-2">
                    <p class="font-semibold text-gray-900">Usunąć stację z przejechanych?</p>
                    <p class="font-semibold lg:text-xl">Przedmieście Szczebrzeszyńskie</p>
                </div>

                <div class="flex flex-wrap items-center justify-end space-x-3">
                    <button class="px-3 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg font-semibold shadow-inner shadow-2xl">Usuń</button>
                    <button class="px-1 font-semibold hover:text-orange-100">Wstecz</button>
                </div>
            </div>

            <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-teal-600 to-teal-400 rounded-lg text-white space-y-2">
                <div class="flex flex-col space-y-2">
                    <p class="font-semibold text-gray-900">Dodać stację do odwiedzonych?</p>
                    <p class="font-semibold lg:text-xl">Wrocław Główny</p>
                </div>

                <div class="flex flex-wrap items-center justify-end space-x-3">
                    <button class="px-3 py-2 bg-teal-600 hover:bg-teal-700 rounded-lg font-semibold shadow-inner shadow-2xl">Dodaj</button>
                    <button class="px-1 font-semibold hover:text-teal-100">Wstecz</button>
                </div>
            </div>

        </div>

        <div id="map" class="p-48 sm:w-1/2 lg:w-2/3"></div>

    </section>

</template>

<script>
import TheNavbar from "./components/layouts/TheNavbar.vue";
import TheTourWindow from "./components/layouts/TheTourWindow.vue";
import TheSearchWindow from "./components/layouts/TheSearchWindow.vue";
import BaseCard from "./components/UI/BaseCard.vue";

export default {
    components: {
      TheNavbar,
      TheTourWindow,
      TheSearchWindow,

      BaseCard,
    },
    name: "App",
}
</script>

<style scoped>

</style>

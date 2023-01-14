<template>
    <nav class="lg:hidden bg-yellow-600 px-2 md:px-8">
        <div class="flex flex-col sm:flex-row sm:flex-wrap justify-between md:justify-evenly text-white py-4">
            <button
                @click="$emit('set-component', 'change-password')"
                class="px-3 mt-2 sm:mt-0 mr-1 py-1 hover:text-gray-200">
                <span class="float-left ml-2 font-semibold text-lg">Zmień hasło</span>
                <img class="block sm:hidden float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/lock--v1.png"/>
            </button>
            <button
                @click="$emit('set-component', 'change-name')"
                class="px-3 mt-2 sm:mt-0 mr-1 py-1 hover:text-gray-200">
                <span class="float-left ml-2 font-semibold text-lg">Zmień nazwę</span>
                <img class="block sm:hidden float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/user--v1.png"/>
            </button>
            <button
                @click="$emit('set-component', 'statistics')"
                class="px-3 mt-2 sm:mt-0 mr-1 py-1 hover:text-gray-200">
                <span class="float-left ml-2 font-semibold text-lg">Statystyki</span>
                <img class="block sm:hidden float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/statistics--v1.png"/>
            </button>
        </div>
    </nav>

    <nav class="hidden lg:flex lg:flex-col w-1/6 lg:h-[calc(100vh-76px)] bg-yellow-600">
        <div class="flex flex-col py-4">
            <button
                @click="$emit('set-component', 'statistics')"
                class="hover:bg-yellow-500 bg-transparent p-3 text-left text-white font-semibold">
                <img class="float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/statistics--v1.png"/>
                Statystyki
            </button>
            <button
                @click="$emit('set-component', 'change-password')"
                class="hover:bg-yellow-500 bg-transparent p-3 text-left text-white font-semibold">
                <img class="float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/lock--v1.png"/>
                Zmień hasło
            </button>
            <button
                @click="$emit('set-component', 'change-name')"
                class="hover:bg-yellow-500 bg-transparent p-3 text-left text-white font-semibold">
                <img class="float-right w-5" src="https://img.icons8.com/ios/30/FFFFFF/user--v1.png"/>
                Zmień nazwę
            </button>
        </div>
    </nav>

</template>

<script>
export default {

    emits: ['set-component']
}
</script>


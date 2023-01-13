<template>
    <div class="w-full lg:w-5/6 p-5 h-3/4 lg:pl-60 flex justify-center lg:block">
        <div class="w-full sm:w-2/3 lg:w-2/3 xl:w-1/2 p-4 bg-gray-800 rounded-lg shadow-md p-8">
            <form class="space-y-6">
                <h1 class="text-xl font-medium text-white justify-center">Ulubiona stacja</h1>
                <div>
                    <label class="block mb-2 text-sm font-medium text-white">Nazwa stacji</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg  block w-full p-2.5 " required>
                </div>

                <div class="bottom-0 flex justify-start w-fit">
                    <button class="top-10 w-full text-white bg-yellow-600 hover:bg-yellow-500 font-semibold rounded-lg text-sm px-5 py-3 text-center">Ustaw stację</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
}
</script>


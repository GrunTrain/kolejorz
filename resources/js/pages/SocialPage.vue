<template>
<!--    <div class="bg-gray-800">-->
<!--        <div class="flex justify-center">-->
<!--            <div class="bg-gray-800 w-full sm:w-2/3 lg:w-1/2 shadow rounded-lg p-6">-->
<!--                <textarea class="bg-gray-200 w-full rounded-lg shadow border p-2" rows="5" placeholder="Powiedz nam, co myślisz :)"></textarea>-->

<!--                <div class="flex justify-end mt-3">-->
<!--                    <button class="float-right font-semibold w-fit bg-yellow-600 hover:bg-yellow-700 text-white p-2 px-3 rounded-lg">-->
<!--                        Opublikuj-->
<!--                    </button>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->



    <div class="flex justify-center">
        <div class="w-4/5 md:w-2/3 lg:w-3/5 m-5 p-6 bg-gray-800 justify-center rounded-lg">
            <div class="text-xl text-white text-left">{{ name }}</div>
            <div class="mt-2 text-xs border-b border-[#b2f5ea] text-white"></div>

            <div class="bg-gray-800 pt-2 shadow text-m text-white font-small">
                <p class="font-semibold">{{ data }}</p>
                <p class="mt-4">{{ desc }}</p>

                <div class="text-sm font-semibold mt-4">
                    <p class="text-green-400">Wałbrzych Fabryczny</p>
                    <p class="text-yellow-400">Jaworzyna Śląska</p>
                    <p class="text-yellow-400">Imbramowice</p>
                    <p class="text-yellow-400">Wrocław Muchobór</p>
                    <p class="text-green-400">Wrocław Główny</p>
                </div>
            </div>

            <div class="mt-5 text-xs border-b py-1 border-[#b2f5ea] text-white"></div>
            <div class="bg-gray-800 p-1 rounded-b-lg shadow flex flex-row flex-wrap">
                <div class="flex flex-wrap w-full lg:justify-start justify-evenly">
                    <button class="text-center text-m text-black font-semibold font-sans bg-white hover:bg-gray-200 rounded-lg py-2 px-9 lg:px-3 mt-2 lg:mr-4">
                        <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                        Lubię to!
                    </button>
                    <button class="text-center text-m text-white font-semibold font-sans bg-gray-900 hover:bg-gray-700 rounded-lg py-2 px-6 mt-2">
                        <i class="fa fa-comment" aria-hidden="true"></i>
                        Komentarze
                    </button>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    data() {
        return {
            name: 'Gall Anonim',
            data: '12-05-2022',
            desc: 'Treść posta lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc vel felis vel neque dignissim sagittis.',
        }
    }
}
</script>


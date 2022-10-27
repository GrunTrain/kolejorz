<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kolejorz</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0/papaparse.min.js"></script>
    <script src="{{ asset('/js/app.js') }}" type="module"></script>

    <style>
        @layer utilities {
            .scrollbar::-webkit-scrollbar {
                width: 15px;
                height: 15px;
            }

            .scrollbar::-webkit-scrollbar-track {
                background: #374151;
            }

            .scrollbar::-webkit-scrollbar-thumb {
                background: #1f2937;
                border-radius: 20vh;
                height: 5vh;
            }

            .scrollbar::-webkit-scrollbar-thumb:hover {
                background: #111827;
            }
        }
    </style>
</head>
<body>

<nav class="static w-full flex items-center justify-between flex-wrap bg-gray-800 px-8">
    <div class="flex items-center text-white mr-6 pt-4 pb-5">
        <a href="#"
           class="flex inline-block"
        >
            <img
                src="https://img.icons8.com/ios/50/88E8D9/steam-engine.png"
                onmouseover="src='https://img.icons8.com/ios/50/FFFFFF/steam-engine.png'"
                onmouseout="src='https://img.icons8.com/ios/50/88E8D9/steam-engine.png'"
                width="40"
                alt="Kolejorz"
            />
            <span class="flex items-center ml-2 font-bold text-3xl">Kolejorz</span>
        </a>
    </div>
    <div class="block lg:hidden">
        <button
            id="menu-button"
            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </button>
    </div>
    <div
        id="menu"
        class="hidden w-full block flex-grow lg:flex lg:items-center lg:w-auto lg:border-0 border-t-2 border-teal-200 pb-2 lg:pb-0">
        <div class="lg:flex-grow">
            <a href="#" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                Wszystkie stacje
            </a>
            <a href="#" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                Moje stacje
            </a>
            <a href="#" class="block mt-6 lg:inline-block lg:mt-0 text-teal-200 lg:ml-12 font-semibold hover:text-teal-100">
                Moje wycieczki
            </a>
        </div>

        <div>
            <a href="#" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:px-2 py-2 lg:border rounded lg:bg-white text-white lg:text-black lg:border-white lg:hover:bg-gray-300 mt-8 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                <img
                    class="lg:hidden inline-block mr-2"
                    src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/login-rounded-right--v1.png"
                />
                <span class="flex items-center">Zaloguj się</span>
            </a>
        </div>
        <div>
            <a href="#" class="inline-block flex justify-left lg:justify-center lg:w-28 text-sm lg:ml-4 lg:px-2 py-2 lg:border rounded text-white lg:border-white lg:hover:bg-gray-600 lg:mt-0 hover:font-semibold lg:hover:font-normal">
                <img
                    class="lg:hidden inline-block mr-2"
                    src="https://img.icons8.com/ios-glyphs/20/20/FFFFFF/add-user-male.png"
                />
                <span class="flex items-center">Dołącz do nas</span>
            </a>
        </div>
    </div>
</nav>

<section class="flex mx-auto flex-grow h-[calc(100vh-76px)]">
    <div class="sidebar bg-gray-600 w-full sm:w-1/2 lg:w-1/3 pt-8 px-8 overflow-auto scrollbar">

        <div class="flex justify-start">
            <p class="text-white font-semibold">Szukaj stacji</p>
        </div>
        <div class="flex w-full my-2 py-5 px-3 bg-gray-800 rounded-2xl text-white">
            <div class="w-full flex">
                <input type="text" class="rounded-2xl bg-gray-600 w-full py-2 mr-2">
                {{--Button to submit--}}
                <button>
                    <img src="https://img.icons8.com/ios-glyphs/30/FFFFFF/search--v1.png"/>
                </button>
            </div>
        </div>

        {{--Component for found station--}}
        <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
            <div class="flex flex-col space-y-2">
                <p class="font-semibold text-xl">Przedmieście Szczebrzeszyńskie</p>
                <p class="text-orange-200">Przejechane</p>
            </div>

            <div class="flex items-center justify-end space-x-3 sm:space-x-0">
                {{--Button for adding station to "traveled by"--}}
                <a href="#" title="Dodaj do przejechanych">
                    <img class="rounded hover:bg-gray-600 py-3 px-2"
                         src="https://img.icons8.com/ios-filled/20/FFBF00/pin--v1.png"/>
                </a>
                {{--Button for adding station to "visited"--}}
                <a href="#" title="Dodaj do odwiedzonych">
                    <img class="rounded hover:bg-gray-600 py-3 px-2"
                         src="https://img.icons8.com/ios-filled/20/00FF00/pin--v1.png"/>
                </a>
                {{--Button for adding note about travel or timeline post--}}
                <a href="#" title="Dodaj post lub wycieczkę">
                    <img class="rounded hover:bg-gray-600 p-2"
                         src="https://img.icons8.com/quill/30/FFFFFF/experimental-map-quill.png"/>
                </a>
            </div>
        </div>


        {{--Second one with different status--}}
        <div class="flex flex-col my-4 p-3 bg-gray-800 rounded-lg text-white">
            <div class="flex flex-col space-y-2">
                <p class="font-semibold text-xl">Wrocław Główny</p>
                <p class="text-teal-200">Ilość odwiedzeń: </p>
            </div>

            <div class="flex items-center justify-end space-x-3 sm:space-x-0">
                {{--Button for adding station to "traveled by"--}}
                <a href="#" title="Dodaj do przejechanych">
                    <img class="rounded hover:bg-gray-600 py-3 px-2"
                         src="https://img.icons8.com/ios-filled/20/FFBF00/pin--v1.png"/>
                </a>
                {{--Button for adding station to "visited"--}}
                <a href="#" title="Dodaj do odwiedzonych">
                    <img class="rounded hover:bg-gray-600 py-3 px-2"
                         src="https://img.icons8.com/ios-filled/20/00FF00/pin--v1.png"/>
                </a>
                {{--Button for adding note about travel or timeline post--}}
                <a href="#" title="Dodaj post lub wycieczkę">
                    <img class="rounded hover:bg-gray-600 p-2"
                         src="https://img.icons8.com/quill/30/FFFFFF/experimental-map-quill.png"/>
                </a>
            </div>
        </div>


        {{--Dialogue windows for "travelled by"--}}
        <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg text-white space-y-2">
            <div class="flex flex-col space-y-2">
                <p class="font-semibold text-gray-900">Dodać stację do przejechanych?</p>
                <p class="font-semibold text-xl">Przedmieście Szczebrzeszyńskie</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg font-semibold shadow-inner shadow-2xl">Dodaj</button>
                <button class="px-1 font-semibold hover:text-orange-100">Wstecz</button>
            </div>
        </div>

        <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-yellow-600 to-yellow-500 rounded-lg text-white space-y-2">
            <div class="flex flex-col space-y-2">
                <p class="font-semibold text-gray-900">Usunąć stację z przejechanych?</p>
                <p class="font-semibold text-xl">Przedmieście Szczebrzeszyńskie</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg font-semibold shadow-inner shadow-2xl">Usuń</button>
                <button class="px-1 font-semibold hover:text-orange-100">Wstecz</button>
            </div>
        </div>

        {{--Dialogue window for "visited"--}}
        <div class="flex flex-col my-4 p-3 bg-gradient-to-r from-green-600 to-green-400 rounded-lg text-white space-y-2">
            <div class="flex flex-col space-y-2">
                <p class="font-semibold text-gray-900">Dodać stację do odwiedzonych?</p>
                <p class="font-semibold text-xl">Wrocław Główny</p>
            </div>

            <div class="flex items-center justify-end space-x-3">
                <button class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg font-semibold shadow-inner shadow-2xl">Dodaj</button>
                <button class="px-1 font-semibold hover:text-green-100">Wstecz</button>
            </div>
        </div>

    </div>

    {{--Example map--}}
    <div id="map" class="hidden sm:block sm:w-1/2 lg:w-2/3"></div>
</section>
</body>
</html>

<script>
    //Simple script before adding vue.js to project
    const menuButton = document.getElementById('menu-button');
    const menu = document.getElementById('menu');

    document.addEventListener('DOMContentLoaded', () => {
        menuButton.addEventListener('click', () => {
            dropMenu();
        })
    })
    function dropMenu() {
        if (menu.classList.contains('hidden')) {
            menu.classList.remove('hidden')
        } else {
            menu.classList.add('hidden');
        }
    }
</script>

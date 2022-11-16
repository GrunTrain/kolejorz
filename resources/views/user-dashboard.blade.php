<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Dodawanie wycieczki</title>

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.2/dist/leaflet.css" integrity="sha256-sA+zWATbFveLLNqWO2gtiw3HL/lh1giY/Inf1BJ0z14=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.2/dist/leaflet.js" integrity="sha256-o9N1jGDZrf5tS+Ft4gbIK7mYMipq9lqpVJ91xHSyKhg=" crossorigin=""></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/papaparse@5.3.0/papaparse.min.js"></script>
    <script src="{{ asset('/js/map.js') }}" type="module"></script>

    @vite('resources/js/app.js')

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

<div id="app"></div>


</body>
</html>

<!doctype html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kolejorz</title>

    @vite('resources/js/app.js')

    <style>
        @layer utilities {
            .scrollbar::-webkit-scrollbar {
                width: 15px;
            }
            .scrollbar::-webkit-scrollbar-track {
                background: #313946;
            }
            .scrollbar::-webkit-scrollbar-thumb {
                background: #161e2f;
                height: 10%;
            }
            .scrollbar::-webkit-scrollbar-thumb:hover {
                background: rgba(23, 32, 51, 0.99);
            }
        }
    </style>
</head>
<body class="scrollbar bg-gray-600">
    <div id="app"></div>
</body>
</html>

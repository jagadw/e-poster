<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Poster</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/css/index.css">
</head>
<script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>

<body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        @yield('content')
    </div>
</body>
</html>
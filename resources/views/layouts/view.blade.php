<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Poster</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    <style>
      .input {
        padding: 10px;
        font-size: 16px;
        width: 300px;
      }
    </style>
</head>

<body class="bg-gray-100 p-4">
    <div class="container mx-auto">
        @yield('content')
    </div>
</body>
</html>
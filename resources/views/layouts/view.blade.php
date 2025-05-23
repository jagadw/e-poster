<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-Poster</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">

    <!-- Main Content -->
    <div class="container mx-auto flex-grow p-4">
        @yield('content')
    </div>

    <!-- Sticky Footer -->
    {{-- <footer class="bg-[#36ab40] text-white text-center py-4">
        &copy; {{ date('Y') }} e-Poster. All rights reserved.
    </footer> --}}

</body>
</html>

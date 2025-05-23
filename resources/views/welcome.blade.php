@extends('layouts.view')

@section('content')
<div id="table-wrapper">
<div class="flex items-center justify-center min-h-screen bg-white">
    <div class="text-center space-y-6 w-[90%] max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16">
        </div>

        <h1 class="text-xl font-semibold tracking-wide uppercase">Presentation Schedule</h1>

        <div class="space-y-4">
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Presentation
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Video Presentation
            </a>
            <a href="{{ route('home') }}" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Poster Presentation
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Moderated Video Presentation
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Unmoderated Poster
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Unmoderated Video
            </a>
        </div>
    </div>
</div>
</div>
@endsection

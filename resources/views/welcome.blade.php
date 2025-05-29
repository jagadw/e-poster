@extends('layouts.view')

@section('content')
<div id="table-wrapper">
<div class="flex items-center justify-center min-h-screen bg-white py-6">
    <div class="text-center space-y-6 w-[90%] max-w-md">
        <div class="flex justify-center">
            <img src="{{ asset('images/kopapdi.png') }}" alt="Logo" class="h-auto w-32 sm:w-40 md:w-52 lg:w-64 xl:w-72 object-contain">
        </div>

        <h1 class="text-xl font-semibold tracking-wide uppercase">Poster Menu</h1>

        <div class="space-y-4">
            {{-- <a href="{{ route('GuestPresentation') }}" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Presentation
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Video Presentation
            </a> --}}
            <a href="{{ route('home') }}" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Podium Poster Presentation
            </a>
            {{-- <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Moderated Video Presentation
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Unmoderated Poster
            </a>
            <a href="#" class="block bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">
                Unmoderated Video
            </a>
            <a href="{{ route('login') }}" class="block bg-gray-600 hover:bg-green-700 text-white font-semibold py-3 rounded shadow-md">Login {{ '(Admin)' }}</a> --}}
        </div>
    </div>
</div>
</div>
@endsection

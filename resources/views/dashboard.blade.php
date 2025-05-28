<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div> --}}

        <div class="flex justify-center">
            <img src="{{ asset('images/kopapdi.png') }}" alt="Logo" class="h-auto w-32 sm:w-40 md:w-52 lg:w-64 xl:w-72 object-contain">
        </div>

    </div>
</x-app-layout>

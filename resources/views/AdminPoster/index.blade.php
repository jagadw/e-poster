<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Poster List</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('AdminPoster.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Add Poster</a>

        {{-- @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif --}}

        <table class="w-full mt-4 border overflow-x-auto">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-2 py-1">Code</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Title</th>
                    <th class="border px-2 py-1">Affiliate</th>
                    <th class="border px-2 py-1">File</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posters as $poster)
                    <tr>
                        <td class="border px-2 py-1">{{ $poster->code }}</td>
                        <td class="border px-2 py-1">{{ $poster->name }}</td>
                        <td class="border px-2 py-1">{{ $poster->title }}</td>
                        <td class="border px-2 py-1">{{ $poster->affiliate }}</td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('ViewPoster', $poster) }}" class="text-blue-500">View</a>
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <form action="{{ route('AdminPoster.destroy', $poster) }}" method="POST" class="inline">
                                <a href="{{ route('AdminPoster.edit', $poster) }}" class="text-indigo-500">Edit</a>
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="text-red-500 ml-2">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $posters->links() }}
    </div>
</x-app-layout>

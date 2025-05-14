<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Poster List</h2>
    </x-slot>

    <div class="py-4 px-6">
        <a href="{{ route('adminPoster.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add Poster</a>

        @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif

        <table class="w-full mt-4 border">
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
                            <a href="{{ asset('storage/' . $poster->file) }}" class="text-blue-500" target="_blank">Download</a>
                        </td>
                        <td class="border px-2 py-1">
                            <a href="{{ route('adminPoster.edit', $poster) }}" class="text-indigo-500">Edit</a>
                            <form action="{{ route('adminPoster.destroy', $poster) }}" method="POST" class="inline">
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

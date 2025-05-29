<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Poster</h2>
    </x-slot>

    <div id="table-wrapper" class="table-container">
    <div class="py-4 px-6">
        <form action="{{ route('AdminPoster.update', $poster) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
        
            <div>
                <label>Name</label>
                <input name="name" value="{{ $poster->name }}" class="w-full border p-2" required>
            </div>
            <div>
                <label>Title</label>
                <input name="title" value="{{ $poster->title }}" class="w-full border p-2" required>
            </div>
            <div>
                <label>Affiliate</label>
                <input name="affiliate" value="{{ $poster->affiliate }}" class="w-full border p-2">
            </div>
            <div>
                <p>Current File: <a href="{{ asset('storage/' . $poster->file) }}" target="_blank">View</a></p>
                <input type="file" name="file" class="w-full border p-2">
                <p>{{'*png, jpg, jpeg, pptx, docx, pdf. (Max 20 MB)'}}</p>
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
            <a href="{{ route('AdminPoster.index') }}" class="bg-[#6f7575] text-white px-4 py-3 rounded">Back</a>
        </form>        
    </div>
    </div>
</x-app-layout>

@if (session('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        };
    </script>
@endif

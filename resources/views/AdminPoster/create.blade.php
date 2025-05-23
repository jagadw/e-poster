<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Create Poster</h2>
    </x-slot>

    <div id="table-wrapper">
    <div class="py-4 px-6">
        <form action="{{ route('AdminPoster.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label>Category</label>
                <select name="category" class="w-full border p-2" required>
                    <option value="A">Alam</option>
                    <option value="S">Sosial</option>
                </select>
            </div>
            <div>
                <label>Name</label>
                <input name="name" class="w-full border p-2" required>
            </div>
            <div>
                <label>Title</label>
                <input name="title" class="w-full border p-2" required>
            </div>
            <div>
                <label>Affiliate</label>
                <input name="affiliate" class="w-full border p-2">
            </div>
            <div>
                <label>File {{'(Max 10 MB)'}}</label>
                <input type="file" name="file" class="w-full border p-2" required>
            </div>
            <button class="bg-[#36ab40] text-white px-4 py-2 rounded">Save</button>
            <a href="{{ route('AdminPoster.index') }}" class="bg-[#6f7575] text-white px-4 py-3 rounded">Back</a>
        </form>
    </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Poster List</h2>
    </x-slot>

    <div id="table-wrapper">
        <div class="py-4 px-6">
            <a href="{{ route('AdminPoster.create') }}" class="px-3 py-2 bg-[#36ab40] text-white rounded">Add Poster</a>
        </div>
    <div class="py-4 px-6">
        {{-- @if(session('success'))
            <div class="mt-4 text-green-600">{{ session('success') }}</div>
        @endif --}}
            <form id="formSearch" method="GET" action="{{ route('AdminPoster.index') }}"
            class="mb-4 flex flex-wrap items-center gap-2">

            <input type="text" class="input" id="input1" name="code" value="{{ request('code') }}"
                placeholder="Search by Code"
                class="border px-3 py-1.5 rounded w-[160px]">

            <input type="text" class="input" id="input2" name="author" value="{{ request('author') }}"
                placeholder="Search by Author"
                class="border px-3 py-1.5 rounded w-[160px]">

            <input type="text" class="input" id="input3" name="title" value="{{ request('title') }}"
                placeholder="Search by Title"
                class="border px-3 py-1.5 rounded w-[160px]">

            <select name="category" class="border px-3 py-1.5 rounded w-[140px]">
                <option value="">All Category</option>
                <option value="A" {{ request('category') == 'A' ? 'selected' : '' }}>Alam</option>
                <option value="S" {{ request('category') == 'S' ? 'selected' : '' }}>Sosial</option>
                <option value="D" {{ request('category') == 'D' ? 'selected' : '' }}>Dunia</option>
            </select>

            <select name="file_type" class="border px-3 py-1.5 rounded w-[140px]">
                <option value="">All File Types</option>
                <option value="pdf" {{ request('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
                <option value="jpg" {{ request('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
                <option value="png" {{ request('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
            </select>

            <button type="submit" class="bg-[#36ab40] text-white px-3 py-1.5 rounded">GO</button>

            <a href="{{ route('AdminPoster.index') }}"
                class="bg-[#36ab40] text-white px-3 py-1.5 rounded">
                SHOW ALL POSTERS
            </a>
        </form>

        <table class="w-full mt-4 border overflow-x-auto">
            <thead>
                <tr class="bg-[#36ab40] text-white">
                    <th class="border px-2 py-1">No</th>
                    <th class="border px-2 py-1">Code</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Title</th>
                    <th class="border px-2 py-1">Affiliate</th>
                    <th class="border px-2 py-1">File</th>
                    <th class="border px-2 py-1">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($posters->isEmpty())
                <p>No items found.</p>
                @else
                @foreach ($posters as $poster)
                    <tr>
                        <td class="border px-2 py-1 text-center">{{ $loop->iteration }}</td>
                        <td class="border px-2 py-1 text-center">{{ $poster->code }}</td>
                        <td class="border px-2 py-1 text-center">{{ $poster->name }}</td>
                        <td class="border px-2 py-1 text-center">{{ $poster->title }}</td>
                        <td class="border px-2 py-1 text-center">{{ $poster->affiliate }}</td>
                        <td class="border px-2 py-1 text-center">
                            <a href="{{ route('ViewAdminPoster', $poster) }}" class="bg-[#36ab40] text-white px-2 py-1 rounded">View</a>
                        </td>
                        <td class="border px-2 py-1 text-center">
                            <form action="{{ route('AdminPoster.destroy', $poster) }}" method="POST" class="inline">
                                <a href="{{ route('AdminPoster.edit', $poster) }}" class="bg-[#36ab40] text-white px-2 py-1 rounded">Edit</a>
                                @csrf @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-600 text-white px-2 py-1 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        {{ $posters->links() }}
        <div id="keyboard-container" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; background: #fff; box-shadow: 0 -4px 10px rgba(0,0,0,0.2); padding: 10px;">
            <div class="simple-keyboard"></div>
          </div>
    </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/css/index.css">
    <script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>

    <script>
        const Keyboard = window.SimpleKeyboard.default;
      
        let currentInput = null;
      
        const keyboard = new Keyboard({
          onChange: input => {
            if (currentInput) {
              currentInput.value = input;
            }
          },
          onKeyPress: button => {
            console.log("Key pressed:", button);
          }
        });
      
        const keyboardContainer = document.getElementById("keyboard-container");
      
        // Input fields
        const inputs = document.querySelectorAll(".input");
      
        inputs.forEach(input => {
          input.addEventListener("click", () => {
            currentInput = input;
            keyboard.setInput(input.value || "");
            keyboardContainer.style.display = "block";
          });
        });
      
        // Hide keyboard on outside click
        document.addEventListener("click", function (e) {
          if (!keyboardContainer.contains(e.target) && !Array.from(inputs).includes(e.target)) {
            keyboardContainer.style.display = "none";
          }
        });
      </script>

</x-app-layout>

    @extends('layouts.view')

    @section('content')

    <div class="px-6 py-4">
        <a href="{{ route('login') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Admin Only</a>
    </div>

        <div class="py-4 px-6">
        <form id="formSearch" method="GET" action="{{ route('home') }}"
        class="mb-4 space-y-2 md:space-y-0 md:flex md:space-x-2">

        <input type="text" id="input1" name="code" value="{{ request('code') }}"
            placeholder="Search by Code"
            class="input border px-4 py-2 rounded w-full md:w-1/3">

        <input type="text" id="input2" name="author" value="{{ request('author') }}"
            placeholder="Search by Author"
            class="input border px-4 py-2 rounded w-full md:w-1/3">

        <select name="file_type" class="input border px-4 py-2 rounded w-full md:w-1/3">
            <option value="" selected disabled>All File Types</option>
            <option value="pdf" {{ request('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
            <option value="jpg" {{ request('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
            <option value="png" {{ request('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
        </select>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">GO</button>

        <a href="{{ route('home') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
            SHOW ALL POSTERS
        </a>
        </form>

        <div id="keyboard-container" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; background: #fff; box-shadow: 0 -4px 10px rgba(0,0,0,0.2); padding: 10px;">
            <div class="simple-keyboard"></div>
          </div>

            <table class="w-full mt-4 border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border px-2 py-1">Code</th>
                        <th class="border px-2 py-1">Name</th>
                        <th class="border px-2 py-1">Title</th>
                        <th class="border px-2 py-1">Affiliate</th>
                        <th class="border px-2 py-1">File</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($Posters as $poster)
                        <tr>
                            <td class="border px-2 py-1">{{ $poster->code }}</td>
                            <td class="border px-2 py-1">{{ $poster->name }}</td>
                            <td class="border px-2 py-1">{{ $poster->title }}</td>
                            <td class="border px-2 py-1">{{ $poster->affiliate }}</td>
                            <td class="border px-2 py-1">
                                <a href="{{ route('ViewPoster', $poster) }}" class="text-blue-500" target="_blank">View</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

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
    @endsection

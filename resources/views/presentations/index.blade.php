<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Podium Presentation</h2>
    </x-slot>

<div id="table-wrapper">
    <div class="py-4 px-6">

        <div class="py-4">
            <a href="{{ route('presentations.create') }}" class="px-3 py-2 bg-[#36ab40] text-white rounded">Add New</a>
        </div>

        <form id="formSearch" method="GET" action="{{ route('presentations.index') }}"
        class="mb-4 space-y-2 md:space-y-0 md:flex md:space-x-2">

        <input type="text" id="input1" name="code" value="{{ request('code') }}"
        placeholder="Search by Code"
        class="input border px-4 py-2 rounded w-full md:w-1/3">

        <input type="text" id="input2" name="title" value="{{ request('title') }}"
        placeholder="Search by Title"
        class="input border px-4 py-2 rounded w-full md:w-1/3">

        <input type="text" id="input3" name="author" value="{{ request('author') }}"
        placeholder="Search by Author"
        class="input border px-4 py-2 rounded w-full md:w-1/3">

        <button type="submit" class="bg-[#36ab40] text-white px-4 py-2 rounded">GO</button>
        <a href="{{ route('presentations.index') }}" class="bg-gray-300 text-black px-4 py-2 rounded">Reset</a>

        </form>

        <table class="table w-full mt-4 border overflow-x-auto">
            <thead>
                <tr class="bg-[#36ab40] text-white">
                    <th class="border px-2 py-1">Code</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Title</th>
                    <th class="border px-2 py-1">Date</th>
                    <th class="border px-2 py-1">Time</th>
                    <th class="border px-2 py-1">Room</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($presentations->isEmpty())
                <p>No items found.</p>
                @else
                @foreach($presentations as $p)
                <tr>
                    <td class="border px-2 py-1">{{ $p->code }}</td>
                    <td class="border px-2 py-1">{{ $p->name }}</td>
                    <td class="border px-2 py-1">{{ $p->title }}</td>
                    <td class="border px-2 py-1">{{ $p->date }}</td>
                    <td class="border px-2 py-1">{{ $p->time_start }} - {{ $p->time_end }}</td>
                    <td class="border px-2 py-1">{{ $p->room }}</td>
                    <td>
                        <a href="{{ route('presentations.edit', $p) }}" class="bg-[#36ab40] text-white px-2 py-1 rounded">Edit</a>
                        <form action="{{ route('presentations.destroy', $p) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button class="bg-red-600 text-white px-2 py-1 rounded" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        </div>

        <div class="mt-4">
            {{ $presentations->links() }}
        </div>

        <div id="keyboard-container" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; background: #fff; box-shadow: 0 -4px 10px rgba(0,0,0,0.2); padding: 10px;">
            <div class="simple-keyboard"></div>
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
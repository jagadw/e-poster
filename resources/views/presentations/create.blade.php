<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Add New Podium Presentation</h2>
    </x-slot>

    <div id="table-wrapper" class="table-container">
        <div class="py-4 px-6">
            <form method="POST" action="{{ route('presentations.store') }}" class="space-y-4">
                @csrf

                <input type="hidden" name="code" id="code">

                <div>
                    <label class="block font-semibold mb-1">Poster Code</label>
                    <select id="poster_code" class="w-full border rounded-lg px-3 py-2" onchange="fillPosterInfo(this)" required>
                        <option disabled selected>-- Select Poster --</option>
                        @foreach ($posters as $poster)
                            @if (!in_array($poster->code, $usedCodes))
                                <option value="{{ $poster->code }}" data-name="{{ $poster->name }}" data-title="{{ $poster->title }}">
                                    {{ $poster->code }}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Name</label>
                    <input type="text" id="name" name="name" class="w-full border p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Title</label>
                    <textarea id="title" name="title" class="w-full border p-2 bg-gray-100" rows="3" readonly></textarea>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Date</label>
                    <input type="date" name="date" class="w-full border p-2" required>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-semibold mb-1">Time Start</label>
                        <input type="time" name="time_start" class="w-full border p-2" required>
                    </div>
                    <div>
                        <label class="block font-semibold mb-1">Time End</label>
                        <input type="time" name="time_end" class="w-full border p-2" required>
                    </div>
                </div>

                <div>
                    <label class="block font-semibold mb-1">Room</label>
                    <input type="text" name="room" class="w-full border p-2" required>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <a href="{{ route('presentations.index') }}" class="bg-[#6f7575] text-white px-4 py-3 rounded">Back</a>
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Create</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function fillPosterInfo(select) {
            const selectedOption = select.options[select.selectedIndex];
            document.getElementById('code').value = selectedOption.value;

            const name = selectedOption.getAttribute('data-name');
            const title = selectedOption.getAttribute('data-title');

            if (name && title) {
                document.getElementById('name').value = name;
                document.getElementById('title').value = title;
            }
        }
    </script>
</x-app-layout>

@if (session('error'))
    <script>
        window.onload = function() {
            alert("{{ session('error') }}");
        };
    </script>
@endif
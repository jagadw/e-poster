<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Edit Presentation</h2>
    </x-slot>

    <div id="table-wrapper">
        <div class="py-4 px-6">
            <form action="{{ route('presentations.update', $presentation) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <input type="hidden" name="code" value="{{ $presentation->code }}">

                    {{-- <label>Poster</label>
                    <select name="code" class="w-full border p-2" onchange="fillPosterInfo(this)">
                        @foreach ($posters as $poster)
                            <option value="{{ $poster->code }}"
                                data-name="{{ $poster->name }}"
                                data-title="{{ $poster->title }}"
                                {{ $poster->code === $presentation->code ? 'selected' : '' }}>
                                {{ $poster->code }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}

                <div>
                    <label>Name</label>
                    <input id="poster-name" type="text" value="{{ $posterDetail->name ?? '' }}" class="w-full border p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label>Title</label>
                    <input id="poster-title" type="text" value="{{ $posterDetail->title ?? '' }}" class="w-full border p-2 bg-gray-100" readonly>
                </div>

                <div>
                    <label>Date</label>
                    <input type="date" name="date" value="{{ $presentation->date }}" class="w-full border p-2" required>
                </div>

                <div>
                    <label>Start Time</label>
                    <input type="time" name="time_start" value="{{ $presentation->time_start }}" class="w-full border p-2" required>
                </div>

                <div>
                    <label>End Time</label>
                    <input type="time" name="time_end" value="{{ $presentation->time_end }}" class="w-full border p-2" required>
                </div>

                <div>
                    <label>Room</label>
                    <input type="text" name="room" value="{{ $presentation->room }}" class="w-full border p-2" required>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button class="bg-green-600 text-white px-4 py-2 rounded">Update</button>
                    <a href="{{ route('presentations.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded">Back</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function fillPosterInfo(select) {
            const selected = select.options[select.selectedIndex];
            const name = selected.getAttribute('data-name');
            const title = selected.getAttribute('data-title');
            document.getElementById('poster-name').value = name;
            document.getElementById('poster-title').value = title;
        }
    </script>
</x-app-layout>

<x-app-layout>
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6">Edit Podium Presentation</h2>

    <form method="POST" action="{{ route('presentations.update', $presentation->id) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <input type="hidden" name="code" id="code" value="{{ $presentation->code }}">
            {{-- <label class="block font-semibold mb-1">Poster Code</label> --}}
            <select id="poster_code" class="w-full border rounded-lg px-3 py-2" onchange="fillPosterInfo(this)" hidden>
                <option disabled>-- Select Poster --</option>
                @foreach ($posters as $poster)
                    <option value="{{ $poster->code }}"
                        data-name="{{ $poster->name }}"
                        data-title="{{ $poster->title }}"
                        {{ $poster->code === $presentation->code ? 'selected' : '' }}>
                        {{ $poster->code }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block font-semibold mb-1">Name</label>
            <input type="text" id="name" name="name" class="w-full border rounded-lg px-3 py-2"
                value="{{ $presentation->name }}" required readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <textarea id="title" name="title" class="w-full border rounded-lg px-3 py-2" rows="3"
                required readonly>{{ $presentation->title }}</textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" class="w-full border rounded-lg px-3 py-2"
                value="{{ $presentation->date }}" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Time Start</label>
                <input type="time" name="time_start" class="w-full border rounded-lg px-3 py-2"
                    value="{{ $presentation->time_start }}" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Time End</label>
                <input type="time" name="time_end" class="w-full border rounded-lg px-3 py-2"
                    value="{{ $presentation->time_end }}" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Room</label>
            <input type="text" name="room" class="w-full border rounded-lg px-3 py-2"
                value="{{ $presentation->room }}" required>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('presentations.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Update</button>
        </div>
    </form>
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
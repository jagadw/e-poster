@extends('layouts.view')

@section('content')
<div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
    <h2 class="text-2xl font-bold mb-6">Add New Podium Presentation</h2>
    <form method="POST" action="{{ route('presentations.store') }}" class="space-y-4">
        @csrf

        <div>
            <input type="hidden" name="code" id="code">
            <label class="block font-semibold mb-1">Poster Code</label>
            <select id="poster_code" class="w-full border rounded-lg px-3 py-2" onchange="fillPosterInfo(this)">
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
            <input type="text" id="name" name="name" class="w-full border rounded-lg px-3 py-2" required readonly>
        </div>

        <div>
            <label class="block font-semibold mb-1">Title</label>
            <textarea id="title" name="title" class="w-full border rounded-lg px-3 py-2" rows="3" required readonly></textarea>
        </div>

        <div>
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block font-semibold mb-1">Time Start</label>
                <input type="time" name="time_start" class="w-full border rounded-lg px-3 py-2" required>
            </div>
            <div>
                <label class="block font-semibold mb-1">Time End</label>
                <input type="time" name="time_end" class="w-full border rounded-lg px-3 py-2" required>
            </div>
        </div>

        <div>
            <label class="block font-semibold mb-1">Room</label>
            <input type="text" name="room" class="w-full border rounded-lg px-3 py-2" required>
        </div>

        <div class="flex justify-end gap-3 pt-4">
            <a href="{{ route('presentations.index') }}" class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">Back</a>
            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Create</button>
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
@endsection

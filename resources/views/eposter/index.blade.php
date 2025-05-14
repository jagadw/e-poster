@extends('layouts.app')

@section('content')
<h1 class="text-2xl font-bold mb-4">E-Poster List</h1>

<form id="formSearch" method="GET" action="{{ route('home') }}"
    class="mb-4 space-y-2 md:space-y-0 md:flex md:space-x-2">

    <input type="text" id="codeInput" name="code" value="{{ request('code') }}"
        placeholder="Search by Code"
        class="input border px-4 py-2 rounded w-full md:w-1/3">

    <input type="text" id="authorInput" name="author" value="{{ request('author') }}"
        placeholder="Search by Author"
        class="input border px-4 py-2 rounded w-full md:w-1/3">

    <select name="file_type" class="input border px-4 py-2 rounded w-full md:w-1/3">
        <option value="">All File Types</option>
        <option value="pdf" {{ request('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
        <option value="docx" {{ request('file_type') == 'docx' ? 'selected' : '' }}>DOCX</option>
        <option value="ppt" {{ request('file_type') == 'ppt' ? 'selected' : '' }}>PPT</option>
    </select>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">GO</button>

    <button type="button" onclick="showAll()" class="bg-blue-600 text-white px-4 py-2 rounded">
        SHOW ALL POSTERS
    </button>
</form>

<div class="overflow-x-auto">
    <table class="table-auto w-full bg-white shadow rounded">
        <thead>
            <tr class="bg-gray-200 text-left">
                <th class="p-2">Code</th>
                <th class="p-2">Author</th>
                <th class="p-2">Title</th>
                <th class="p-2">Affiliate</th>
                <th class="p-2">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($posters as $poster)
            <tr class="border-t">
                <td class="p-2">{{ $poster['code'] }}</td>
                <td class="p-2">{{ $poster['author'] }}</td>
                <td class="p-2">{{ $poster['title'] }}</td>
                <td class="p-2">Affiliate</td>
                <td class="p-2"><a href="{{ $poster['link'] }}" class="text-blue-600 underline">View Poster</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection

<script>
    function showAll() {
        window.location.href = window.location.pathname;
    }
</script>
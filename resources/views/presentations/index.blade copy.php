@extends('layouts.view')

@section('content')

<div id="table-wrapper">

<a href="{{ route('presentations.create') }}" class="px-3 py-2 bg-[#36ab40] text-white rounded">Add New</a>

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
        @foreach($presentations as $p)
        <tr>
            <td class="border px-2 py-1">{{ $p->code }}</td>
            <td class="border px-2 py-1">{{ $p->name }}</td>
            <td class="border px-2 py-1">{{ $p->title }}</td>
            <td class="border px-2 py-1">{{ $p->date }}</td>
            <td class="border px-2 py-1">{{ $p->time_start }} - {{ $p->time_end }}</td>
            <td class="border px-2 py-1">{{ $p->room }}</td>
            <td>
                <a href="{{ route('presentations.edit', $p) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('presentations.destroy', $p) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

@endsection

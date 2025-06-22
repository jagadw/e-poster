@extends('layouts.view')

@section('content')

    <div id="table-wrapper" class="py-4 px-6 table-container">
    <div class="w-full flex justify-center mb-4">
      <img src="{{ asset('images/kopapdi.png') }}" alt="Logo" class="h-16">
    </div>
    <div class="pb-4">
        <a href="{{ route('/') }}" class="px-3 py-2 bg-[#6f7575] text-white rounded">Back</a>

    <a href="{{ route('home') }}"
        class="bg-[#36ab40] text-white px-3 py-1.5 rounded">
        SHOW ALL POSTERS
    </a>

    </div>

    <form id="formSearch" method="GET" action="{{ route('home') }}"
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

    <button type="submit" class="bg-[#36ab40] text-white px-3 py-1.5 rounded">GO</button>

    <div class="flex-row gap-1">
    <select name="category" class="border px-3 py-1.5 rounded w-[140px] mb-2">
        <option value="">All Category</option>
        @foreach($types as $type)
            <option value="{{ $type }}" {{ request('category') == $type ? 'selected' : '' }}>
                {{ ucfirst($type) }}
            </option>
        @endforeach
    </select>

    <select name="file_type" class="border px-3 py-1.5 rounded w-[140px]">
        <option value="">All File Types</option>
        <option value="jpeg" {{ request('file_type') == 'jpeg' ? 'selected' : '' }}>JPEG</option>
        <option value="jpg" {{ request('file_type') == 'jpg' ? 'selected' : '' }}>JPG</option>
        <option value="png" {{ request('file_type') == 'png' ? 'selected' : '' }}>PNG</option>
        <option value="docx" {{ request('file_type') == 'docx' ? 'selected' : '' }}>DOCX</option>
        <option value="pptx" {{ request('file_type') == 'pptx' ? 'selected' : '' }}>PPTX</option>
        <option value="pdf" {{ request('file_type') == 'pdf' ? 'selected' : '' }}>PDF</option>
    </select>
</div>

</form>

      <div class="relative overflow-x-auto">
        <table class="w-full mt-4 border">
            <thead>
                <tr class="bg-[#36ab40] text-white">
                    <th class="border px-2 py-1">No</th>
                    <th class="border px-2 py-1">Code</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Title</th>
                    <th class="border px-2 py-1">Type</th>
                    <th class="border px-2 py-1">File</th>
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
                        <td class="border px-2 py-1 text-center">{{ $poster->type }}</td>
                        <td class="border px-2 py-1 text-center">
                          <a href="#" onclick="let msg=document.createElement('div'); msg.textContent='Please wait...'; msg.style.cssText='position:fixed;top:20px;left:50%;transform:translateX(-50%);background:#facc15;color:#000;padding:10px 20px;border-radius:5px;box-shadow:0 2px 6px rgba(0,0,0,0.2);font-family:sans-serif;z-index:9999;'; document.body.appendChild(msg); setTimeout(()=>msg.remove(),3000); return false;"
                          class="bg-[#36ab40] text-white px-2 py-1 rounded open-modal"
                          data-file="{{ asset('storage/' . $poster->file) }}"
                          data-extension="{{ pathinfo($poster->file, PATHINFO_EXTENSION) }}">
                          View
                        </a>
                        </td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ $posters->links() }}
    </div>        
    </div>

        <div id="keyboard-container" style="display: none; position: fixed; bottom: 0; left: 0; right: 0; z-index: 1000; background: #fff; box-shadow: 0 -4px 10px rgba(0,0,0,0.2); padding: 10px;">
          <div class="simple-keyboard"></div>
        </div>

    <div id="previewModal" class="fixed z-50 top-0 left-0 w-full h-full bg-black hidden">
      <div class="w-full h-full relative overflow-hidden" id="modalContent">
        <div id="zoomContainer" class="absolute top-0 left-0 origin-top-left transform">
          <!-- File Content Here -->
        </div>

      <div id="zoomControls">
        <button id="zoomIn" class="bg-white text-black px-3 py-1 rounded shadow">+</button>
        <button id="zoomOut" class="bg-white text-black px-3 py-1 rounded shadow">−</button>
        <button id="resetZoom" class="bg-white text-black px-3 py-1 rounded shadow">Reset</button>
        <button id="closeModal" class="bg-red-600 text-white px-3 py-1 rounded shadow">X</button>
      </div>
      </div>
    </div>

        <div id="idleOverlay" style="display: none; position: fixed; z-index: 99999; top: 0; left: 0; width: 100vw; height: 100vh; background-color: white; justify-content: center; align-items: center;">
        <img src="{{ asset('images/kopapdi.png') }}" alt="Idle Logo" style="max-width: 100vw; max-height: 100vh; object-fit: contain;">
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/css/index.css">
        <script src="https://cdn.jsdelivr.net/npm/simple-keyboard@latest/build/index.js"></script>
@endsection
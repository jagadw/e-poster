@extends('layouts.view')
@section('content')

@php
    $fileUrl = asset('storage/' . $poster->file);
    $extension = strtolower(pathinfo($poster->file, PATHINFO_EXTENSION));
@endphp

<div class="p-4">
    <h2 class="text-center text-2xl font-bold mb-4">Preview Poster</h2>

    @if(in_array($extension, ['jpg', 'jpeg', 'png']))
        <!-- Zoomable Image Container -->
        <div class="relative w-full h-[80vh] mb-4" id="imageContainer">
            <img id="zoomImage" src="{{ $fileUrl }}" alt="Poster" class="absolute align-middle max-w-none" width="100%" height="100%">
        </div>

        <!-- Zoom Controls -->
        <div class="flex justify-center mb-4 relative">
            <button onclick="zoomIn()" class="ml-2 px-3 py-1 bg-[#36ab40] text-white rounded">Zoom In</button>
            <button onclick="zoomOut()" class="ml-2 px-3 py-1 bg-[#36ab40] text-white rounded">Zoom Out</button>
            <button onclick="resetZoom()" class="ml-2 px-3 py-1 bg-[#36ab40] text-white rounded">Reset</button>
        </div>

    @elseif($extension === 'pdf')
        <!-- PDF Preview -->
        <iframe src="{{ $fileUrl }}" width="100%" height="600px" style="border: none;"></iframe>

    @elseif(in_array($extension, ['docx', 'ppt', 'pptx']))
        <!-- Office Preview via Google Docs -->
        <iframe src="https://docs.google.com/gview?url={{ urlencode($fileUrl) }}&embedded=true"
                style="width:100%; height:600px;" frameborder="0"></iframe>

    @else
        <!-- Unknown Format -->
        <p class="text-red-600 text-center">Preview tidak tersedia untuk format ini.</p>
        <div class="text-center mt-4">
            <a href="{{ $fileUrl }}" target="_blank" class="text-[#36ab40] underline">Buka file di tab baru</a>
        </div>
    @endif

    <!-- Back Link -->
    <div class="text-center mt-6">
        <a href="{{ route('AdminPoster.index') }}" class="px-3 py-1 bg-[#36ab40] text-white rounded">Back</a>
    </div>
</div>

<!-- JS: Zoom & Drag -->
@if(in_array($extension, ['jpg', 'jpeg', 'png']))
<script>
    let img = document.getElementById('zoomImage');
    let scale = 1;
    let posX = 0, posY = 0;
    let isDragging = false, startX, startY;

    const updateTransform = () => {
        img.style.transform = `translate(${posX}px, ${posY}px) scale(${scale})`;
    };

    const zoomIn = () => { scale = Math.min(scale + 0.2, 5); updateTransform(); };
    const zoomOut = () => { scale = Math.max(scale - 0.2, 0.5); updateTransform(); };
    const resetZoom = () => { scale = 1; posX = 0; posY = 0; updateTransform(); };

    img.addEventListener('wheel', function(e) {
        e.preventDefault();
        const delta = e.deltaY > 0 ? -0.1 : 0.1;
        scale = Math.min(Math.max(0.5, scale + delta), 5);
        updateTransform();
    });

    img.addEventListener('mousedown', function(e) {
        isDragging = true;
        startX = e.clientX - posX;
        startY = e.clientY - posY;
    });

    window.addEventListener('mousemove', function(e) {
        if (isDragging) {
            posX = e.clientX - startX;
            posY = e.clientY - startY;
            updateTransform();
        }
    });

    window.addEventListener('mouseup', function() {
        isDragging = false;
    });
</script>
@endif

@endsection

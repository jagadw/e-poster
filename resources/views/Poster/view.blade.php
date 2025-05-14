@extends('layouts.app')

@section('content')
<h1 class="text-xl font-semibold mb-4">Viewing Poster {{ \$code }}</h1>
<p>Here would be the full poster content or image.</p>
<a href="{{ route('home') }}" class="text-blue-600 underline">Back to list</a>
@endsection
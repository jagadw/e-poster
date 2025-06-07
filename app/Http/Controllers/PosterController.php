<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $query = Poster::query()->orderBy('code', 'asc');
        $types = Poster::select('type')->distinct()->pluck('type');

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('author')) {
            $query->where('name', 'like', '%' . $request->author . '%');
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('category')) {
            $query->where('type', 'like', '%' . $request->category . '%');
        }

        if ($request->filled('file_type')) {
            $query->where('file', 'like', '%' . $request->file_type . '%');
        }

        $posters = $query->paginate(10)->withQueryString();

        return view('Poster.index', [
            'posters' => $posters,
            'code' => $request->code,
            'author' => $request->author,
            'title' => $request->title,
            'category' => $request->category,
            'file' => $request->file_type,
            'types' => $types
        ]);
    }
    
    public function view(Poster $poster)
    {
        return view('Poster.view', compact('poster'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Poster $poster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Poster $poster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Poster $poster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Poster $poster)
    {
        //
    }
}

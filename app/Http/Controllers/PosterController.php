<?php

namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;

class PosterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'affiliate' => 'nullable',
            'file' => 'required|mimes:pdf|max:2048',
        ]);
    
        $path = $request->file('file')->store('posters', 'public');
    
        $last = Poster::orderBy('code', 'desc')->first();
        $next = $last ? (int) substr($last->code, 2) + 1 : 1;
        $code = 'A-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    
        Poster::create([
            'code' => $code,
            'name' => $request->name,
            'title' => $request->title,
            'affiliate' => $request->affiliate,
            'file' => $path,
        ]);
    
        return redirect()->route('poster.index')->with('success', 'Poster uploaded.');
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

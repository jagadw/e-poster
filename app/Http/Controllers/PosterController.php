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
        $Posters = Poster::orderBy('code', 'desc')->paginate(10);
        
        $code = $request->input('code');
        $author = $request->input('author');
        $file = $request->input('file_type');

        if ($code) {
            $Posters = $Posters->filter(fn($p) =>
                str_contains(strtolower($p['code']), strtolower($code))
            );
        }
    
        if ($author) {
            $Posters = $Posters->filter(fn($p) =>
                str_contains(strtolower($p['name']), strtolower($author))
            );
        }

        if ($file) {
            $Posters = $Posters->filter(fn($p) =>
                str_contains(strtolower($p['file']), strtolower($file))
            );
        }

        return view('Poster.index', compact('Posters', 'code', 'author', 'file'));
    }
    
    public function view($code)
    {
        return view('Poster.index', compact('Posters'));
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

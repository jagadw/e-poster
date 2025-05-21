<?php
namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPosterController extends Controller
{
    public function index(Request $request)
    {
        $posters = Poster::orderBy('code', 'desc')->paginate(10);
        
        $code = $request->input('code');
        $author = $request->input('author');
        $title = $request->input('title');
        $category = $request->input('category');
        $file = $request->input('file_type');

        if ($code) {
            $posters = $posters->filter(fn($p) =>
                str_contains(strtolower($p['code']), strtolower($code))
            );
        }
    
        if ($author) {
            $posters = $posters->filter(fn($p) =>
                str_contains(strtolower($p['name']), strtolower($author))
            );
        }

        if ($title) {
            $posters = $posters->filter(fn($p) =>
                str_contains(strtolower($p['title']), strtolower($title))
            );
        }

        if ($category) {
            $posters = $posters->filter(fn($p) =>
                str_contains(strtolower($p['code']), strtolower($category))
            );
        }

        if ($file) {
            $posters = $posters->filter(fn($p) =>
                str_contains(strtolower($p['file']), strtolower($file))
            );
        }

        return view('AdminPoster.index', compact('posters', 'code', 'author', 'title', 'category', 'file'));
    }

    public function create()
    {
        return view('AdminPoster.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'affiliate' => 'nullable',
            'file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $last = Poster::orderBy('code', 'desc')->first();
        $nextNumber = $last ? intval(substr($last->code, 2)) + 1 : 1;
        $category = $request->category;
        $code = $category . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $path = $request->file('file')->store('posters', 'public');

        Poster::create([
            'code' => $code,
            'name' => $request->name,
            'title' => $request->title,
            'affiliate' => $request->affiliate,
            'file' => $path,
        ]);

        return redirect()->route('AdminPoster.index')->with('success', 'Poster created successfully.');
    }

    public function view(Poster $poster)
    {
        return view('AdminPoster.view', compact('poster'));
    }

    public function edit(Poster $AdminPoster)
    {
        return view('AdminPoster.edit', ['poster' => $AdminPoster]);
    }
    
    public function update(Request $request, Poster $AdminPoster)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'affiliate' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx,ppt|max:10240',
        ]);
    
        $data = $request->only('name', 'title', 'affiliate');
    
        if ($request->hasFile('file')) {
            if ($AdminPoster->file) {
                Storage::disk('public')->delete($AdminPoster->file);
            }
            $data['file'] = $request->file('file')->store('posters', 'public');
        }
    
        $AdminPoster->update($data);
    
        return redirect()->route('AdminPoster.index')->with('success', 'Poster updated successfully.');
    }
    
    public function destroy(Poster $AdminPoster)
    {
        if ($AdminPoster->file) {
            Storage::disk('public')->delete($AdminPoster->file);
        }

        $AdminPoster->delete();

        return redirect()->route('AdminPoster.index')->with('success', 'Poster deleted.');
    }
}

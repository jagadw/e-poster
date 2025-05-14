<?php
namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class adminPosterController extends Controller
{
    public function index()
    {
        $posters = Poster::latest()->paginate(10);
        return view('adminPoster.index', compact('posters'));
    }

    public function create()
    {
        return view('adminPoster.create');
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
        $code = 'A-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        $path = $request->file('file')->store('posters', 'public');

        Poster::create([
            'code' => $code,
            'name' => $request->name,
            'title' => $request->title,
            'affiliate' => $request->affiliate,
            'file' => $path,
        ]);

        return redirect()->route('adminPoster.index')->with('success', 'Poster created successfully.');
    }

    public function show(Poster $poster)
    {
        return view('posters.show', compact('poster'));
    }

    public function edit(Poster $poster)
    {
        return view('adminPoster.edit', compact('poster'));
    }

    public function update(Request $request, Poster $poster)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'affiliate' => 'nullable',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data = $request->only('name', 'title', 'affiliate');

        if ($request->hasFile('file')) {
            if ($poster->file) {
                Storage::disk('public')->delete($poster->file);
            }
            $data['file'] = $request->file('file')->store('posters', 'public');
        }

        $poster->update($data);

        return redirect()->route('adminPoster.index')->with('success', 'Poster updated successfully.');
    }

    public function destroy(Poster $poster)
    {
        if ($poster->file) {
            Storage::disk('public')->delete($poster->file);
        }

        $poster->delete();

        return redirect()->route('adminPoster.index')->with('success', 'Poster deleted.');
    }
}

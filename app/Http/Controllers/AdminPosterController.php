<?php
namespace App\Http\Controllers;

use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPosterController extends Controller
{
    public function index(Request $request)
    {
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

        return view('AdminPoster.index', [
            'posters' => $posters,
            'code' => $request->code,
            'author' => $request->author,
            'title' => $request->title,
            'category' => $request->category,
            'file' => $request->file_type,
            'types' => $types
        ]);
    }

    public function create()
    {
        return view('AdminPoster.create');
    }

    public function store(Request $request)
    {
        try {
        $request->validate([
            // 'category'  => 'required|string',
            'name'      => 'required|string',
            'title'     => 'required|string',
            'email'     => 'required|string',
            'type'      => 'required|string',
            'affiliate' => 'nullable|string',
            'file'      => 'required|file|mimes:pdf,docx,pptx,jpg,jpeg,png|max:20480',
        ]);
    
        // Before
        // $category = strtoupper($request->category);
        $category = "EP";

        $last = Poster::where('code', 'like', "$category-%")
                      ->orderBy('code', 'desc')
                      ->first();
    
        if ($last && preg_match('/^' . $category . '-(\d{4})$/', $last->code, $m)) {
            $next = intval($m[1]) + 1;
        } else {
            $next = 1;
        }
    
        $code = $category . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
        $path = $request->file('file')->store('posters', 'public');
    
        Poster::create([
            'code'      => $code,
            'name'      => $request->name,
            'title'     => $request->title,
            'email' => $request->email,
            'type' => $request->type,
            'affiliate' => $request->affiliate,
            'file'      => $path,
        ]);
    
        return redirect()->route('AdminPoster.index')
                         ->with('success', "Poster {$code} created successfully.");
        } catch (\Exception $e) {
          return redirect()->back()->with('error', 'ERROR: ' . $e->getMessage());
        }                
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
        try {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'email'     => 'required|string',
            'type'      => 'required|string',
            'affiliate' => 'nullable',
            'file' => 'nullable|file|mimes:pdf,docx,pptx,jpg,jpeg,png|max:20480',
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
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR: ' . $e->getMessage());
        }
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

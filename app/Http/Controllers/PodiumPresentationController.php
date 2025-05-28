<?php

namespace App\Http\Controllers;

use App\Models\PodiumPresentation;
use App\Models\Poster;
use Illuminate\Http\Request;

class PodiumPresentationController extends Controller
{

    public function index(Request $request)
    {
        $query = PodiumPresentation::query();

        if ($request->filled('code')) {
            $query->where('code', 'like', '%' . $request->code . '%');
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        if ($request->filled('author')) {
            $query->where('name', 'like', '%' . $request->author . '%');
        }

        $presentations = $query->paginate(10)->withQueryString();
        return view('presentations.index', compact('presentations'));
    }

    public function create()
    {
        $posters = Poster::all();
        $usedCodes = PodiumPresentation::pluck('code')->toArray();
    
        return view('presentations.create', compact('posters', 'usedCodes'));
    }    

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:podium_presentations,code',
            'name' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required',
        ]);

        PodiumPresentation::create($request->all());
        return redirect()->route('presentations.index')->with('success', 'Presentation created successfully.');
    }

    public function edit(PodiumPresentation $presentation)
    {
        $posters = Poster::all();
        return view('presentations.edit', compact('presentation', 'posters'));
    }

    public function update(Request $request, PodiumPresentation $presentation)
    {
        $request->validate([
            'code' => 'required|unique:podium_presentations,code,' . $presentation->id,
            'name' => 'required',
            'title' => 'required',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required',
        ]);

        $presentation->update($request->all());
        return redirect()->route('presentations.index')->with('success', 'Presentation updated successfully.');
    }

    public function destroy(PodiumPresentation $presentation)
    {
        $presentation->delete();
        return redirect()->route('presentations.index')->with('success', 'Presentation deleted successfully.');
    }
}

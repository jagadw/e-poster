<?php

namespace App\Http\Controllers;

use App\Models\PodiumPresentation;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PodiumPresentationController extends Controller
{

    public function index(Request $request)
    {
        $query = DB::table('podium_presentations')
        ->join('posters', 'podium_presentations.code', '=', 'posters.code')
        ->select(
            'podium_presentations.id',
            'podium_presentations.code',
            'posters.name',
            'posters.title',
            'podium_presentations.date',
            'podium_presentations.time_start',
            'podium_presentations.time_end',
            'podium_presentations.room'
        );

    if ($request->filled('code')) {
        $query->where('podium_presentations.code', 'like', '%' . $request->code . '%');
    }

    if ($request->filled('title')) {
        $query->where('posters.title', 'like', '%' . $request->title . '%');
    }

    if ($request->filled('author')) {
        $query->where('posters.name', 'like', '%' . $request->author . '%');
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
        try {
        $request->validate([
            'code' => 'required|unique:podium_presentations,code',
            // 'name' => 'required',
            // 'title' => 'required',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required',
        ]);

        PodiumPresentation::create($request->all());
        return redirect()->route('presentations.index')->with('success', 'Presentation created successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR : Failed to add schedule, Please try again.');
        }                

    }

    public function edit(PodiumPresentation $presentation)
    {
        $posters = Poster::whereIn('code', PodiumPresentation::pluck('code'))->get();
        $posterDetail = Poster::where('code', $presentation->code)->first();
    
        return view('presentations.edit', compact('presentation', 'posters', 'posterDetail'));
    }
    
    public function update(Request $request, PodiumPresentation $presentation)
    {
        try {
        $request->validate([
            'code' => 'required|unique:podium_presentations,code,' . $presentation->id,
            // 'name' => 'required',
            // 'title' => 'required',
            'date' => 'required|date',
            'time_start' => 'required',
            'time_end' => 'required',
            'room' => 'required',
        ]);

        $presentation->update($request->all());
        return redirect()->route('presentations.index')->with('success', 'Presentation updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'ERROR : Failed to update schedule, Please try again.');
        }                
    }

    public function destroy(PodiumPresentation $presentation)
    {
        $presentation->delete();
        return redirect()->route('presentations.index')->with('success', 'Presentation deleted successfully.');
    }
}

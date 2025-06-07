<?php

namespace App\Http\Controllers;

use App\Models\PodiumPresentation;
use App\Models\Poster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestPresentationController extends Controller
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

    return view('GuestPresentation.index', compact('presentations'));

    }

}

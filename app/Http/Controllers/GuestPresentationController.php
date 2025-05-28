<?php

namespace App\Http\Controllers;

use App\Models\PodiumPresentation;
use App\Models\Poster;
use Illuminate\Http\Request;

class GuestPresentationController extends Controller
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
        return view('GuestPresentation.index', compact('presentations'));
    }

}

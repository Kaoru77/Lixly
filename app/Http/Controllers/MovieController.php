<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $movies = Movie::query()
            ->search($request->string('search')->toString() ?: null)
            ->genre($request->string('genre')->toString() ?: null)
            ->get();

        return view('index', compact('movies'));
    }

    public function show(int $id)
    {
        $movie = Movie::findOrFail($id);

        return view('detail', compact('movie'));
    }
}

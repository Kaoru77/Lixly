<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:100'],
        ]);

        $query = Movie::query();

        $search = trim((string) ($filters['search'] ?? ''));
        if ($search !== '') {
            $query->where('title', 'like', '%'.$search.'%');
        }

        $genre = trim((string) ($filters['genre'] ?? ''));
        if ($genre !== '') {
            $query->where('genre', $genre);
        }

        $movies = $query->get();

        return view('index', compact('movies'));
    }

    public function show(int $id)
    {
        $movie = Movie::findOrFail($id);

        return view('detail', compact('movie'));
    }
}

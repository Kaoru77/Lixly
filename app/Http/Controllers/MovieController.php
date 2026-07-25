<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:255'],
            'genre' => ['nullable', 'string', 'max:255'],
        ]);

        // Membuat query dasar mengambil Film
        $query = Movie::query();

        // Fitur 1: Jika user mengetik kolom pencarian
        if (! empty($validated['search'])) {
            $query->where('title', 'like', '%' . $validated['search'] . '%');
        }

        // Fitur 2: Jika user memilih filter genre
        if (! empty($validated['genre'])) {
            $query->where('genre', $validated['genre']);
        }

        // Mengambil hasil akhirnya
        $movies = $query->get();

        return view('index', compact('movies'));
    }

    public function show(int $id)
    {
        $movie = Movie::findOrFail($id);
        return view('detail', compact('movie'));
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Wishlist;

class WatchlistController extends Controller
{
    public function index()
    {
        $movies = Movie::inWatchlist()->get();

        return view('watchlist', compact('movies'));
    }

    public function store(int $id)
    {
        if (Wishlist::where('movie_id', $id)->exists()) {
            return back()->with('info', 'Film sudah ada di Watchlist kamu.');
        }

        Wishlist::create(['movie_id' => $id]);

        return back()->with('success', 'Film berhasil ditambahkan ke Watchlist!');
    }

    public function destroy(int $id)
    {
        Wishlist::where('movie_id', $id)->delete();

        return back()->with('success', 'Film berhasil dihapus dari Watchlist!');
    }
}

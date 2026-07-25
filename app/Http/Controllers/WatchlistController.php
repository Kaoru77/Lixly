<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class WatchlistController extends Controller
{
    public function index()
    {
        $movies = Movie::whereIn('id', function ($query) {
            $query->select('movie_id')->from('wishlists');
        })->get();

        return view('watchlist', compact('movies'));
    }

    public function store(int $id)
    {
        // Without this check the foreign key on wishlists.movie_id fails with a
        // raw database error instead of a meaningful response.
        if (! Movie::whereKey($id)->exists()) {
            abort(404);
        }

        if (DB::table('wishlists')->where('movie_id', $id)->exists()) {
            return redirect()->back()->with('info', 'Film sudah ada di Watchlist kamu.');
        }

        try {
            DB::table('wishlists')->insert([
                'movie_id' => $id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } catch (QueryException $e) {
            report($e);

            return redirect()->back()->with('error', 'Gagal menambahkan film ke Watchlist. Silakan coba lagi.');
        }

        return redirect()->back()->with('success', 'Film berhasil ditambahkan ke Watchlist!');
    }

    public function destroy(int $id)
    {
        try {
            $deleted = DB::table('wishlists')->where('movie_id', $id)->delete();
        } catch (QueryException $e) {
            report($e);

            return redirect()->back()->with('error', 'Gagal menghapus film dari Watchlist. Silakan coba lagi.');
        }

        if ($deleted === 0) {
            return redirect()->back()->with('info', 'Film tidak ada di Watchlist kamu.');
        }

        return redirect()->back()->with('success', 'Film berhasil dihapus dari Watchlist!');
    }
}

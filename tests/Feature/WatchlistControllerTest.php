<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WatchlistControllerTest extends TestCase
{
    use RefreshDatabase;

    private function movie(string $title): Movie
    {
        return Movie::create([
            'title' => $title,
            'genre' => 'Drama',
            'overview' => $title.' overview',
            'rating' => 7.0,
        ]);
    }

    public function test_index_only_lists_movies_in_the_watchlist(): void
    {
        $saved = $this->movie('Laskar Pelangi');
        $this->movie('Pengabdi Setan');
        DB::table('wishlists')->insert([
            'movie_id' => $saved->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $response = $this->get(route('watchlist.index'));

        $response->assertOk()->assertViewIs('watchlist');
        $this->assertSame(['Laskar Pelangi'], $response->viewData('movies')->pluck('title')->all());
    }

    public function test_store_adds_a_movie_to_the_watchlist(): void
    {
        $movie = $this->movie('Laskar Pelangi');

        $response = $this->from(route('movie.index'))->post(route('watchlist.store', $movie->id));

        $response->assertRedirect(route('movie.index'))->assertSessionHas('success');
        $this->assertDatabaseHas('wishlists', ['movie_id' => $movie->id]);
    }

    public function test_store_does_not_duplicate_an_existing_entry(): void
    {
        $movie = $this->movie('Laskar Pelangi');
        $this->post(route('watchlist.store', $movie->id));

        $response = $this->from(route('movie.index'))->post(route('watchlist.store', $movie->id));

        $response->assertRedirect(route('movie.index'))
            ->assertSessionHas('info')
            ->assertSessionMissing('success');
        $this->assertSame(1, DB::table('wishlists')->where('movie_id', $movie->id)->count());
    }

    public function test_destroy_removes_the_movie_from_the_watchlist(): void
    {
        $movie = $this->movie('Laskar Pelangi');
        $this->post(route('watchlist.store', $movie->id));

        $response = $this->from(route('watchlist.index'))->delete(route('watchlist.destroy', $movie->id));

        $response->assertRedirect(route('watchlist.index'))->assertSessionHas('success');
        $this->assertDatabaseMissing('wishlists', ['movie_id' => $movie->id]);
    }

    public function test_destroy_is_a_no_op_for_a_movie_that_is_not_saved(): void
    {
        $movie = $this->movie('Laskar Pelangi');

        $response = $this->from(route('watchlist.index'))->delete(route('watchlist.destroy', $movie->id));

        $response->assertRedirect(route('watchlist.index'))->assertSessionHas('success');
        $this->assertSame(0, DB::table('wishlists')->count());
    }
}

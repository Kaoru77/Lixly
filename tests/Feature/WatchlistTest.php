<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class WatchlistTest extends TestCase
{
    use RefreshDatabase;

    private function movie(): Movie
    {
        return Movie::create([
            'title' => 'Test Movie',
            'genre' => 'Action',
            'overview' => 'Overview',
            'poster_url' => 'img/test.jpg',
            'rating' => 8.0,
            'release_date' => '2024',
        ]);
    }

    public function test_it_adds_a_movie_to_the_watchlist(): void
    {
        $movie = $this->movie();

        $this->post(route('watchlist.store', $movie->id))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseHas('wishlists', ['movie_id' => $movie->id]);
    }

    public function test_it_returns_404_when_adding_an_unknown_movie(): void
    {
        $this->post(route('watchlist.store', 999))->assertNotFound();

        $this->assertDatabaseCount('wishlists', 0);
    }

    public function test_it_reports_when_the_movie_is_already_on_the_watchlist(): void
    {
        $movie = $this->movie();
        DB::table('wishlists')->insert([
            'movie_id' => $movie->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->post(route('watchlist.store', $movie->id))
            ->assertRedirect()
            ->assertSessionHas('info');
    }

    public function test_it_removes_a_movie_from_the_watchlist(): void
    {
        $movie = $this->movie();
        DB::table('wishlists')->insert([
            'movie_id' => $movie->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->delete(route('watchlist.destroy', $movie->id))
            ->assertRedirect()
            ->assertSessionHas('success');

        $this->assertDatabaseCount('wishlists', 0);
    }

    public function test_it_does_not_report_success_when_nothing_was_removed(): void
    {
        $movie = $this->movie();

        $this->delete(route('watchlist.destroy', $movie->id))
            ->assertRedirect()
            ->assertSessionMissing('success')
            ->assertSessionHas('info');
    }
}

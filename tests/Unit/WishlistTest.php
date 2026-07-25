<?php

namespace Tests\Unit;

use App\Models\Movie;
use App\Models\Wishlist;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WishlistTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uses_the_wishlists_table(): void
    {
        $this->assertSame('wishlists', (new Wishlist)->getTable());
    }

    public function test_it_persists_a_movie_reference(): void
    {
        $movie = Movie::create([
            'title' => 'Laskar Pelangi',
            'genre' => 'Drama',
            'overview' => 'Schoolchildren on Belitung.',
        ]);

        $wishlist = new Wishlist;
        $wishlist->movie_id = $movie->id;
        $wishlist->save();

        $this->assertDatabaseHas('wishlists', ['movie_id' => $movie->id]);
        $this->assertNull($wishlist->fresh()->user_id);
    }
}

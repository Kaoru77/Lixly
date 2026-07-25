<?php

namespace Tests\Unit;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_uses_the_movies_table(): void
    {
        $this->assertSame('movies', (new Movie)->getTable());
    }

    public function test_all_attributes_are_mass_assignable(): void
    {
        $movie = Movie::create([
            'title' => 'Pengabdi Setan',
            'genre' => 'Horror',
            'overview' => 'A family haunted by their late mother.',
            'poster_url' => 'images/poster.jpg',
            'backdrop_url' => 'images/backdrop.jpg',
            'rating' => 8.5,
            'release_date' => '2017',
            'director' => 'Joko Anwar',
            'duration' => '107 min',
        ]);

        $this->assertTrue($movie->exists);
        $this->assertSame('Pengabdi Setan', $movie->fresh()->title);
        $this->assertSame('Joko Anwar', $movie->fresh()->director);
        $this->assertEqualsWithDelta(8.5, $movie->fresh()->rating, 0.001);
    }

    public function test_rating_defaults_to_zero_and_optional_columns_are_nullable(): void
    {
        $movie = Movie::create([
            'title' => 'Untitled',
            'genre' => 'Drama',
            'overview' => 'No extras provided.',
        ])->fresh();

        $this->assertEqualsWithDelta(0.0, $movie->rating, 0.001);
        $this->assertNull($movie->poster_url);
        $this->assertNull($movie->release_date);
        $this->assertNull($movie->director);
    }

    public function test_it_records_timestamps(): void
    {
        $movie = Movie::create([
            'title' => 'Timestamped',
            'genre' => 'Action',
            'overview' => 'Has timestamps.',
        ]);

        $this->assertNotNull($movie->created_at);
        $this->assertNotNull($movie->updated_at);
    }
}

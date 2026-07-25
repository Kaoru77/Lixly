<?php

namespace Tests\Feature;

use App\Models\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    private function movie(string $title, string $genre = 'Drama'): Movie
    {
        return Movie::create([
            'title' => $title,
            'genre' => $genre,
            'overview' => $title.' overview',
            'rating' => 7.0,
        ]);
    }

    public function test_index_lists_all_movies(): void
    {
        $this->movie('Pengabdi Setan', 'Horror');
        $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.index'));

        $response->assertOk()->assertViewIs('index');
        $this->assertEqualsCanonicalizing(
            ['Pengabdi Setan', 'Laskar Pelangi'],
            $response->viewData('movies')->pluck('title')->all()
        );
    }

    public function test_index_filters_by_partial_title_search(): void
    {
        $this->movie('Pengabdi Setan', 'Horror');
        $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.index', ['search' => 'setan']));

        $response->assertOk();
        $this->assertSame(['Pengabdi Setan'], $response->viewData('movies')->pluck('title')->all());
    }

    public function test_index_ignores_an_empty_search(): void
    {
        $this->movie('Pengabdi Setan', 'Horror');
        $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.index', ['search' => '']));

        $response->assertOk();
        $this->assertCount(2, $response->viewData('movies'));
    }

    public function test_index_filters_by_exact_genre(): void
    {
        $this->movie('Pengabdi Setan', 'Horror');
        $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.index', ['genre' => 'Horror']));

        $response->assertOk();
        $this->assertSame(['Pengabdi Setan'], $response->viewData('movies')->pluck('title')->all());
    }

    public function test_index_combines_search_and_genre_filters(): void
    {
        $this->movie('Pengabdi Setan', 'Horror');
        $this->movie('Pengabdi Drama', 'Drama');

        $response = $this->get(route('movie.index', ['search' => 'Pengabdi', 'genre' => 'Drama']));

        $response->assertOk();
        $this->assertSame(['Pengabdi Drama'], $response->viewData('movies')->pluck('title')->all());
    }

    public function test_index_returns_no_movies_when_nothing_matches(): void
    {
        $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.index', ['search' => 'nonexistent']));

        $response->assertOk();
        $this->assertCount(0, $response->viewData('movies'));
    }

    public function test_show_returns_the_requested_movie(): void
    {
        $movie = $this->movie('Laskar Pelangi');

        $response = $this->get(route('movie.show', $movie->id));

        $response->assertOk()->assertViewIs('detail');
        $this->assertTrue($movie->is($response->viewData('movie')));
    }

    public function test_show_returns_404_for_an_unknown_movie(): void
    {
        $this->get(route('movie.show', 999))->assertNotFound();
    }
}

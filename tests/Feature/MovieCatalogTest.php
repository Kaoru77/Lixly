<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieCatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_shows_the_catalog(): void
    {
        $this->get(route('movie.index'))->assertOk();
    }

    public function test_it_rejects_a_non_string_search_filter(): void
    {
        $this->get('/?search[]=foo')
            ->assertRedirect()
            ->assertSessionHasErrors('search');
    }

    public function test_it_returns_404_for_an_unknown_movie(): void
    {
        $this->get(route('movie.show', 999))->assertNotFound();
    }
}

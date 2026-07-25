<?php

namespace App\Providers;

use App\Models\Movie;
use App\Models\Wishlist;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('partials.navbar', function ($view) {
            $view->with('watchlistCount', Wishlist::count());
        });

        View::composer('partials.nav-tools', function ($view) {
            $view->with('genres', Movie::GENRES);
        });
    }
}

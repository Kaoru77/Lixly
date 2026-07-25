<?php

namespace App\Providers;

use App\Models\Wishlist;
use Illuminate\Database\QueryException;
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
        View::composer(['layouts.app', 'layouts.nav'], function ($view) {
            try {
                $wlCount = Wishlist::count();
            } catch (QueryException $e) {
                // The badge is decorative: log the failure and keep rendering
                // the page instead of breaking every layout that uses it.
                report($e);
                $wlCount = 0;
            }

            $view->with('wlCount', $wlCount);
        });
    }
}

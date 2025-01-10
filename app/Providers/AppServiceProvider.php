<?php

namespace App\Providers;

use App\Models\Hero;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;

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
        //
        Paginator::useBootstrap(); // Untuk Bootstrap

        View::composer('*', function ($view) {
            $heroes = Hero::latest()->take(5)->get();
            $view->with('heroes', $heroes);
        });
    }
}

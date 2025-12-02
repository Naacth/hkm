<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Kontak;

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
        // Share contact data with all views
        View::composer('*', function ($view) {
            $kontak = Kontak::latest()->first();
            $view->with('footerKontak', $kontak);
        });
    }
}

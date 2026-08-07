<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// observer removed: PenilaianObserver not registered

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
        // Penilaian observer unregistered to keep certificate generation manual for Admin
    }
}

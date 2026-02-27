<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Blade;

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
        Blade::directive('maskid', function ($expression) {
            return "<?php
                if (strlen($expression) === 16) {
                    echo substr($expression, 0, 3) . str_repeat('*', 10) . substr($expression, -3);
                } else {
                    echo $expression; // Fallback for IDs that are not 16 digits long
                }
            ?>";
        });
    }
}

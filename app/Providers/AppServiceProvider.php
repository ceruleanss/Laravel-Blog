<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        // Strict Architectural Rule 2: Prevent N+1 queries during development
        Model::preventLazyLoading(! app()->isProduction());

        // Ensure all generated asset and route URLs use HTTPS in production or behind reverse proxies
        if (str_starts_with(config('app.url'), 'https://') || app()->isProduction() || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}

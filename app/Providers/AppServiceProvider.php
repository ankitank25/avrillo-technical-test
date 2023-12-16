<?php

namespace App\Providers;

use App\Services\Drivers\Kanye;
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
        $this->app->singleton('quote_manager', function ($app) {
            return new \App\Services\QuoteManager($app);
        });

        $quoteManager = app('quote_manager');
        $quoteManager->extend('kanye', function($app) {
            return new Kanye($app);
        });
    }
}

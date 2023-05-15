<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\StoriesService;
use Illuminate\Contracts\Foundation\Application;

class StoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StoriesService::class, function (Application $app) {
            return new StoriesService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
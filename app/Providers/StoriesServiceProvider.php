<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\StoryService;
use Illuminate\Contracts\Foundation\Application;

class StoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(StoryService::class, function (Application $app) {
            return new StoryService();
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
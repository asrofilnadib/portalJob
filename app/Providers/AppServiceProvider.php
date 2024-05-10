<?php

namespace App\Providers;

use App\Models\Listing;
use App\Post\JobPost;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(JobPost::class, function ($app) {
          return new JobPost($app->make(Listing::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interfaces\CompanyRepositoryInterface::class, \App\Repositories\CompanyRepository::class);
        $this->app->bind(\App\Interfaces\StationRepositoryInterface::class, \App\Repositories\StationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}

<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Dao Registration
        $this->app->bind('App\Contracts\Dao\Rider\RiderDaoInterface', 'App\Dao\Rider\RiderDao');

        // Business logic registration
        $this->app->bind('App\Contracts\Services\Rider\RiderServiceInterface', 'App\Services\Rider\RiderService');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

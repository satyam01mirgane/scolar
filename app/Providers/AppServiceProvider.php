<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Fideloper\Proxy\TrustProxies;
use Illuminate\Support\Facades\Schema;
use Illuminate\Contracts\Config\Repository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind TrustProxies with the correct dependency
     
            $this->app->singleton(TrustProxies::class, function ($app) {
                return new TrustProxies($app->make(Repository::class));
            
        });
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

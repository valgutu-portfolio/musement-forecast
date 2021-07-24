<?php

namespace App\Providers;

use App\Repositories\CityRepository;
use App\Repositories\ForecastRepository;
use App\Repositories\Interfaces\ICityRepository;
use App\Repositories\Interfaces\IForecastRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ICityRepository::class, CityRepository::class);
        $this->app->bind(IForecastRepository::class, ForecastRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

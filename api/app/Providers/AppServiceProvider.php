<?php

namespace App\Providers;

use App\Interfaces\CacheInterface;
use App\Interfaces\PaginateInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WeatherInterface;
use App\Interfaces\WeatherServiceInterface;
use App\Repositories\CacheRepository;
use App\Repositories\PaginateRepository;
use App\Repositories\UserRepository;
use App\Repositories\WeatherRepository;
use App\Services\WeatherService;
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
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(WeatherInterface::class, WeatherRepository::class);
        $this->app->bind(CacheInterface::class, CacheRepository::class);
        $this->app->bind(PaginateInterface::class, PaginateRepository::class);
        $this->app->bind(WeatherServiceInterface::class, WeatherService::class);
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

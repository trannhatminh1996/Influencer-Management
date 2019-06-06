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
        $this->app->bind(
            'App\Infrastructure\Repositories\InfluencerRepositoryContract',
            'App\Infrastructure\Repositories\InfluencerRepository'
        );
        $this->app->bind(
            'App\Infrastructure\Repositories\BaseRepositoryContract',
            'App\Infrastructure\Repositories\BaseRepository'
        );
        $this->app->bind(
            'App\Domain\Services\InfluencerServiceContract',
            'App\Domain\Services\InfluencerService'
        );
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

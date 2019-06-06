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
            'App\Infrastructure\Repositories\M001InfluencerRepositoryContract',
            'App\Infrastructure\Repositories\M001InfluencerRepository'
        );
        $this->app->bind(
            'App\Infrastructure\Repositories\M003JobRepositoryContract',
            'App\Infrastructure\Repositories\M003JobRepository'
        );
        $this->app->bind(
            'App\Infrastructure\Repositories\M004PostRepositoryContract',
            'App\Infrastructure\Repositories\M004PostRepository'
        );
        $this->app->bind(
            'App\Infrastructure\Repositories\M006InfluencerJobRepositoryContract',
            'App\Infrastructure\Repositories\M006InfluencerJobRepository'
        );
        $this->app->bind(
            'App\Infrastructure\Repositories\M007InfluencerMediaLinkRepositoryContract',
            'App\Infrastructure\Repositories\M007InfluencerMediaLinkRepository'
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

<?php namespace Avosalmon\Infrastructure\Store;

use Illuminate\Support\ServiceProvider;
use Avosalmon\Infrastructure\Store\Sprints\Sprints;
use Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent;

class StoreServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Avosalmon\Infrastructure\Store\Sprints\SprintsInterface', function () {
            return new Sprints(
                new SprintsEloquent
            );
        });
    }
}

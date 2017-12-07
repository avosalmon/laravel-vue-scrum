<?php namespace Avosalmon\Infrastructure\Store;

use Illuminate\Support\ServiceProvider;
use Avosalmon\Infrastructure\Store\Sprints\Sprints;
use Avosalmon\Infrastructure\Store\Sprints\SprintProjects;
use Avosalmon\Infrastructure\Store\Sprints\SprintUsers;
use Avosalmon\Infrastructure\Store\Sprints\SprintsEloquent;
use Avosalmon\Infrastructure\Store\Users\Users;
use Avosalmon\Infrastructure\Store\Users\UsersEloquent;

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

        $this->app->bind('Avosalmon\Infrastructure\Store\Sprints\SprintProjectsInterface', function () {
            return new SprintProjects(
                new SprintsEloquent,
                app('db')
            );
        });

        $this->app->bind('Avosalmon\Infrastructure\Store\Sprints\SprintUsersInterface', function () {
            return new SprintUsers(
                new SprintsEloquent,
                app('db')
            );
        });

        $this->app->bind('Avosalmon\Infrastructure\Store\Users\UsersInterface', function () {
            return new Users(
                new UsersEloquent
            );
        });
    }
}

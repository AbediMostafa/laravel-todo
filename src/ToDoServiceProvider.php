<?php

namespace AbediMostafa\ToDo;

use AbediMostafa\ToDo\http\Middleware\BearerAuthorization;
use Illuminate\Support\Facades\File;
use \Illuminate\Support\ServiceProvider;

class ToDoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViewsFrom(__DIR__ . '/views', 'todo');

        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/todo'),
        ], 'todo-app');

    }

    public function register()
    {
       // register BearerAuthorization middleware
        app('router')->aliasMiddleware('auth.bearer', BearerAuthorization::class);

        // require helper function file
        if (File::exists(__DIR__ . '\http\helpers.php')) {
            require __DIR__ . '\http\helpers.php';
        }
    }

}

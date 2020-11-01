<?php

namespace App\Providers;

use App\Repositories\TweetRepositoryEloquent;
use App\Repositories\UserRepositoryEloquent;
use App\Services\TweetService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
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
        $this->app->bind(TweetService::class, function($app)
        {
            return new TweetService($app[TweetRepositoryEloquent::class], $app[UserRepositoryEloquent::class]);
        });
    }
}

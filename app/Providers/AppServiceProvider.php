<?php

namespace App\Providers;

use App\Channels\DatabaseChannel;
use App\Notifications\DatabaseNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\Channels\DatabaseChannel as IlluminateDatabaseChannel;
use Illuminate\Notifications\DatabaseNotification as BaseNotification;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // $this->app->instance(IlluminateDatabaseChannel::class, new DatabaseChannel());
        // $this->app->instance(BaseNotification::class, new DatabaseNotification());
    }
}

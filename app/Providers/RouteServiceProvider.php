<?php

namespace App\Providers;

use App\Http\Controllers\NotificationController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });



        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware([
                'web',
                'auth:sanctum',
                config('jetstream.auth_session'),
                'verified',
            ])->group(function () {
                Route::middleware(['role:vendor'])->prefix('vendor')
                    ->group(base_path('routes/vendor.php'));
                Route::middleware(['role:customer'])->group(base_path('routes/customer.php'));
                Route::middleware(['role:delivery-person'])->prefix('delivery-person')->group(base_path('routes/delivery-person.php'));
                Route::resource('notifications', NotificationController::class);
            });

            // Route::middleware(['role:vendor'])->prefix('vendor')
            //     ->group(base_path('routes/vendor.php'));
        });
    }
}

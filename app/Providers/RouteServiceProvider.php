<?php

namespace App\Providers;

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
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            // Web Profile Routes (www.pos-system.test and pos-system.test)
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // POS System Routes (client.pos-system.test)
            Route::middleware('web')
                ->domain('client.pos-system.test')
                ->group(base_path('routes/client.php'));

            // Management System Routes (manage.pos-system.test)
            Route::middleware('web')
                ->domain('manage.pos-system.test')
                ->group(base_path('routes/manage.php'));

            // API Routes
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
        });
    }
} 
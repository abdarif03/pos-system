<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;

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
        $host = Request::getHost();
        if (str_starts_with($host, 'client.')) {
            Config::set('session.cookie', env('SESSION_COOKIE_CLIENT', 'client_session'));
        } elseif (str_starts_with($host, 'manage.')) {
            Config::set('session.cookie', env('SESSION_COOKIE_MANAGE', 'manage_session'));
        }
    }
}

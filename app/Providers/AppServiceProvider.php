<?php

namespace App\Providers;

use App\Support\SubscriptionBilling;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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

        View::composer(['layouts.navbar', 'dashboard'], function ($view) {
            $canAccessPosFeatures = false;
            if (Auth::check()) {
                $canAccessPosFeatures = SubscriptionBilling::canAccessPosFeatures(Auth::user());
            }
            $view->with('canAccessPosFeatures', $canAccessPosFeatures);
        });
    }
}

<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        
        // Remove problematic middleware - use simpler approach
        // Authentication will be handled by route-level middleware
        
        // Configure auth middleware to redirect to login only for client domain
        // This will be handled in the routes instead of globally
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

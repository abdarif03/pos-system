<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DomainRedirectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->getHost();
        
        // For www.pos-system.test and pos-system.test, ensure no authentication redirects
        if (in_array($host, ['www.pos-system.test', 'pos-system.test'])) {
            // These domains should serve web profile content without authentication
            // No additional processing needed
        }
        
        // For client.pos-system.test, authentication is handled by route-level middleware
        if ($host === 'client.pos-system.test') {
            // Authentication is handled by 'auth' middleware in routes
            // No additional processing needed
        }
        
        return $next($request);
    }
} 
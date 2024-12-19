<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContentSecurityPolicy
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $csp = "default-src 'self'; ".
               "img-src 'self' data: https://ui-avatars.com; ".
               "style-src 'self' 'unsafe-inline' https://fonts.bunny.net; ".
               "font-src 'self' https://fonts.bunny.net; ".
               "script-src 'self' 'unsafe-eval' 'unsafe-inline'; ".
               "object-src 'none';";

        // Special CSP for Horizon
        if ($request->is('horizon*')) {
            $csp = "default-src 'self'; ".
                   "img-src 'self' data: https://ui-avatars.com; ".
                   "style-src 'self' 'unsafe-inline' https://fonts.bunny.net; ".
                   "font-src 'self' https://fonts.bunny.net; ".
                   "script-src 'self' 'unsafe-inline'; ".
                   "object-src 'none';";
        }

        // Special CSP for Telescope
        if ($request->is('telescope*')) {
            $csp = "default-src 'self'; ".
                   "img-src 'self' data: https://ui-avatars.com; ".
                   "style-src 'self' 'unsafe-inline' https://fonts.bunny.net; ".
                   "font-src 'self' https://fonts.bunny.net; ".
                   "script-src 'self' 'unsafe-inline'; ".
                   "object-src 'none';";
        }

        $response->headers->set('Content-Security-Policy', $csp);

        return $next($request);
    }
}

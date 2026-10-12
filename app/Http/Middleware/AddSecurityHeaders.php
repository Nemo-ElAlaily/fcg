<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AddSecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Referrer-Policy', 'no-referrer-when-downgrade');
        $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');
        // Third-party sources are limited to what the views actually load: jQuery/Bootstrap CDNs,
        // Google Fonts, ionicons (dashboard), and OpenStreetMap tiles (contact map).
        // `blob:` images are needed for the client-side upload previews in the dashboard.
        $csp = [
            "default-src 'self'",
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://code.jquery.com https://cdn.jsdelivr.net",
            "style-src 'self' 'unsafe-inline' https://fonts.googleapis.com https://code.ionicframework.com",
            "img-src 'self' data: blob: https://*.tile.openstreetmap.org",
            "font-src 'self' data: https://fonts.gstatic.com https://code.ionicframework.com",
            "frame-ancestors 'self'",
        ];
        $response->headers->set('Content-Security-Policy', implode('; ', $csp) . ';');

        return $response;
    }
}

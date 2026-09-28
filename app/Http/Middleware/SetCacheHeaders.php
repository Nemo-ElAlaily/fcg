<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetCacheHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|int  $maxAge  Maximum age in seconds (default: 1 year)
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $maxAge = 31536000)
    {
        $response = $next($request);

        // Only cache GET requests
        if ($request->isMethod('GET')) {
            // Set cache control headers
            $response->header('Cache-Control', 'public, max-age=' . $maxAge);

            // Set expires header (1 year from now by default)
            $response->header('Expires', gmdate('D, d M Y H:i:s', time() + $maxAge) . ' GMT');

            // Add ETag for conditional requests
            if ($response->getContent()) {
                $etag = md5($response->getContent());
                $response->header('ETag', $etag);

                // Check if client has cached version
                $requestEtag = $request->header('If-None-Match');
                if ($requestEtag === $etag) {
                    return response('', 304)->withHeaders($response->headers->all());
                }
            }
        }

        return $response;
    }
}

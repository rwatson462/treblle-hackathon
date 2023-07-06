<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JsonMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Transform request
        $request->headers->set('Accept', 'application/json');

        // Continue with request
        $response = $next($request);

        // Transform response
        $response->headers->set('Allow', $request->method());
        $response->headers->set('Content-type', 'application/json');
        $response->headers->set('Accept', 'application/json');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('strict-transport-security', 'max-age=31536000; includeSubDomains');
        $response->headers->set('X-Frame-Options', 'deny');
        $response->headers->set('Content-Security-Policy', "default-src 'self'");
        $response->headers->remove('x-powered-by');
        $response->headers->set('Content-Encoding', 'gzip');

        return $response;
    }
}

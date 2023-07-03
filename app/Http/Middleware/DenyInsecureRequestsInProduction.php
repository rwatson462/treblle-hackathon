<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
class DenyInsecureRequestsInProduction
{
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * This _probably_ works, but my server automatically upgrades insecure requests anyway,
         * so I can't trigger this error.
         * It does, however, work if you change the code to trigger in the 'local' environment and run it
         * through php artisan serve
         */
        if (app()->environment('production') && ! $request->isSecure()) {
            throw new MethodNotAllowedHttpException([], 'Insecure requests are not allowed');
        }

        return $next($request);
    }
}

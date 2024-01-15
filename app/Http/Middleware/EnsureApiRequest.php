<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureApiRequest
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if ($request->header('X-Requested-With') !== 'XMLHttpRequest') {
        // Not an XMLHttpRequest (e.g., direct browser access)
        abort(403, 'Unauthorized');
    }

    return $next($request);
}
}

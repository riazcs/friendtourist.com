<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class FrontendMiddleware
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
        session()->put('is_frontend', '1');
        return $next($request);
    }
}

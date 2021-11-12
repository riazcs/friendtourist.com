<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PhoneVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if (auth()->check()) {
            if (auth()->user()->phone == null)
                {
                    return redirect()->route('google.phone');
                }
                if (auth()->user()->phone_verified_at == null)
                {
                    return redirect()->route('verification');
                }
        }
        return $next($request);


    }
}

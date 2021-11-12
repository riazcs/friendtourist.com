<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Support\Facades\Auth;



class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *

     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(!empty(Auth::user()) && Auth::user()->user_type == User::Roles['Admin']){
            return $next($request);
        }
        return redirect('login');
    }
}

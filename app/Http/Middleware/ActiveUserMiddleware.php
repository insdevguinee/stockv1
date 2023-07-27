<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class ActiveUserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->active == 0 ){
            abort(403);
        }
        return $next($request);
    }
}

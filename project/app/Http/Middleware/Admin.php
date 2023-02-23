<?php

namespace App\Http\Middleware;

use Closure;

class Admin
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
        if(!isset(auth()->user()->is_admin) || !auth()->user()->is_admin){
            return response("", 403);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomException;
use Closure;

class AccountOwner
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
        $user_id = $request->route('id');

        if(auth()->user()->id != $user_id){
            throw new CustomException("The user is not the account owner!", 403);
        }
        return $next($request);
    }
}

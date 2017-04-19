<?php

namespace App\Http\Middleware;

use Closure;

class LoginMiddle
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
        if ($request->user()){
          return redirect('/profile');
        }
        return $next($request);
    }
}

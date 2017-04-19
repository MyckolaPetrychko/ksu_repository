<?php

namespace App\Http\Middleware;

use Closure;

use App\Repos\Role;

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
        if (!$request->user()){
          return redirect('/login');
        }
        $arr = $request->user();
        $role = Role::all()->where('id', $arr['type']);
        foreach($role as $r){
          if ($r['type'] != "admin"){
            return redirect('/login');
          }
        }

        return $next($request);
    }
}

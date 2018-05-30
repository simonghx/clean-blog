<?php

namespace App\Http\Middleware;  

use Closure;
use Auth;

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
        if(Auth::user()->role->slug != 'admin') {
            return redirect()->back()->with([
                "message" => "Vous ne pouvez pas accéder à cette page",
                "status" => "danger",
            ]);
        }
        return $next($request);
    }
}

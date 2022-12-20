<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SystemAccess
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

        $user =  session("user");
        // dd($user);
        if($user == null){
            return redirect()->route('home');
        }
        return $next($request);
    }
}

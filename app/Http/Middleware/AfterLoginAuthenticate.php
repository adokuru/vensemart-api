<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Config;

class AfterLoginAuthenticate
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
        
        if(Auth::check())
        {
            // if(auth()->user()->role == Config('constants.roles.Admin'))
            // {
                return $next($request);
            // }
        }
        else
        {
            return redirect('admin/login');
        }
       
    }

}

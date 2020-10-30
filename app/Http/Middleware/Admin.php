<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
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
        $adminDetails = Auth::User();
        if(is_null($adminDetails)){
            return redirect('login');
        }
        elseif($adminDetails->user_type!='2'){
             Auth::logout();
            return redirect('login');
        }

        return $next($request);
    }
}

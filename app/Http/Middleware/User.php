<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class User
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
        $userDetails = Auth::User();
        if(is_null($userDetails)){
            return redirect('login');
        }
        elseif($userDetails->user_type!='1'){
            Auth::logout();
            return redirect('login');
        }
        elseif($userDetails->login_status!='1'){
            Auth::logout();
            return redirect('login')->with('error','Your account is disabled. Please contact to our support.');
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckUserLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        if (session()->has('user') && session()->get('user')->deactivated == 0 && (session()->get('user')->role_id == 1 )) {
            
            
            return $next($request);
        } else {
            if (session()->has('user') && session()->get('user')->deactivated==1) {
                session()->put('icon', 'error');
                session()->put('mess', 'Notification');
                session()->put('text', 'Your Account Has Been Deactivated !');
                session()->forget('user');
            }
            return $next($request);
        }
    }
}

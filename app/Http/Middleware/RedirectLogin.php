<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class RedirectLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('admin') && session()->get('admin')->deactivated==0 && (session()->get('admin')->role_id==2 || session()->get('admin')->role_id==3)) {
           
                return redirect("/admin/dashboard");
            
            
        } else {
            return $next($request);
        }
    }
}

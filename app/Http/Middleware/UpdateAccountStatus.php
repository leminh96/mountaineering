<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\accounts\Accounts;


class UpdateAccountStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('admin') ) {
            $id=session()->get('admin')->id;
            session()->put('admin', 
            Accounts::where('id', $id)
            ->first()
            ) ;
        }
         if(session()->has('user')){
            $id=session()->get('user')->id;
            session()->put('user', 
            Accounts::where('id', $id)
            ->first()
            ) ;
            
        }
        
        return $next($request);
    }
}

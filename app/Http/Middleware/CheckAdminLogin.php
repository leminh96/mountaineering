<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        
        // if(session()->has('newLoginAction') && session()->get('newLoginAction') == true ){
        //     session()->put('newLoginAction',false);
        //     return redirect('/admin/dashboard');
        // }

        if (session()->has('admin') && session()->get('admin')->deactivated == 0 && (session()->get('admin')->role_id == 2 || session()->get('admin')->role_id == 3)) {

           

            $button = $request->get('button');
            if ($button != null && ($button == 'activate' || $button == 'deactivate')) {
                if ($request->get('role_id') != 1 && session()->get('admin')->role_id != 3 && $request->get('menu') == 'user') {
                    session()->put('icon', 'error');
                    session()->put('mess', 'Update Failed !');
                    session()->put('text', 'You do not have permission to perform this action');
                    return redirect("/admin/accounts/table");
                }
            }
            if ($button != null && $button == 'update' ) {
                if ( $request->get('menu') == 'user' && $request->get('roleid') != null && $request->get('roleid') != 1 && session()->get('admin')->role_id != 3) {
                    session()->put('icon', 'error');
                    session()->put('mess', 'Update Failed !');
                    session()->put('text', 'You do not have permission to perform this action');
                    return redirect("/admin/accounts/table");
                }
            }
            if ($button != null && $button == 'add' ) {
                if ( $request->get('menu') == 'user' && $request->get('roleid') != 1 && session()->get('admin')->role_id != 3) {
                    session()->put('icon', 'error');
                    session()->put('mess', 'Update Failed !');
                    session()->put('text', 'You do not have permission to perform this action');
                    return redirect("/admin/accounts/table");
                }
            }
            return $next($request);
        } else {
            if (session()->has('mess')) {

            } else if (!session()->has('admin')) {
                session()->put('icon', 'warning');
                session()->put('mess', 'Access Failed !');
                session()->put('text', 'Please login to get access');
            } else if (session()->get('admin')->deactivated) {
                session()->put('icon', 'error');
                session()->put('mess', 'Access Failed !');
                session()->put('text', 'Your account has been deactivated');
            }

            return redirect("/admin");
        }
    }
}

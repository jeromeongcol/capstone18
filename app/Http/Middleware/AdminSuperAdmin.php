<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Role;

class AdminSuperAdmin
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

        if( Auth::check() && ( Role::where( 'id', Auth::user()->role_id )->first()->name == 'Admin' ) || ( Role::where( 'id', Auth::user()->role_id )->first()->name == 'SuperAdmin' )){

           return $next($request);
        }

        return redirect()->guest('/home');


    }
}

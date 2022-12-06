<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Admins;
class AccessPermission
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
        if(Auth::user()->hasAnyRoles(['admin','author'])){
                return $next($request);
        }
        return redirect('/dashboard');
    }
}
class AccessRole
{
    public function handle($request, Closure $next,$role)
    {
        if(Auth::user()->hasRole($role)){
                return $next($request);
        }
        return redirect('/dashboard');
    }
}
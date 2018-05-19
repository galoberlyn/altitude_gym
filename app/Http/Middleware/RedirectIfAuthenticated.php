<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {

            if($request->user()->user_type == 'member'){

                return redirect('/dashboard');

            }elseif($request->user()->user_type == 'admin'){

                return redirect('/dashboard_a');

            }elseif($request->user()->user_type == 'manager'){

                return redirect('/dashboard_m');
            }
        }

        return $next($request);
    }
}

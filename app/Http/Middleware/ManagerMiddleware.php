<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Response;
class ManagerMiddleware
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

        if($request->user() && $request->user()->user_type != 'manager'){
            return new Response(view('unauthorized') ->with('role', 'manager'));
        }
        return $next($request);
    }
}

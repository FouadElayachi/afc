<?php

namespace App\Http\Middleware;

use Closure;

class administration
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
        $user = $request->user();
        return ($user->hasRole('admin'))? $next($request) : redirect('/');
    }
}

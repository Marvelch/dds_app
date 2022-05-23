<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check() && auth()->user()->level == 'operator') {
            return $next($request);
        }

        return redirect('home')->with('error', "You don't have admin access.");
    }
}

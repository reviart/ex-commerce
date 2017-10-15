<?php

namespace App\Http\Middleware;

use Session;
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
            if ($request->ajax() || $request->wantJson()) {
              return response()->json(['error' => 'Unauthenticated.'], 401);
            }
            else {
              Session::put('oldUrl', $request->url());
              return redirect()->route('user.signin');
            }
            //return redirect()->route('product.dashboard');
        }

        return $next($request);
    }
}

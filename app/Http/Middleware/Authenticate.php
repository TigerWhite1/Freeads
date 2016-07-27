<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class Authenticate
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
            // dd($request);
            // if(!Auth::user()->confirmed) {
            //     Auth::logout();

            //     echo "Account not activated";
            // }
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }
        // } else
        // {
        //     if(Auth::user()->confirmed === 0)
        //     {
        //         Auth::logout();
        //         // dd("tototo");
        //         return Redirect::to('/');
        //     }
        // }

        return $next($request);
    }
}

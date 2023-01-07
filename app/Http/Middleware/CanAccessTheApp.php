<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CanAccessTheApp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $package_name = 'default';

        if (auth()->user()->new_account && auth()->user()->linked_user_role == 'admin'){

            if (auth()->user()->subscribed($package_name)) {
                // User subscribed to the package
                // Give user the application access
                return $next($request);
            }
//            if (auth()->user()->subscription($package_name)->onTrial()) {
//                // User is now in trial
//                return $next($request);
//            }

            // redirect user to billing page
            // return $next($request);
            return redirect()->route('pay-with-card')->with("message","You have to subscribe first to access this page");
        }
        else{
            return $next($request);
        }

    }
}

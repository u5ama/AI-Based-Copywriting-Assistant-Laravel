<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->session()->has("user")){
            $this->data['user'] =  $request->session()->get("user");
            if( $this->data['user']['role']=='isAdmin'){
                return $next($request);
            }
        }
       return redirect('/')->with('error','You have not admin access');
    }
}

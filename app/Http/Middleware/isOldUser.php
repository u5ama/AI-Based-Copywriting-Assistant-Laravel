<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class isOldUser
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
            if( $this->data['user']['isLoggedIn']==true){
                if(auth()->user()->new_account && auth()->user()->linked_user_role == 'admin'){
                    return redirect(route('new-sign-up'));
                } else
                    return $next($request);
            }
        }
       return redirect('/')->with('error','Please Login First');
       return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class AdminMiddleware
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
        if(Auth::user()->email == 'hosniemna99@gmail.com'){
            return $next($request);
        }
        else{
            return redirect('/home')->with('status','You are not allowed to admin dashboard');
        }    }
}

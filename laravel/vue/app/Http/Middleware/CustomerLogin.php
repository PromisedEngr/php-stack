<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Session;
use Auth;

class CustomerLogin
{
    protected $auth;

    public function __construct(Guard $auth)
    {
        
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       if (!isset(Auth::guard('customer')->user()->id) ||  Auth::guard('customer')->user()->status == 'inactive'){
            Session::flush();
            return \Redirect::route('customerloginpage')->send();
        } 
        return $next($request);
    
    }
}

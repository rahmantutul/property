<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->guard('admin')->check() && auth()->guard('admin')->user()->status==1)
            return redirect()->route('admin.dashboard');
        elseif(auth()->guard('agent')->check() && auth()->guard('agent')->user()->status==1)
            return redirect()->route('agent.dashboard');
        elseif(auth()->guard('buyer')->check() && auth()->guard('buyer')->user()->status==1)
            return redirect()->route('buyer.dashboard');
        elseif(auth()->guard('seller')->check() && auth()->guard('seller')->user()->status==1)
            return redirect()->route('seller.dashboard');
        else
          return $next($request);
    }
}

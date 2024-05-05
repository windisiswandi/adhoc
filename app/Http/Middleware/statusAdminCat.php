<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class statusAdminCat {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    // public function hadndle(Request $request, Closure $next)
    // {
    //     return $next($request);
    // }

    public function handle(Request $request, Closure $next) {

        if (auth()->user()->email == 'admin@cat2024.com') {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

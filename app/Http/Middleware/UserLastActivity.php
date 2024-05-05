<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
// use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
// use Illuminate\Cache;
// use Cache;
use Carbon\Carbon;

class UserLastActivity
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
        return $next($request);
    }

    // public function handle($request, Closure $next)
    // {
    //     if (Auth::check()) {
    //         $expireTime = Carbon::now()->addMinute(1); // keep online for 1 min
    //         Cache::put('is_online'.Auth::user()->id, true, $expireTime);

    //         //Last Seen
    //         User::where('id', Auth::user()->id)->update(['last_seen' => Carbon::now()]);
    //     }
    //     return $next($request);
    // }
}

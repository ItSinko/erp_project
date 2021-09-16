<?php

namespace App\Http\Middleware;

use \Illuminate\Support\Facades\Auth;
use Closure;
use \Illuminate\Support\Facades\Cache;
use App\User;
use Carbon\Carbon;

class ActivityByUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            $expiresAt = Carbon::now()->addMinutes(1);
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
            User::where('id', Auth::user()->id)->update(['last_seen' => (new \DateTime())]);
        }
        return $next($request);
    }
}

<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
//        $path = (string) 'org/'. auth()->user()->id.'/'. auth()->user()->slug.'/index';
//        if(auth()->user()->active_organization) return redirect($path);
        return $next($request);
    }
}

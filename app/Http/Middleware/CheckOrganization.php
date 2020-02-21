<?php

namespace App\Http\Middleware;

use Closure;

class CheckOrganization
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
//        $path = (string) 'user/'.auth()->user()->id.'/'. auth()->user()->slug.'/index';
//        if(isset(auth()->user()->active_organization)) return redirect($path);
        return $next($request);
    }
}

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

//        $path = (string) 'org/'.auth()->user()->id.'/'. auth()->user()->slug.'/create';

//        if(auth()->user()->active_organization == null )
//            return redirect($path);

        return $next($request);
    }
}

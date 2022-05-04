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

       if(auth()->user()->active_organization == null )
           return redirect()->route('user.organization.create', [auth()->user()->id]);

        return $next($request);
    }
}

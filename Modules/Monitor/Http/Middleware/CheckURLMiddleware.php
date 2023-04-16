<?php

namespace Modules\Monitor\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Shetabit\Visitor\Middlewares\LogVisits;

class CheckURLMiddleware
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
    //   if ( url()->full() == config('monitor.check')) {
        return $next($request);
    //   }  
    }
}

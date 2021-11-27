<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Website
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
        if(empty(session('id')))
        {
            return redirect('signin');
        }
        return $next($request);
    }
}

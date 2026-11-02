<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check()&& auth()->user()->role==='user'){
             
            return $next($request);
        }
       return redirect()->route(route:'show.user')->with('error','доступ запрещен.Вы не пользователь!');
    }
}

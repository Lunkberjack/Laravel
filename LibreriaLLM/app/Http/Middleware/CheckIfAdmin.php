<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckIfAdmin
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
        // Si el usuario no es nulo y además es admin, se continúa
        // (se abre la compuerta, por así decirlo)
        if($request->user() != null && $request->user()->isAdmin()) {
           return $next($request); 
        }
        // En otro caso:
        abort(403);
    }
}

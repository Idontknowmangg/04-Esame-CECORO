<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($request, Closure $next)
    {
        // Ottieni l'utente corrente
        $user = JWTAuth::parseToken()->authenticate();
    
        // Controlla se l'utente è un admin
        if ($user->isAdmin) {
            return $next($request);
        }
    
        // Se l'utente non è un admin, ritorna un errore
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
}

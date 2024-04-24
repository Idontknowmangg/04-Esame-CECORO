<?php

namespace App\Http\Middleware;

use App\Models\ImpostazioniAdmin\ContattiStato;
use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class isBanned
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
        // Ottieni l'utente autenticato
        $user = JWTAuth::parseToken()->authenticate();
    
        // Ottieni lo stato del contatto dell'utente
        $contattoStato = ContattiStato::where('idContatto', $user->idContatto)->first();
    
        // Verifica se l'utente è bannato
        if ($contattoStato->isBanned == 1) {
            // L'utente è bannato, quindi restituisci un errore
            return response()->json(['error' => 'You are banned from admin'], 403);
        }
    
        // Se l'utente non è bannato, continua con la richiesta
        return $next($request);
    }
    
}

<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RateRequest;
use App\Models\ImpostazioniSito\Valutazione;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class ValutazioneController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RateRequest  $request
     * @return JsonResource
     */
    public function store(RateRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Creiamo un nuovo record dalla richiesta
        $rating = Valutazione::create([
            'idContatto' => $user->idContatto,
            'valutazione' => $request->valutazione,
            'stars' => $request->stars
        ]);
    
        // Infine ritorna il messaggio di successo
        return response()->json([
            'message' => 'Thank you! Your feedback will help us!',
            'Your feedback' => $rating
        ]);
    }
}

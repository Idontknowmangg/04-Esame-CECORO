<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\FeedbackRequest;
use App\Models\ImpostazioniSito\Assistenza_autorizzati;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AssistenzaAutorizzatiController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\v1\FeedbackRequest $request
     * @return JsonResource
     */
    public function store(FeedbackRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Creiamo un nuovo record dalla richiesta
        $assistance = Assistenza_autorizzati::create([
            'idContatto' => $user->idContatto,
            'feedback' => $request->feedback
        ]);
    
        // Infine ritorna un messaggio che è avvenuto con successo
        return response()->json([
            'message' => 'Published with success your problem!',
            'Your problem' => $assistance
        ]);
    }
}

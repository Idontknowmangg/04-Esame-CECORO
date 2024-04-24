<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\PayRequest;
use App\Models\ImpostazioniSito\Fittizio_pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class FittizioPagamentoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\PayRequest  $request
     * @return JsonResource
     */
    public function store(PayRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Memorizziamo l'utente
        $existingCC = Fittizio_pagamento::where('idContatto', $user->idContatto)->first();
    
        // Condizione che se ritorna false, significa che l'utente ha già una carta di credito, lo status code 400 significa che la richiesta non è valida
        if ($existingCC) {
            return response()->json([
                'message' => 'ERR_SETTED_CREDIT_CARD',
            ], 400);
        }
    
        // Creiamo un nuovo record dalla richiesta la carta di credito (che ovviamente sarà hashata)
        $cc = Fittizio_pagamento::create([
            'idContatto' => $user->idContatto,
            'personal_info' => Hash::make($request->personal_info)
        ]);
    
        // Infine ritorna il messaggio di successo che la sua carta di credito esiste
        return response()->json([
            'message' => 'Your credit card is setted correctly.',
            'Your feedback' => $cc
        ]);
    }
}

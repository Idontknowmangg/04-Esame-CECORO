<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImpostazioniSito\AttoriResource;
use App\Models\ImpostazioniAdmin\Attori;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AttoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo gli attori
        $actors = Attori::all();
        // Filtriamo in dati utili
        $actorsResource = AttoriResource::collection($actors);

        // Infine ritorna tutti gli attori
        return response()->json([
            'All actors: ' => $actorsResource
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $idActor
     * @return JsonResource
     */
    public function show($idActor)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
        // Recupera l'attore con l'id specificato
        $actors = Attori::find($idActor);
    
        // Condizione che se ritorna false, significa che l'attore di quell'id non esiste, lo status code 404 indica che l'oggetto non è stato trovato 
        if (!$actors) {
            return response()->json(['error' => 'ERR_ACTORS_NOTFOUND'], 404);
        }
    
        // Se tutto va bene, verranno filtrati i dati dell'attore utilizzando AttoriResource
        $actorsResource = new AttoriResource($actors);
    
        // Infine ritorna i dati di quell'id dell'attore
        return response()->json(['Actor: ' => $actorsResource]);
    }
}

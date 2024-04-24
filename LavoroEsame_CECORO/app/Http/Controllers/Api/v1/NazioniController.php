<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\StoreNazioniRequest;
use App\Http\Requests\v1\UpdateNazioniRequest;
use App\Http\Resources\ImpostazioniSito\NazioniCompletaResource;
use App\Http\Resources\ImpostazioniSito\NazioniResource;
use App\Models\ImpostazioniSito\Nazioni;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class NazioniController extends Controller
{

    public function showNazioni()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo tutti i record della tabella Nazioni
        $nations = Nazioni::all();
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = NazioniCompletaResource::collection($nations);
        } else {
            $resource = NazioniResource::collection($nations);
        }
        return $resource;
    }

    public function chooseNazioni($idNations)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Trova la nazione con l'ID specificato
        $nations = Nazioni::find($idNations);
    
        // Condizione che se ritorna false, significa che l'id della nazione cercata non esiste
        if (!$nations) {
            return response()->json(['error' => 'ERR_NATION_NOTFOUND_ADMIN'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new NazioniCompletaResource($nations);
        } else {
            $resource = new NazioniResource($nations);
        }
        return $resource;
    }
    
    
    public function storeNazioni(StoreNazioniRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Validiamo i dati della richiesta
        $request->validated();

        // Creiamo la nazione
        $newNation = Nazioni::create($request->all());

        // Ritorna il messaggio di successo
        return response()->json([
            'message' => 'Nation created with success.',
            'New nation:' => $newNation
        ]);
    }

    
    public function updateNazioni(UpdateNazioniRequest $request, $idNation)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo la nazione da aggiornare
        $nationToUpdate = Nazioni::find($idNation);

        // Condizione che se ritorna false, significa che l'id della nazione cercata non esiste
        if (!$nationToUpdate) {
            return response()->json(['error' => 'ERR_NATION_NOTFOUND_PUT_ADMIN'], 404);
        }

        // Aggiorniamo la nazione
        $nationToUpdate->update($request->all());

        // Messaggio di successo
        return response()->json([
            'message' => 'Nation updated with success.',
            'Nation: ' => $nationToUpdate
        ]);
    }


    public function deleteNazioni($idGenere)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo la nazione da eliminare
        $nationToDelete = Nazioni::find($idGenere);

        // Condizione che se ritorna false, significa che l'id della nazione cercata non esiste
        if (!$nationToDelete) {
            return response()->json(['error' => 'ERR_NATION_NOTFOUND_DELETE_ADMIN'], 404);
        }

        // Eliminiamo la nazione
        $nationToDelete->delete();

        // Messaggio di successo
        return response()->json([
            'message' => 'Nation deleted with success.'
        ]);
    }
}

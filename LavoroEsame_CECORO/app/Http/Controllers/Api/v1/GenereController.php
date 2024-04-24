<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGenresRequest;
use App\Http\Requests\Admin\UpdateGenresRequest;
use App\Http\Resources\ImpostazioniAdmin\GenereCompletaResource;
use App\Http\Resources\ImpostazioniAdmin\GenereResource;
use App\Models\ImpostazioniGenere\Genere;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class GenereController extends Controller
{
    public function showGenres()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo tutti i record della tabella Genere
        $genere = Genere::all();
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = GenereCompletaResource::collection($genere);
        } else {
            $resource = GenereResource::collection($genere);
        }
        return $resource;
    }

    public function chooseGenres($idGenere)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo il genere con l'ID specificato
        $genere = Genere::find($idGenere);
    
        // Condizione che se ritorna false, significa che l'id del genere cercato non esiste
        if (!$genere) {
            return response()->json(['error' => 'ERR_GENRE_NOTFOUND'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new GenereCompletaResource($genere);
        } else {
            $resource = new GenereResource($genere);
        }
        return $resource;
    }
    
    
    public function storeGenres(StoreGenresRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Validiamo i dati della richiesta
        $request->validated();

        // Creiamo il genere
        $newGenre = Genere::create($request->all());

        // Ritorna il messaggio di successo
        return response()->json([
            'message' => 'Genre created with success.',
            'New genre:' => $newGenre
        ]);
    }

    
    public function updateGenres(UpdateGenresRequest $request, $idGenere)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo il genere da aggiornare
        $genreToUpdate = Genere::find($idGenere);

        // Condizione che se ritorna false, significa che l'id del genere cercato non esiste
        if (!$genreToUpdate) {
            return response()->json(['error' => 'ERR_GENRE_NOTFOUND_PUT'], 404);
        }

        // Aggiorniamo il genere
        $genreToUpdate->update($request->all());

        // Messaggio di successo
        return response()->json([
            'message' => 'Genre updated with success.',
            'Film: ' => $genreToUpdate
        ]);
    }


    public function deleteGenres($idGenere)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo il genere da eliminare
        $genreToDelete = Genere::find($idGenere);

        // Condizione che se ritorna false, significa che l'id del genere cercato non esiste
        if (!$genreToDelete) {
            return response()->json(['error' => 'ERR_GENRE_NOTFOUND_DELETE'], 404);
        }

        // Eliminiamo il genere
        $genreToDelete->delete();

        // Messaggio di successo
        return response()->json([
            'message' => 'Genre deleted with success.'
        ]);
    }
}

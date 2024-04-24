<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilmHasGenereRequest;
use App\Http\Requests\Admin\UpdateFilmHasGenereRequest;
use App\Http\Resources\Admin\FilmHasGenereCompletaResource;
use App\Http\Resources\Admin\FilmHasGenereResource;
use App\Models\ImpostazioniGenere\Film_hasGenere;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class FilmHasGenereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo tutti i record della tabella Film_hasGenere
        $film = Film_hasGenere::all();
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = FilmHasGenereCompletaResource::collection($film);
        } else {
            $resource = FilmHasGenereResource::collection($film);
        }
        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreFilmHasGenereRequest $request
     * @return JsonResource
     */
    public function store(StoreFilmHasGenereRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Validiamo i dati della richiesta
        $request->validated();

        // Creazione del nuovo film con un genere
        $newGenre = Film_hasGenere::create($request->all());

        // Messaggio di successo
        return response()->json([
            'message' => 'Film with a genre created with success.',
            'New film with genre:' => $newGenre
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idFilm
     * @return JsonResource
     */
    public function show($idFilm)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Trova un film con un genere con l'ID specificato
        $film = Film_hasGenere::find($idFilm);
    
        // Condizione che se ritorna false, significa che l'id del film con un genere non esiste
        if (!$film) {
            return response()->json(['error' => 'ERR_FILM_WITHAGENRE_NOTFOUND'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new FilmHasGenereCompletaResource($film);
        } else {
            $resource = new FilmHasGenereResource($film);
        }
        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateFilmHasGenereRequest  $request
     * @param  int  $idFilm
     * @return JsonResource
     */
    public function update(UpdateFilmHasGenereRequest $request, $idFilm)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Trova un film con un genere con l'ID specificato
        $docToUpdate = Film_hasGenere::find($idFilm);
    
        // Condizione che se ritorna false, significa che l'id del film con un genere non esiste
        if (!$docToUpdate) {
            return response()->json(['error' => 'ERR_FILM_WITHAGENRE_NOTFOUND_PUT'], 404);
        }
    
        // Aggiorniamo il film con un genere
        $docToUpdate->update($request->all());
    
        // Messaggio di successo
        return response()->json([
            'message' => 'Film with a genre updated with success.',
            'Film: ' => $docToUpdate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idFilm
     * @return JsonResource
     */
    public function destroy($idFilm)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Trova un film con un genere con l'ID specificato
        $filmGenreToDelete = Film_hasGenere::find($idFilm);

        // Condizione che se ritorna false, significa che l'id del film con un genere non esiste
        if (!$filmGenreToDelete) {
            return response()->json(['error' => 'ERR_FILM_WITHAGENRE_NOTFOUND_DELETE'], 404);
        }

        // Eliminiamo un film con un genere
        $filmGenreToDelete->delete();

        // Messaggio di successo
        return response()->json([
            'message' => 'Film with a genre deleted with success.'
        ]);
    }
}

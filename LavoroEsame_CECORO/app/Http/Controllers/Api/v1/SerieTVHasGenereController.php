<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTVSeriesHasGenreRequest;
use App\Http\Requests\Admin\UpdateTVSeriesHasGenreRequest;
use App\Http\Resources\Admin\TVSeriesHasGenreCompletaResource;
use App\Http\Resources\Admin\TVSeriesHasGenreResource;
use App\Models\ImpostazioniGenere\SerieTV_hasGenere;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SerieTVHasGenereController extends Controller
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
        // Estraiamo tutti i record della tabella SerieTV_hasGenere
        $tvSeries = SerieTV_hasGenere::all();
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = TVSeriesHasGenreCompletaResource::collection($tvSeries);
        } else {
            $resource = TVSeriesHasGenreResource::collection($tvSeries);
        }
        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreTVSeriesHasGenreRequest $request
     * @return JsonResource
     */
    public function store(StoreTVSeriesHasGenreRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Validiamo i dati della richiesta
        $request->validated();

        // Creazione della nuova serie tv con un genere
        $newGenre = SerieTV_hasGenere::create($request->all());

        // Messaggio di successo
        return response()->json([
            'message' => 'TV Series with a genre created with success.',
            'New TV Series with genre:' => $newGenre
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idSerieTV
     * @return JsonResource
     */
    public function show($idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Trova un serie TV con un genere con l'ID specificato
        $tvSeries = SerieTV_hasGenere::find($idSerieTV);
    
        // Condizione che se ritorna false, significa che l'id della serieTV con un genere non esiste
        if (!$tvSeries) {
            return response()->json(['error' => 'ERR_TVSERIES_NOTFOUND'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new TVSeriesHasGenreCompletaResource($tvSeries);
        } else {
            $resource = new TVSeriesHasGenreResource($tvSeries);
        }
    
        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateTVSeriesHasGenreRequest  $request
     * @param  int  $idSerieTV
     * @return JsonResource
     */
    public function update(UpdateTVSeriesHasGenreRequest $request, $idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Trova una serie TV con un genere con l'ID specificato
        $docToUpdate = SerieTV_hasGenere::find($idSerieTV);
    
        // Condizione che se ritorna false, significa che l'id della serie TV con un genere non esiste
        if (!$docToUpdate) {
            return response()->json(['error' => 'ERR_TVSERIES_WITHAGENRE_NOTFOUND_PUT'], 404);
        }
    
        // Aggiorniamo la serie tv con un genere
        $docToUpdate->update($request->all());
    
        // Messaggio di successo
        return response()->json([
            'message' => 'TV Series with a genre updated with success.',
            'TV Series: ' => $docToUpdate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idSerieTV
     * @return JsonResource
     */
    public function destroy($idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Trova una serie tv con un genere con l'ID specificato
        $filmGenreToDelete = SerieTV_hasGenere::find($idSerieTV);

        // Condizione che se ritorna false, significa che l'id della serie tv con un genere non esiste
        if (!$filmGenreToDelete) {
            return response()->json(['error' => 'TV Series with a genre not found'], 404);
        }

        // Eliminiamo un film con un genere
        $filmGenreToDelete->delete();

        // Messaggio di successo
        return response()->json([
            'message' => 'TV Series with a genre deleted with success.'
        ]);
    }
}

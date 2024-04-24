<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTVSeriesRequest;
use App\Http\Requests\Admin\UpdateTVSeriesRequest;
use App\Http\Resources\Admin\StagioniEpisodiResource;
use App\Http\Resources\ImpostazioniSito\see_tvSeriesResource;
use App\Http\Resources\MainContent\v1\SerieTVResource;
use App\Models\ImpostazioniSito\Crediti;
use App\Models\ImpostazioniSito\CreditiSerieTV;
use App\Models\ImpostazioniSito\StagioniEpisodi;
use App\Models\MainContent\SerieTV;
use App\Models\VisualizzazioneImmagini\Vedi_serieTV;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class SerieTVController extends Controller
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

        // Estraiamo tutte le serie tv
        $tvseries = SerieTV::all();
        // Filtriamo i dati necessari
        $tvSeriesResource = SerieTVResource::collection($tvseries);

        // Infine ritorniamo il messaggio e la lista intera di tutte le serie tv
        return response()->json([
            'All TV Series: ' => $tvSeriesResource
        ]);
    }

    public function listEpisodes()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();

        // Estraiamo tutte le stagioni ed episodi delle serie tv
        $tvseries = StagioniEpisodi::all();
        // Filtriamo i dati necessari
        $tvSeriesResource = StagioniEpisodiResource::collection($tvseries);

        // Infine ritorniamo il messaggio e la lista intera di tutte le stagioni ed episodi delle serie tv
        return response()->json([
            'All Seasons and Episodes: ' => $tvSeriesResource
        ]);
    }

    public function listEpisodesSHOW($idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
        
        // Recuperiamo i dati di quell'id specificato delle stagioni ed episodi disponibili
        $tvseries = StagioniEpisodi::find($idSerieTV);
    
        // Condizione che se ritorna false, significa che l'id dato non esiste nel DB, lo status code 404 indica che l'oggetto specificato non è stato trovato
        if (!$tvseries) {
            return response()->json(['error' => 'ERR_SEASONS_AND_EPS_NOTFOUND'], 404);
        }
    
        // Se tutto va bene, filtriamo i dati necessari
        $tvSeriesResource = new StagioniEpisodiResource($tvseries);
    
        // E ritorniamo i dati di quell'id di stagioni ed episodi della serie tv
        return response()->json(['TV Series with his episodes and seasons: ' => $tvSeriesResource]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreTVSeriesRequest  $request
     * @return JsonResource
     */
    public function store(StoreTVSeriesRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $request->validated();
    
        // Prendiamo i prefissi per poi avere il valore preso dalle request
        $conditions = [
            'titoloSerieTV' => $request->titoloSerieTV,
            'idGenere' => $request->idGenere,
            'idImmagineSerieTV' => $request->idImmagineSerieTV,
            'descrizione' => $request->descrizione,
            'regista' => $request->regista,
            'totStagioni' => $request->totStagioni,
            'totEp' => $request->totEp,
            'anno' => $request->anno
        ];

        // Memorizziamo la var con i dati presi dalla request
        $existingTVSeries = SerieTV::where($conditions)->first();
        
        // Se la condizione della var ritorna true significa che quei dati immessi sono identici a quelli esistenti nel DB, lo status code 400 intende richiesta non valida
        if ($existingTVSeries) {
            return response()->json(['message' => 'ERR_CREATION_TVSERIES'], 400);
        }
        
        // Se tutto va bene, creiamo la serie tv dalla richiesta
        $newTVSeries = SerieTV::create($request->all());
    
        // Infine ritorniamo il messaggio che è stato creato con successo
        return response()->json([
            'message' => 'TV Series created with success.',
            'New TV Series:' => $newTVSeries
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
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();

        // Recuperiamo la serie tv con l'id specificato
        $tvseries = SerieTV::find($idSerieTV);
    
        // Se la serieTV non esiste, ritorna l'errore, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$tvseries) {
            return response()->json(['error' => 'ERR_TVSERIES_NOTFOUND'], 404);
        }
    
        // Se tutto va bene trasformiamo i dati della serie tv utilizzando la SerieTVResource
        $tvSeriesResource = new SerieTVResource($tvseries);
    
        // Infine ritorna il messaggio dei dati di quell'id della serie tv
        return response()->json(['TV Series: ' => $tvSeriesResource]);
    }
    
    public function play($idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Recuperiamo la serie tv con l'id specificato
        $tvSeries = Vedi_serieTV::findOrFail($idSerieTV);
    
        // Estraiamo l'idContatto (preso dal token)
        $idContatto = $user->idContatto;
    
        // Estraiamo i crediti di quell'idContatto
        $creditiUtente = Crediti::where('idContatto', $idContatto)->first()->crediti;
    
        // Estraiamo anche i crediti necessari per quel film di quell'id
        $creditiNecessari = CreditiSerieTV::where('idSerieTV', $idSerieTV)->first()->creditiNecessari;
    
        // Condizione che se i crediti dell'utente è minore di quelli necessari per guardare
        if ($creditiUtente < $creditiNecessari) {
            // Se è true, ritorna un messaggio d'errore che indica al client che non ha i crediti sufficienti per quella serie tv, lo status code 404 indica che non ha il permesso di guardarlo perché ovviamente non ha i crediti necessari
            return response()->json(['error' => 'ERR_INSUFFICIENT_CR_TVSERIES'], 403);
        }
    
        // Se supera la condizione, ritorna la serie tv di quell'id
        return response()->json(['Serie TV: ' => $tvSeries]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateTVSeriesRequest  $request
     * @param  int  $idSerieTV
     * @return JsonResource
     */
    public function update(UpdateTVSeriesRequest $request, $idSerieTV)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo l'id di quella serie tv
        $TVSeriesToUpdate = SerieTV::find($idSerieTV);
    
        // Condizione che se ritorna false ritorna un messaggio della serie tv non trovata, lo status code 404 indica l'oggetto cercato non è stato trovato
        if (!$TVSeriesToUpdate) {
            return response()->json(['error' => 'ERR_TVSERIES_NOTFOUND_PUT_ADMIN'], 404);
        }
    
        // Aggiorniamo la serie tv con i dati della richiesta
        $TVSeriesToUpdate->update($request->all());
    
        // Infine ritorna il messaggio di aggiornamento avvenuto con successo e la serie tv che è stato effettivamente aggiornato
        return response()->json([
            'message' => 'TV Series updated with success.',
            'TV Series: ' => $TVSeriesToUpdate
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

        // Troviamo la serie tv di quell'id da eliminare
        $tvSeriesToDelete = SerieTV::find($idSerieTV);

        // Condizione che se la serie tv ritorna false, ritorna il messaggio d'errore che l'oggetto non è stato trovato
        if (!$tvSeriesToDelete) {
            return response()->json(['error' => 'TV Series not found'], 404);
        }

        // Se tutto va bene, eliminiamo la serie tv
        $tvSeriesToDelete->delete();

        // Infine ritorna il messaggio che è stato cancellato con successo, lo status code 204 indica che non c'è contenuto nella richiesta, infatti deve esserlo
        return response()->json([
            'message' => 'TV Series deleted with success.'
        ], 204);
    }
}

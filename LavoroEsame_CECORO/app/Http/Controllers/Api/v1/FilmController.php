<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFilmRequest;
use App\Http\Requests\Admin\UpdateFilmRequest;
use App\Http\Resources\MainContent\v1\FilmResource;
use App\Models\ImpostazioniSito\Crediti;
use App\Models\ImpostazioniSito\CreditiFilm;
use App\Models\MainContent\Film;
use App\Models\VisualizzazioneImmagini\Vedi_film;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class FilmController extends Controller
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

        // Estraiamo tutti i film
        $films = Film::all();
        // Filtriamo i dati necessari
        $filmsResource = FilmResource::collection($films);

        // Infine ritorniamo il messaggio e la lista intera di tutti i film
        return response()->json([
            'All films: ' => $filmsResource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreFilmRequest  $request
     * @return JsonResource
     */
    public function store(StoreFilmRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $request->validated();
    
        // Prendiamo i prefissi per poi avere il valore preso dalle request
        $conditions = [
            'titoloFilm' => $request->titoloFilm,
            'idGenere' => $request->idGenere,
            'idImmagineFilm' => $request->idImmagineFilm,
            'idFormatoFilm' => $request->idFormatoFilm,
            'descrizione' => $request->descrizione,
            'regista' => $request->regista,
            'anno' => $request->anno,
            'durata' => $request->durata
        ];
        
        // Memorizziamo la var con i dati presi dalla request
        $existingFilm = Film::where($conditions)->first();
        
        // Se la condizione della var ritorna true significa che quei dati immessi sono identici a quelli esistenti nel DB, lo status code 400 intende richiesta non valida
        if ($existingFilm) {
            return response()->json(['message' => 'ERR_CREATION_FILM'], 400);
        }
        
        // Se tutto va bene, creiamo il film dalla richiesta
        $newFilm = Film::create($request->all());
    
        // E ritorniamo il messaggio di creazione avvenuta con successo
        return response()->json([
            'message' => 'Film created with success.',
            'New film:' => $newFilm
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
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
        
        // Recuperiamo il film con l'id specificato dal client
        $film = Film::find($idFilm);
    
        // Condizione che se la var ritorna false significa che il film non esiste, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$film) {
            return response()->json(['error' => 'ERR_FILM_NOTFOUND'], 404);
        }
    
        // Se tutto va bene, memorizziamo in questa var i dati filtrati con il resource
        $filmResource = new FilmResource($film);
    
        // E ritorniamo il film con l'id specificato
        return response()->json(['Film: ' => $filmResource]);
    }

    public function play($idFilm)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo il film con l'id specificato
        $film = Vedi_film::findOrFail($idFilm);
    
        // Estraiamo l'idContatto (preso dal token)
        $idContatto = $user->idContatto;
    
        // Estraiamo i crediti di quell'idContatto
        $creditiUtente = Crediti::where('idContatto', $idContatto)->first()->crediti;
    
        // Estraiamo anche i crediti necessari per quel film di quell'id
        $creditiNecessari = CreditiFilm::where('idFilm', $idFilm)->first()->creditiNecessari;
    
        // Condizione che se i crediti dell'utente è minore di quelli necessari per guardare
        if ($creditiUtente < $creditiNecessari) {
            // Se è true, ritorna un messaggio d'errore che indica al client che non ha i crediti sufficienti per quel film, lo status code 404 indica che non ha il permesso di guardarlo perché ovviamente non ha i crediti necessari
            return response()->json(['error' => 'ERR_INSUFFICIENT_CR_FILM'], 403);
        }
    
        // Se supera la condizione, ritorna il film di quell'id
        return response()->json(['Film: ' => $film]);
    }
    
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateFilmRequest $request
     * @param  int  $idFilm
     * @return JsonResource
     */
    public function update(UpdateFilmRequest $request, $idFilm)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo l'id di quel film
        $filmToUpdate = Film::find($idFilm);
    
        // Condizione che se ritorna false ritorna un messaggio del film non trovato, lo status code 404 indica l'oggetto cercato non è stato trovato
        if (!$filmToUpdate) {
            return response()->json(['error' => 'ERR_FILM_NOTFOUND_PUT_ADMIN'], 404);
        }
    
        // Aggiorniamo il film con i dati della richiesta
        $filmToUpdate->update($request->all());
    
        // Infine ritorna il messaggio di aggiornamento avvenuto con successo e il film che è stato effettivamente aggiornato
        return response()->json([
            'message' => 'Film updated with success.',
            'Film: ' => $filmToUpdate
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

        // Troviamo il film di quell'id da eliminare
        $filmToDelete = Film::find($idFilm);

        // Condizione che se il film ritorna false, ritorna il messaggio d'errore che l'oggetto non è stato trovato
        if (!$filmToDelete) {
            return response()->json(['error' => 'ERR_FILM_NOTFOUND_DELETE_ADMIN'], 404);
        }

        // Se tutto va bene, eliminiamo il film
        $filmToDelete->delete();

        // Infine ritorna il messaggio che è stato cancellato con successo, lo status code 204 indica che non c'è contenuto nella richiesta, infatti deve esserlo
        return response()->json([
            'message' => 'Film deleted with success.'
        ], 204);
    }
}

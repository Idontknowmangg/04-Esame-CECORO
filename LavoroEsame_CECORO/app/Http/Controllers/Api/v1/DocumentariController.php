<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocRequest;
use App\Http\Requests\Admin\UpdateDocRequest;
use App\Http\Resources\ImpostazioniSito\see_DocCompletaResource;
use App\Http\Resources\ImpostazioniSito\see_DocIDResource;
use App\Http\Resources\ImpostazioniSito\see_DocResource;
use App\Http\Resources\MainContent\v1\DocResource;
use App\Models\ImpostazioniSito\Crediti;
use App\Models\ImpostazioniSito\CreditiDocumentario;
use App\Models\MainContent\Documentari;
use App\Models\VisualizzazioneImmagini\Vedi_documentario;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DocumentariController extends Controller
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

        // Estraiamo tutti i documentari
        $documentaries = Documentari::all();
        // Filtriamo i dati necessari
        $documentariesResource = DocResource::collection($documentaries);

        // Infine ritorniamo il messaggio e la lista intera di tutti i documentari
        return response()->json([
            'All Documentaries: ' => $documentariesResource
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\StoreDocRequest  $request
     * @return JsonResource
     */
    public function store(StoreDocRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $request->validated();
    
        // Prendiamo i prefissi per poi avere il valore preso dalle request
        $conditions = [
            'titoloDocumentario' => $request->titoloDocumentario,
            'idGenere' => $request->idGenere,
            'idImmagineDocumentario' => $request->idImmagineDocumentario,
            'idFormatoDocumentario' => $request->idFormatoDocumentario,
            'descrizione' => $request->descrizione,
            'regista' => $request->regista,
            'anno' => $request->anno,
            'durata' => $request->durata
        ];
        
        // Memorizziamo la var con i dati presi dalla request
        $existingDoc = Documentari::where($conditions)->first();
        
        // Se la condizione della var ritorna true significa che quei dati immessi sono identici a quelli esistenti nel DB, lo status code 400 intende richiesta non valida
        if ($existingDoc) {
            return response()->json(['message' => 'ERR_CREATION_DOC'], 400);
        }
        
        // Se tutto va bene, creiamo il documentario dalla richiesta
        $newDoc = Documentari::create($request->all());
    
        return response()->json([
            'message' => 'Documentary created with success.',
            'New Documentary:' => $newDoc
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $idDoc
     * @return JsonResource
     */
    public function show($idDoc)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();

        // Recuperiamo il documentario con l'id specificato dal client
        $doc = Documentari::find($idDoc);

        // Condizione che se la var ritorna false significa che il documentario non esiste, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$doc) {
            return response()->json(['error' => 'ERR_DOC_NOTFOUND'], 404);
        }
    
        // Se tutto va bene, memorizziamo in questa var i dati filtrati con il resource
        $docResource = new DocResource($doc);
    
        // E ritorniamo il documentario con l'id specificato
        return response()->json(['Documentary: ' => $docResource]);
    }
    

    public function play($idDocumentario)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo il documentario con l'id specificato
        $doc = Vedi_documentario::findOrFail($idDocumentario);
    
        // Estraiamo l'idContatto (preso dal token)
        $idContatto = $user->idContatto;
    
        // Estraiamo i crediti di quell'idContatto
        $creditiUtente = Crediti::where('idContatto', $idContatto)->first()->crediti;
    
        // Estraiamo anche i crediti necessari per quel film di quell'id
        $creditiNecessari = CreditiDocumentario::where('idDocumentario', $idDocumentario)->first()->creditiNecessari;
    
        // Condizione che se i crediti dell'utente è minore di quelli necessari per guardare
        if ($creditiUtente < $creditiNecessari) {
            // Se è true, ritorna un messaggio d'errore che indica al client che non ha i crediti sufficienti per quel documentario, lo status code 404 indica che non ha il permesso di guardarlo perché ovviamente non ha i crediti necessari
            return response()->json(['error' => 'ERR_INSUFFICIENT_CR_DOC'], 403);
        }
    
        // Se supera la condizione, ritorna il documentario di quell'id
        return response()->json(['Documentario: ' => $doc]);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateDocRequest $request
     * @param  int  $idDoc
     * @return JsonResource
     */
    public function update(UpdateDocRequest $request, $idDoc)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo l'id di quel documentario
        $docToUpdate = Documentari::find($idDoc);
    
        // Condizione che se ritorna false ritorna un messaggio del documentario non trovato, lo status code 404 indica l'oggetto cercato non è stato trovato
        if (!$docToUpdate) {
            return response()->json(['error' => 'ERR_DOC_NOTFOUND_PUT_ADMIN'], 404);
        }
    
        // Aggiorniamo il documentario con i dati della richiesta
        $docToUpdate->update($request->all());
    
        // Infine ritorna il messaggio di aggiornamento avvenuto con successo e il documentario che è stato effettivamente aggiornato
        return response()->json([
            'message' => 'Documentary updated with success.',
            'Documentary: ' => $docToUpdate
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $idDoc
     * @return JsonResource
     */
    public function destroy($idDoc)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo il documentario di quell'id da eliminare
        $docToDelete = Documentari::find($idDoc);

        // Condizione che se il documentario ritorna false, ritorna il messaggio d'errore che l'oggetto non è stato trovato
        if (!$docToDelete) {
            return response()->json(['error' => 'ERR_DOC_NOTFOUND_DELETE_ADMIN'], 404);
        }

        // Se tutto va bene, eliminiamo il documentario
        $docToDelete->delete();

        // Infine ritorna il messaggio che è stato cancellato con successo, lo status code 204 indica che non c'è contenuto nella richiesta, infatti deve esserlo
        return response()->json([
            'message' => 'Documentary deleted with success.'
        ], 204);
    }
}

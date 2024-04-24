<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDocHasGenereRequest;
use App\Http\Requests\Admin\UpdateDocHasGenereRequest;
use App\Http\Resources\Admin\DocHasGenereCompletaResource;
use App\Http\Resources\Admin\DocHasGenereResource;
use App\Models\ImpostazioniGenere\Documentario_hasGenere;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class DocumentarioHasGenereController extends Controller
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
        // Estraiamo tutti i record della tabella Documentario_hasGenere
        $doc = Documentario_hasGenere::all();
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = DocHasGenereCompletaResource::collection($doc);
        } else {
            $resource = DocHasGenereResource::collection($doc);
        }
        return $resource;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\StoreDocHasGenereRequest $request
     * @return JsonResource
     */
    public function store(StoreDocHasGenereRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Validiamo i dati della richiesta
        $request->validated();

        // Creiamo un documentario con un genere
        $newGenre = Documentario_hasGenere::create($request->all());

        // Messaggio di successo
        return response()->json([
            'message' => 'Doc with a genre created with success.',
            'New doc with genre:' => $newGenre
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
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo un documentario con un genere con l'ID specificato
        $doc = Documentario_hasGenere::find($idDoc);
    
        // Condizione che se ritorna false, significa che l'id del documentario con un genere non esiste
        if (!$doc) {
            return response()->json(['error' => 'ERR_DOCWITHGENRE_NOTFOUND'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new DocHasGenereCompletaResource($doc);
        } else {
            $resource = new DocHasGenereResource($doc);
        }
        return $resource;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\UpdateDocHasGenereRequest  $request
     * @param  int  $idDoc
     * @return JsonResource
     */
    public function update(UpdateDocHasGenereRequest $request, $idDoc)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Trova l'id del documentario con un genere da aggiornare
        $docToUpdate = Documentario_hasGenere::find($idDoc);
    
        // Condizione che se ritorna false, significa che l'id del documentario con un genere non esiste
        if (!$docToUpdate) {
            return response()->json(['error' => 'ERR_DOCWITHGENRE_NOTFOUND_PUT'], 404);
        }

        // Aggiorniamo il documentario con un genere
        $docToUpdate->update($request->all());
    
        // Messaggio di successo
        return response()->json([
            'message' => 'Doc with a genre updated with success.',
            'Film: ' => $docToUpdate
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

        // Trova l'id del documentario con un genere da eliminare
        $genreToDelete = Documentario_hasGenere::find($idDoc);

        // Condizione che se ritorna false, significa che l'id del documentario con un genere non esiste
        if (!$genreToDelete) {
            return response()->json(['error' => 'ERR_DOCWITHGENRE_NOTFOUND_DELETE'], 404);
        }

        // Eliminiamo il documentario con un genere
        $genreToDelete->delete();

        // Messaggio di successo
        return response()->json([
            'message' => 'Doc with a genre deleted with success.'
        ]);
    }
}

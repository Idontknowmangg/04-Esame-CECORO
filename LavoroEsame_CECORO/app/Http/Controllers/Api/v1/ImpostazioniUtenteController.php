<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreListRequest;
use App\Http\Requests\Admin\UpdateListRequest;
use App\Http\Requests\v1\UpdateUserDataRequest;
use App\Http\Resources\ImpostazioniAdmin\ContattiCompletaResource;
use App\Http\Resources\ImpostazioniAdmin\ContattiResource;
use App\Http\Resources\MainContent\v1\AccountResource;
use App\Models\ImpostazioniAdmin\Contatti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ImpostazioniUtenteController extends Controller
{

    public function showList()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo i dati dell'utente proveniente dal token
        $contatti = Contatti::all();
        // Filtriamo i dati necessari
        $contattiResource = ContattiResource::collection($contatti);
        
        // Infine ritorniamo il messaggio dell'account
        return response()->json([
            'Account' => $contattiResource
        ]);
    }

    public function chooseList($idUtente)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo l'utente con l'ID specificato
        $contatto = Contatti::find($idUtente);
    
        // Se l'utente non esiste, restituisci un errore, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$contatto) {
            return response()->json(['error' => 'ERR_USER_NOTFOUND'], 404);
        }
    
        // Per l'utente admin verrà mostrata questa funzione che mostrerà i dati completi
        if (request("completa") == 'true') {
            $resource = new ContattiCompletaResource($contatto);
        } else {
            $resource = new ContattiResource($contatto);
        }
    
        return $resource;
    }
    

    public function storeList(StoreListRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $request->validated();
    
        // Creiamo l'utente con i dati immessi dalla richiesta
        $newUser = new Contatti;
        $newUser->fill($request->except(['codiceFiscale', 'password', 'password_confirmation']));
    
        // E poi cifriamo tutti i dati sensibili
        $newUser->codiceFiscale = Hash::make($request->codiceFiscale);
        $newUser->password = Hash::make($request->password);
        $newUser->password_confirmation = Hash::make($request->password_confirmation);

        // Salviamo l'utente
        $newUser->save();
    
        // Infine ritorniamo il messaggio di successo che l'utente è stato creato, lo status code 201 indica che il contenuto è stato creato con successo
        return response()->json([
            'message' => 'User created with success.',
            'New user:' => $newUser
        ], 201);
    }
    


    public function updateList(UpdateListRequest $request, $idUtente)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo l'id dell'utente da aggiornare
        $userToUpdate = Contatti::find($idUtente);
    
        // Condizione che se la var ritorna false significa che l'utente non esiste, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$userToUpdate) {
            return response()->json(['error' => 'ERR_USER_PUT_NOTFOUND_ADMIN'], 404);
        }
    
        // Prima aggiorniamo i dati
        $userToUpdate->update($request->except(['password', 'password_confirmation', 'codiceFiscale']));
    
        // Poi cifriamo tutti i dati sensibili
        /**
         * Lo si fa perché altrimenti le password diverranno in chiaro perché dalla richiesta non potremo inventare
         * una serie di caratteri speciali, così facendo, potremo tranquillamente mettere la psw per poi essere hashata
         */
        $userToUpdate->codiceFiscale = Hash::make($request->codiceFiscale);
        $userToUpdate->password = Hash::make($request->password);
        $userToUpdate->password_confirmation = Hash::make($request->password_confirmation);
    
        // Salviamo i dati
        $userToUpdate->save();
    
        // Infine ritorna il messaggio dell'utente che è stato aggiornato con successo
        return response()->json([
            'message' => 'User updated with success.',
            'user' => $userToUpdate
        ], 200);
    }
    

    public function deleteList($idUtente)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();

        // Troviamo l'id dell'utente da eliminare
        $userToDelete = Contatti::find($idUtente);

        // Condizione che se la var ritorna false significa che l'utente non esiste, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$userToDelete) {
            return response()->json(['error' => 'ERR_USER_DELETE_NOTFOUND_ADMIN'], 404);
        }

        // Se tutto va bene, cancella l'utente
        $userToDelete->delete();

        // Infine ritorna il messaggio che è stato cancellato con successo
        return response()->json([
            'message' => 'User deleted with success.'
        ], 204);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo tutti i dati dal token
        $accountDetails = Contatti::where('idContatto', $user->idContatto)->first();
        // Filtriamo i dati necessari
        $accountResource = new AccountResource($accountDetails);

        // Verifica aggiuntiva per visualizzare se l'account passato esiste realmente. Se non esiste ritorna un errore 404, non trovato
        if (!$accountDetails) {
            abort(404, 'ACC_ERR');
        }

        // Se tutto va bene ritorna l'account del token con tutti i suoi dati
        return response()->json([
            'Your account: ' => $accountResource
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\v1\UpdateUserDataRequest  $request
     * @param  null
     * @return JsonResource
     */
    public function update(UpdateUserDataRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Troviamo l'id di quell'utente
        $accountDetails = Contatti::where('idContatto', $user->idContatto)->first();
    
        // Condizione che se ritorna false ritorna un messaggio dell'utente non trovato, lo status code 404 indica l'oggetto cercato non è stato trovato
        if (!$accountDetails) {
            abort(404, 'ERR_ACC_NOTFOUND_PUT_ADMIN');
        }
        
        // Aggiorniamo l'utente con i dati della richiesta
        $accountDetails->update($request->validated());
    
        // Infine ritorna il messaggio di aggiornamento avvenuto con successo e l'account che è stato effettivamente aggiornato
        return response()->json([
            'message' => 'Account updated successfully',
            'Your account' => $accountDetails
        ]);
    }
}

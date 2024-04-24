<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\BuyCreditsRequest;
use App\Http\Requests\v1\StoreCreditiRequest;
use App\Http\Requests\v1\UpdateCreditiRequest;
use App\Http\Resources\Admin\CreditiCompletaResource;
use App\Http\Resources\ImpostazioniSito\CreditiResource;
use App\Models\ImpostazioniSito\Crediti;
use App\Models\ImpostazioniSito\Fittizio_pagamento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class CreditiController extends Controller
{


    public function showCreditList()
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
        // Estraiamo i dati dei crediti degli utenti
        $credits = Crediti::all();
        
        // Di default sono solamente quelli filtrati, quindi necessari, altrimenti mostrerà tutti i dati
        if (request("completa") == 'true') {
            $resource = CreditiCompletaResource::collection($credits);
        } else {
            $resource = CreditiResource::collection($credits);
        }
        return $resource;
    }

    public function chooseCreditList($idCrediti)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo l'utente con l'ID specificato
        $credits = Crediti::find($idCrediti);
    
       // Se l'utente non esiste, restituisci un errore, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$credits) {
            return response()->json(['error' => 'ERR_ACC_NOTFOUND'], 404);
        }
    
        // Di default sono solamente quelli filtrati, quindi necessari, altrimenti mostrerà tutti i dati
        if (request("completa") == 'true') {
            $resource = new CreditiCompletaResource($credits);
        } else {
            $resource = new CreditiResource($credits);
        }
        return $resource;
    }
    
    public function storeCreditList(StoreCreditiRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $validated = $request->validated();
    
        // Preleva l'idContatto e i crediti dalla richiesta
        $idContatto = $validated['idContatto'];
        $setCrediti = $validated['setCrediti'];
    
        // Creiamo il saldo dell'utente
        $credits = Crediti::firstOrCreate(['idContatto' => $idContatto]);
    
        // Controlliamo se l'utente ha raggiunto il limite massimo di crediti, lo status code 400 indica che la richiesta non è valida
        if ($credits->crediti >= 1000) {
            return response()->json([
                'message' => 'ERR_MAX_CR_POST_USER',
            ], 400);
        }
    
        // Facciamo l'aggiunta da parte di crediti messi dall'admin ai crediti attuali dell'idContatto
        $credits->crediti += $setCrediti;
        // Salviamo
        $credits->save();
    
        // Infine ritorna un messaggio che tutto è andato a buon fine
        return response()->json([
            'message' => 'Credits setted with success.',
            'Credits:' => $credits
        ], 200);
    }
    

    public function updateCreditList(UpdateCreditiRequest $request, $idContatto)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Validiamo la richiesta
        $validated = $request->validated();
    
        // Estraiamo i crediti messi dalla richiesta
        $setCrediti = $validated['setCrediti'];
    
        // Estraiamo il record dei crediti dell'utente specificato
        $credits = Crediti::where('idContatto', $idContatto)->first();
    
        // Se la condizione ritorna false, significa che l'utente non esiste, lo status code 404 significa che l'oggetto non è stato trovato
        if (!$credits) {
            return response()->json(['message' => 'ERR_USER_CR_PUT_NOTFOUND'], 404);
        }
    
        // Controlliamo se l'utente ha raggiunto il limite massimo di crediti, lo status code 400 indica che la richiesta non è valida
        if ($setCrediti > 1000) {
            return response()->json([
                'message' => 'ERR_MAX_CR_PUT_USER',
            ], 400);
        }

        // Facciamo l'aggiornamento da parte di crediti messi dall'admin ai crediti attuali dell'idContatto
        $credits->crediti = $setCrediti;
        // Salviamo
        $credits->save();
    
        // Infine ritorna un messaggio che tutto è andato a buon fine
        return response()->json([
            'message' => 'Credits updated with success.',
            'Credits:' => $credits
        ]);
    }
    

    public function deleteCreditList($idGenere)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 3, utente admin)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Troviamo l'id dell'utente che ha i crediti da resettare
        $creditsToReset = Crediti::find($idGenere);
    
        // Se la condizione ritorna false, significa che l'utente non esiste, lo status code 404 significa che l'oggetto non è stato trovato
        if (!$creditsToReset) {
            return response()->json(['error' => 'ERR_USER_CR_DELETE_NOTFOUND'], 404);
        }
    
        // Prendiamo la colonna crediti e lo mettiamo a 0
        $creditsToReset->crediti = 0;
        // Salviamo
        $creditsToReset->save();
    
        // E ritorna il messaggio che è avvenuto con successo
        return response()->json([
            'message' => 'Credits reset to 0 with success.',
            'Credits:' => $creditsToReset
        ]);
    }
    
    

    public function buyCreditsUser(BuyCreditsRequest $request)
    {
        // Otteniamo l'autenticazione dell'utente corrente (Livello 2, utente autorizzato)
        $user = JWTAuth::parseToken()->authenticate();
    
        // Memorizziamo in questa var l'idContatto preso dal token
        $existingCC = Fittizio_pagamento::where('idContatto', $user->idContatto)->first();

        // Condizione che se ritorna false, significa che la carta di credito fornita dalla request dell'utente non è uguale a quella sua corrispondente del DB, lo status 400 indica che la richiesta non è valida
        if (!Hash::check($request->personal_info, $existingCC->personal_info)) {
            return response()->json([
                'message' => 'ERR_NOTMATCH_CREDITCARD_USER',
            ], 400);
        }
    
        // Memorizziamo in questa var che quali e quante volte i record sono stati aggiornati nelle ultime 24 ore, quindi sostanzialmente i crediti. Con il count restituisce un intero
        $creditPurchases = Crediti::where('idContatto', $user->idContatto)
        ->where('created_at', '>=', now()->subDay())
        ->count();
    
        // Se l'azione ripetuta di aggiornare il saldo dei crediti dell'utente è equivalente a 2, restituisce un messaggio d'avviso che ha raggiunto il limite, lo status 400 indica che la richiesta non è valida
        if ($creditPurchases >= 2) {
            return response()->json([
                'message' => 'ERR_DAILY_PURCHASES',
            ], 400);
        }
    
        // Aggiorniamo il saldo dei crediti dell'utente
        $credits = Crediti::firstOrCreate(['idContatto' => $user->idContatto]);
    
        // Controlliamo se l'utente ha raggiunto il limite massimo di crediti, lo status 400 indica che la richiesta non è valida
        if ($credits->crediti >= 1000) {
            return response()->json([
                'message' => 'ERR_MAXCR_PURCHASES_USER',
            ], 400);
        }
    
        // Aggiorniamo il suo saldo a quelli dei crediti messi dall'utente
        $credits->crediti += $request->setCrediti;
        // Salviamo
        $credits->save();
    
        // E ritorna il messaggio che ha acquistato con successo i crediti messi dall'utente
        return response()->json([
            'message' => 'Credits purchased successfully!',
            'Your credits' => $credits->crediti
        ]);
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

        // Estraiamo i dati del token per precisione i crediti
        $accountDetails = Crediti::where('idContatto', $user->idContatto)->first();

        // Filtriamo solamente i dati utili
        $accountResource = new CreditiResource($accountDetails);

        // Condizione che se ritorna false, significa che l'utente non esiste, lo status code 404 indica che l'oggetto non è stato trovato
        if (!$accountDetails) {
            abort(404, 'ACC_CR_ERR');
        }

        // Se tutto va bene, ritorna il messaggio dei suoi crediti
        return response()->json([
            'Your credits' => $accountResource
        ]);
    }
}

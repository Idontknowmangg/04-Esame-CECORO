<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\ValidateLoginRequest;
use App\Http\Requests\v1\ValidateRegisterRequest;
use App\Models\ImpostazioniAdmin\Contatti;
use App\Models\ImpostazioniAdmin\Contatti_ContattiRuoli;
use App\Models\ImpostazioniAdmin\ContattiStato;
use App\Models\ImpostazioniSito\Crediti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ContattiAuthController extends Controller
{
    /**
     * Displays a register form with all necessary data 
     * 
     * @param \Illuminate\Http\ValidateRegisterRequest $request
     * @return JsonResource
     */
    public function register(ValidateRegisterRequest $request)
    {
        // Creiamo il model
        $contatto = new Contatti;

        // Riempiamo tutti i dati dalla richiesta grazie sia da parte server il request e sia da client che fornisce i dati necessari
        $contatto->fill($request->except('isAdmin'));

        $contatto->isAdmin = 0;
        
        // Crittogriafiamo sia la password che ha scritto e sia quella di conferma
        $contatto->password = Hash::make($request->password);
        $contatto->password_confirmation = Hash::make($request->password_confirmation);

        // Salviamo i dati e verranno creati
        $contatto->save();

        // E infine vengono creati i record grazie dall'idContatto che è stato appena creato (dai dati forniti)
        Crediti::create([
            'idContatto' => $contatto->idContatto,
            'crediti' => 0
        ]);

        ContattiStato::create([
            'idContatto' => $contatto->idContatto,
            'statoUtente' => 0,
            'isBanned' => 0,
            'isRegistered' => 1
        ]);

        Contatti_ContattiRuoli::create([
            'idContatto' => $contatto->idContatto,
            'idContattoRuolo' => 2
        ]);

        // Infine ritorna al client il messaggio di registrazione avvenuta con successo e il status code 201, equivalente alla creazione del contenuto
        return response()->json(['message' => 'Registered with success.', 'Your account: ' => $contatto], 201);
    }

    /**
     * Displays a login form, if all data are sent correctly, will generate a token for registered user
     * 
     * @param \Illuminate\Http\ValidateLoginRequest $request
     * @return JsonResource
     */
    public function login(ValidateLoginRequest $request)
    {
        // Memorizziamo alla var l'email fornita dalla request che successivamente farà la ricerca/verifica grazie a first(), la colonna email è unique/unica in modo tale che esiste solamente quell'utente
        $contattoEmail = Contatti::where('email', $request->email)->first();
    
        // Condizione per verificare se fallisce la ricerca
        if (!$contattoEmail) {
            // Se ritorna false viene inviato il messaggio all'utente che l'email fornita non esiste o incorretta con lo status code 400 che sta ad indicare la richiesta non è valida
            return response()->json(['error' => 'EMAIL_ERR'], 400);
        }
    
        // Se la ricerca dell'email è andata a buon fine, memorizziamo la var che filtra i campi e prende solamente quelli necessari
        $credentials = $request->only('email', 'password');
    
        // Condizione per verificare se la var $token ritorna false tramite il metodo attempt() della classe JWTAuth (proveniente dalla libreria di autenticazione di nome Tymon) mettendo le credenziali fornite dal client
        /**
         * Per approfondire sta verificando l'email e password proveniente dalla tabella che è stata nominata,
         * la verifica dell'email è stata già fatta da prima e quindi in questo caso sta verificando la password,
         * lo fa tramite la password messa in chiaro dal client, viene hashata, e verifica se questo hash generato
         * corrisponde a quello del DB, allora viene autenticato con successo.
         */
        if (!$token = JWTAuth::attempt($credentials)) {
            // Se ritorna false viene inviato il messaggio al client che le credenziali fornite (attenzione stiamo specificando la psw) non sono corrette. Lo status code 401 sta ad indicare che non è stata autorizzata (a dargli il token)
            return response()->json(['error' => 'CREDS_ERR.'], 401);
        }

        // Se tutto va a buon fine, viene aggiornato il record per quell'idContatto da statoUtente 0 a 1
        ContattiStato::where('idContatto', $contattoEmail->idContatto)->update(['statoUtente' => 1]);
    
        // E viene inviato un messaggio al client che l'autenticazione è avvenuta con successo con lo status code 200 che equivale a OK
        return response()->json(['Message' => 'Logged with success.', 'Your token: ' => $token], 200);
    }

    public function logout()
    {
        // Prendiamo il token Bearer che è stato estratto dall'header 
        $user = JWTAuth::parseToken()->authenticate();

        // Invalidiamo il token
        JWTAuth::invalidate(JWTAuth::getToken());

        // E ritorna il messaggio di logout con successo
        return response()->json([
            'message' => 'Logout with success.',
        ]);
    }
    
    public function deletePermanent()
    {
        // Prendiamo il token Bearer che è stato estratto dall'header 
        $user = JWTAuth::parseToken()->authenticate();
    
        // Eliminiamo l'utente
        $user->delete();
    
        // E ritorna il messaggio di cancellazione permanente con successo
        return response()->json([
            'message' => 'You deleted permanently your account',
        ]);
    }
}

<?php

namespace App\Models\ImpostazioniAdmin;


use Illuminate\Database\Eloquent\Model;
use App\Models\ImpostazioniSito\Crediti;
use App\Models\ImpostazioniSito\Fittizio_pagamento;
use App\Models\ImpostazioniSito\Valutazione;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Contatti extends Model implements JWTSubject, Authenticatable
{
    use HasFactory, AuthenticatableTrait;
    protected $table = "contatti";
    protected $primaryKey= "idContatto";

    protected $fillable = [
        'nome',
        'cognome',
        'sesso',
        'codiceFiscale',
        'partitaIva',
        'cittadinanza',
        'cittaNascita',
        'provinciaNascita',
        'dataNascita',
        'email',
        'password',
        'password_confirmation',
        'isAdmin'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function contattiStato()
    {
        return $this->hasMany(ContattiStato::class, 'idContatto', 'idContatto');
    }
    
    public function contattiContattiRuoli()
    {
        return $this->hasMany(Contatti_ContattiRuoli::class, 'idContatto', 'idContatto');
    }

    public function tokenJWT()
    {
        return $this->hasMany(TokenJWT::class, 'idContatto', 'idContatto');
    }

    public function crediti()
    {
        return $this->hasMany(Crediti::class, 'idContatto', 'idContatto');
    }

    public function pagamento()
    {
        return $this->hasMany(Fittizio_pagamento::class, 'idContatto', 'idContatto');
    }

    public function valutazione()
    {
        return $this->hasMany(Valutazione::class, 'idContatto', 'idContatto');
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function isAdmin()
    {
        return $this->isAdmin === 1;
    }
}

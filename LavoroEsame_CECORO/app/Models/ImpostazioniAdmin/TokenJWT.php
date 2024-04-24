<?php

namespace App\Models\ImpostazioniAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TokenJWT extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "token_jwt";
    protected $primaryKey = "idToken";

    protected $fillable = [
        'idContatto',
        'token',
        'dataCreazione',
        'dataScadenza'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function TokenHasContatti()
    {
        return $this->hasOne(Token_hasContatti::class, 'idToken', 'idToken');
    }

    //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function contattiFK()
    {
        return $this->belongsTo(Contatti::class, 'idContatto', 'idContatto');
    }
}

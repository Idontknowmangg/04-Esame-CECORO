<?php

namespace App\Models\ImpostazioniAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token_hasContatti extends Model
{
    use HasFactory;
    protected $table = "token_has_contatti";
    protected $primaryKey = "idTokenContatti";

    protected $fillable = [
        'idContatto',
        'idToken'
    ];

        //       ---------------------------    FK    ---------------------------


    /**
     * The table that passed his PK to another table will be transformed into FK
     * 
     * @param null
     * @return ForeignKey
     */
    public function contattiFK()
    {
        return $this->belongsTo(Contatti::class, 'idContattoStato', 'idContattoStato');
    }

    public function TokenJWT_FK()
    {
        return $this->belongsTo(TokenJWT::class, 'idContattoStato', 'idContattoStato');
    }
}

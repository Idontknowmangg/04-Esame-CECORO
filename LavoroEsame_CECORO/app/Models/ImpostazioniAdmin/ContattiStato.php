<?php

namespace App\Models\ImpostazioniAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContattiStato extends Model
{
    use HasFactory;
    protected $table = "contatti_stato";
    protected $primaryKey = "idContattoStato";

    protected $fillable = [
        'idContatto',
        'statoUtente',
        'isBanned',
        'isRegistered'
    ];

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

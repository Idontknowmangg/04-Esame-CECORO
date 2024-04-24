<?php

namespace App\Models\ImpostazioniSito;

use App\Models\ImpostazioniAdmin\Contatti;
use App\Models\ImpostazioniAdmin\ContattiRuoli;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assistenza_autorizzati extends Model
{
    use HasFactory;
    protected $table = "assistenza_autorizzati";
    protected $primaryKey = "idAssistenza";

    protected $fillable = [
        'idContatto',
        'feedback'
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
        return $this->belongsTo(Contatti::class, 'idContatto', 'idContatto');
    }
}

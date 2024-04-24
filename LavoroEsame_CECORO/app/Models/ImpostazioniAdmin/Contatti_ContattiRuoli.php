<?php

namespace App\Models\ImpostazioniAdmin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contatti_ContattiRuoli extends Model
{
    use HasFactory;
    protected $table = "contatti_contattiruoli";
    protected $primaryKey = "idTracciaUtente";

    protected $fillable = [
        'idContatto',
        'idContattoRuolo'
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

    public function contattiRuoloFK()
    {
        return $this->belongsTo(ContattiRuoli::class, 'idContattoRuolo', 'idContattoRuolo');
    }
}

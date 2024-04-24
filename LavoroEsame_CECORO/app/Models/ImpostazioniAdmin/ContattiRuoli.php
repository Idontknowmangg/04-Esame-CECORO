<?php

namespace App\Models\ImpostazioniAdmin;

use App\Models\ImpostazioniSito\Assistenza_autorizzati;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContattiRuoli extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "contatti_ruoli";
    protected $primaryKey = "idContattoRuolo";

    protected $fillable = [
        'nomeRuolo',
        'lvlRuolo'
    ];

    /**
     * The PK of his originary table passes to other tables
     * 
     * @param null
     * @return PrimaryKey
     */
    public function contattiRuoli()
    {
        return $this->hasOne(Contatti_ContattiRuoli::class, 'idContattoRuolo', 'idContattoRuolo');
    }
}
